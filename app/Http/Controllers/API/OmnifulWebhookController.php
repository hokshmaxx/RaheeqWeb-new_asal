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
        Log::info('====== OMNIFUL WEBHOOK RECEIVED ======');

        try {
            $payload = $request->getContent();

            // Omniful sends webhook secret in header "webhook-secret-key"
            $webhookSecretFromHeader = $request->header('webhook-secret-key');
            $configuredSecret = config('services.omniful.webhook_secret');

            // Verify webhook secret if configured
            if ($configuredSecret && $webhookSecretFromHeader) {
                if ($webhookSecretFromHeader !== $configuredSecret) {
                    Log::warning('❌ Invalid webhook secret');
                    return response()->json(['error' => 'Invalid webhook secret'], 401);
                }
                Log::info('✅ Webhook secret verified');
            }

            // Parse webhook data
            $data = $request->all();

            // Omniful uses "event_name" in body OR "webhook-event" in header
            $eventName = $data['event_name'] ?? $request->header('webhook-event');

            Log::info('Event Detection', [
                'event_name' => $eventName,
                'action' => $data['action'] ?? null,
            ]);

            if (!$eventName) {
                Log::error('❌ Missing event name');
                return response()->json(['error' => 'Missing event name'], 400);
            }

            // Map Omniful event names to our internal event types
            $eventTypeMap = [
                'inventory.update.event' => 'inventory.updated',
                'order.created.event' => 'order.created',
                'order.updated.event' => 'order.updated',
                'order.cancelled.event' => 'order.cancelled',
                'order.shipped.event' => 'order.shipped',
                'order.delivered.event' => 'order.delivered',
            ];

            $eventType = $eventTypeMap[$eventName] ?? $eventName;

            Log::info('Processing Event', [
                'omniful_event' => $eventName,
                'mapped_event' => $eventType,
            ]);

            $omnifulService = app(OmnifulService::class);

            // For inventory events, extract data from nested structure
            if ($eventType === 'inventory.updated') {
                $inventoryData = $data['data'] ?? [];

                Log::info('Processing inventory items', [
                    'count' => count($inventoryData),
                ]);

                $results = [];
                foreach ($inventoryData as $item) {
                    $itemData = [
                        'sku_code' => $item['sku_code'] ?? null,
                        'quantity' => $item['quantity'] ?? $item['quantity_on_hand'] ?? null,
                        'hub_code' => $item['hub_code'] ?? null,
                        'action' => $data['action'] ?? null,
                    ];

                    $results[] = $omnifulService->handleWebhook($eventType, $itemData);
                }

                $allSuccess = !in_array(false, $results, true);

                if ($allSuccess) {
                    Log::info('✅ All inventory items processed');
                    return response()->json(['status' => 'success'], 200);
                }
            } else {
                // For order events, process normally
                $result = $omnifulService->handleWebhook($eventType, $data);

                if ($result) {
                    Log::info('✅ Webhook processed');
                    return response()->json(['status' => 'success'], 200);
                }
            }

            Log::warning('⚠️ Webhook processing failed');
            return response()->json(['status' => 'failed'], 422);

        } catch (\Exception $e) {
            Log::error('❌ Webhook exception', [
                'error' => $e->getMessage(),
                'line' => $e->getLine(),
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
