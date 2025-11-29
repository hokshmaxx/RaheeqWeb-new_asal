<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Services\OmnifulService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class OmnifulWebhookController extends Controller
{
    public function handle(Request $request)
    {
        // ====== START DEBUG LOGGING ======
        Log::info('====== OMNIFUL WEBHOOK RECEIVED ======');
        Log::info('Request URL', ['url' => $request->fullUrl()]);
        Log::info('Request Method', ['method' => $request->method()]);
        Log::info('Request IP', ['ip' => $request->ip()]);

        // Log ALL headers
        Log::info('All Headers', ['headers' => $request->headers->all()]);

        // Get signature from different possible header names
        $signatureHeaders = [
            'X-Omniful-Signature' => $request->header('X-Omniful-Signature'),
            'x-omniful-signature' => $request->header('x-omniful-signature'),
            'Omniful-Signature' => $request->header('Omniful-Signature'),
            'X-Signature' => $request->header('X-Signature'),
        ];

        Log::info('Signature Header Checks', $signatureHeaders);

        $signature = $request->header('X-Omniful-Signature');

        Log::info('Signature Value', [
            'signature' => $signature,
            'is_null' => is_null($signature),
            'is_empty' => empty($signature),
            'type' => gettype($signature),
        ]);

        // Get raw payload
        $payload = $request->getContent();

        Log::info('Raw Payload', [
            'payload' => $payload,
            'length' => strlen($payload),
        ]);

        // Check webhook secret
        $webhookSecret = config('services.omniful.webhook_secret');

        Log::info('Webhook Secret Config', [
            'configured' => !empty($webhookSecret),
            'secret_preview' => $webhookSecret ? substr($webhookSecret, 0, 8) . '...' : 'NOT SET',
        ]);

        // ====== END DEBUG LOGGING ======

        try {
            $omnifulService = app(OmnifulService::class);

            // Verify signature ONLY if webhook secret is configured AND signature is present
            if ($webhookSecret && $signature) {
                Log::info('Attempting signature verification');

                if (!$omnifulService->verifyWebhookSignature($payload, $signature)) {
                    Log::warning('Invalid Omniful webhook signature', [
                        'received_signature' => $signature,
                    ]);
                    return response()->json(['error' => 'Invalid signature'], 401);
                }

                Log::info('✅ Webhook signature verified successfully');
            } else {
                Log::info('⚠️ Webhook signature verification skipped', [
                    'reason' => !$webhookSecret ? 'No webhook secret configured' : 'No signature header present',
                    'has_secret' => !empty($webhookSecret),
                    'has_signature' => !empty($signature),
                ]);
            }

            // Get event data
            $data = $request->all();

            Log::info('Parsed Request Data', ['data' => $data]);

            // Get event type from multiple sources
            $eventType = $data['event_type'] ?? $data['event'] ?? $request->header('X-Omniful-Event');

            Log::info('Event Type Detection', [
                'from_data_event_type' => $data['event_type'] ?? null,
                'from_data_event' => $data['event'] ?? null,
                'from_header' => $request->header('X-Omniful-Event'),
                'final_event_type' => $eventType,
            ]);

            if (!$eventType) {
                Log::error('❌ Missing event type in webhook', ['data' => $data]);
                return response()->json(['error' => 'Missing event type'], 400);
            }

            Log::info('Processing webhook event', [
                'event_type' => $eventType,
                'data' => $data,
            ]);

            // Process webhook
            $result = $omnifulService->handleWebhook($eventType, $data);

            if ($result) {
                Log::info('✅ Webhook processed successfully', [
                    'event_type' => $eventType,
                    'result' => $result,
                ]);

                return response()->json(['status' => 'success'], 200);
            }

            Log::warning('⚠️ Webhook processing failed', [
                'event_type' => $eventType,
                'result' => $result,
            ]);

            return response()->json(['status' => 'failed'], 422);

        } catch (\Exception $e) {
            Log::error('❌ Webhook exception', [
                'error' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'trace' => $e->getTraceAsString(),
            ]);

            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage(),
            ], 500);
        } finally {
            Log::info('====== END OMNIFUL WEBHOOK ======');
        }
    }
}
