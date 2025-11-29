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
        Log::info('Request URL', ['url' => $request->fullUrl()]);
        Log::info('All Headers', ['headers' => $request->headers->all()]);

        try {
            $payload = $request->getContent();

            // Omniful sends webhook secret in header "webhook-secret-key" NOT "X-Omniful-Signature"
            $webhookSecretFromHeader = $request->header('webhook-secret-key');
            $configuredSecret = config('services.omniful.webhook_secret');

            Log::info('Webhook Secret Verification', [
                'secret_from_header' => $webhookSecretFromHeader ? substr($webhookSecretFromHeader, 0, 8) . '...' : 'NOT SENT',
                'configured_secret' => $configuredSecret ? substr($configuredSecret, 0, 8) . '...' : 'NOT SET',
            ]);

            // Verify webhook secret if configured
            if ($configuredSecret && $webhookSecretFromHeader) {
                if ($webhookSecretFromHeader !== $configuredSecret) {
                    Log::warning('❌ Invalid webhook secret');
                    return response()->json(['error' => 'Invalid webhook secret'], 401);
                }
                Log::info('✅ Webhook secret verified');
            } else {
                Log::info('⚠️ Webhook secret verification skipped', [
                    'has_config' => !empty($configuredSecret),
                    'has_header' => !empty($webhookSecretFromHeader),
                ]);
            }

            // Parse webhook data
            $data = $request->all();

            Log::info('Parsed Request Data', ['data' => $data]);

            // Omniful uses "event_name" in body OR "webhook-event" in header
            $eventName = $data['event_name'] ?? $request->header('webhook-event');

            Log::info('Event Detection', [
                'event_name_from_body' => $data['event_name'] ?? null,
                'event_from_header' => $request->header('webhook-event'),
                'final_event_name' => $eventName,
            ]);

            if (!$eventName) {
                Log::error('❌ Missing event name in webhook', ['data' => $data]);
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

            Log::info('Event Mapping', [
                'omniful_event' => $eventName,
                'mapped_event' => $eventType,
            ]);

            // Process the webhook
            $omnifulService = app(OmnifulService::class);

            // For inventory events, extract the inventory data from the nested structure
            if ($eventType === 'inventory.updated') {
                $inventoryData = $data['data'] ?? [];

                Log::info('Processing inventory update', [
                    'items_count' => count($inventoryData),
                    'items' => $inventoryData,
                ]);

                // Process each inventory item
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

                Log::info('Inventory update results', [
                    'total_items' => count($results),
                    'all_success' => $allSuccess,
                ]);

                if ($allSuccess) {
                    Log::info('✅ Webhook processed successfully');
                    return response()->json(['status' => 'success'], 200);
                }
            } else {
                // For other events (order events), process normally
                $result = $omnifulService->handleWebhook($eventType, $data);

                if ($result) {
                    Log::info('✅ Webhook processed successfully', ['event_type' => $eventType]);
                    return response()->json(['status' => 'success'], 200);
                }
            }

            Log::warning('⚠️ Webhook processing failed');
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
