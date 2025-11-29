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
        $payload = $request->getContent();
        $signature = $request->header('X-Omniful-Signature');

        $omnifulService = app(OmnifulService::class);

        // Verify signature
        if (!$omnifulService->verifyWebhookSignature($payload, $signature)) {
            Log::warning('Invalid Omniful webhook signature');
            return response()->json(['error' => 'Invalid signature'], 401);
        }

        // Get event data
        $data = $request->all();
        $eventType = $data['event_type'] ?? $request->header('X-Omniful-Event');

        if (!$eventType) {
            return response()->json(['error' => 'Missing event type'], 400);
        }

        // Process webhook
        $result = $omnifulService->handleWebhook($eventType, $data);

        if ($result) {
            return response()->json(['status' => 'success'], 200);
        }

        return response()->json(['status' => 'failed'], 422);
    }
}
