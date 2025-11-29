<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class OmnifulService
{
    protected string $baseUrl;
    protected string $accessToken;

    public function __construct()
    {
        $this->baseUrl = rtrim(config('services.omniful.base_url'), '/');
        $this->accessToken = config('services.omniful.access_token');
    }

    /**
     * Get mobile code based on country code
     */
    protected function getMobileCode(string $countryCode): string
    {
        $mobileCodes = [
            'KW' => '+965',
            'SA' => '+966',
            'AE' => '+971',
            'BH' => '+973',
            'OM' => '+968',
            'QA' => '+974',
        ];

        return $mobileCodes[$countryCode] ?? '+965';
    }

    /**
     * Format phone number with country code and hyphens
     */
    protected function formatPhoneNumber(string $phone, string $countryCode): string
    {
        // Remove all non-numeric characters
        $cleanPhone = preg_replace('/[^0-9]/', '', $phone);

        // Get mobile code
        $mobileCode = $this->getMobileCode($countryCode);

        // Format: +XXX-XX-XXX-XXXX (basic format, adjust per country if needed)
        if (strlen($cleanPhone) >= 8) {
            // Simple hyphen insertion every 2-3 digits
            return $mobileCode . '-' . chunk_split($cleanPhone, 2, '-');
        }

        return $mobileCode . '-' . $cleanPhone;
    }

    public function createOrder(\App\Models\Order $order)
    {
        try {
            $orderData = $this->formatOrder($order);

            $url = $this->baseUrl . '/sales-channel/public/v1/orders';

            Log::info('Sending order to Omniful', [
                'order_id' => $order->id,
                'url' => $url,
                'data' => $orderData,
            ]);

            $response = Http::timeout(30)
                ->withHeaders([
                    'Authorization' => 'Bearer ' . $this->accessToken,
                    'Content-Type' => 'application/json',
                    'Accept' => 'application/json',
                ])
                ->post($url, $orderData);

            Log::info('Omniful API Response', [
                'order_id' => $order->id,
                'status' => $response->status(),
                'body' => $response->body(),
            ]);

            if ($response->successful()) {
                return [
                    'success' => true,
                    'data' => $response->json(),
                ];
            }

            Log::error('Omniful order creation failed', [
                'order_id' => $order->id,
                'status' => $response->status(),
                'response' => $response->body(),
                'sent_data' => $orderData,
            ]);

            return [
                'success' => false,
                'error' => $response->json()['message'] ?? $response->body() ?? 'Failed to create order',
            ];

        } catch (\Exception $e) {
            Log::error('Omniful API exception', [
                'order_id' => $order->id,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);

            return [
                'success' => false,
                'error' => $e->getMessage(),
            ];
        }
    }

    /**
     * Format order data for Omniful API
     * FIXED: Matches Omniful's exact JSON structure
     */
    protected function formatOrder(\App\Models\Order $order): array
    {
        $items = [];
        $totalItemTax = 0;
        $totalDiscount = 0;

        foreach ($order->products as $orderProduct) {
            $variant = $orderProduct->variant;
            $product = $orderProduct->product;

            // Prices
            $displayPrice = (float) $orderProduct->price; // Original price
            $quantity = (int) $orderProduct->quantity;
            $discount = $orderProduct->offer_price > 0
                ? (float) ($orderProduct->price - $orderProduct->offer_price)
                : 0.0;
            $sellingPrice = $displayPrice - $discount; // Price after discount
            $subtotal = $sellingPrice * $quantity;

            // Tax calculation (10% on selling price, tax inclusive)
            $taxPercent = 10;
            $taxAmount = $subtotal * ($taxPercent / (100 + $taxPercent));

            // IMPORTANT: total = subtotal + tax (even though tax_inclusive is true)
            // This matches Omniful's example: subtotal=699, tax=69.9, total=768.9
            $itemTotal = $subtotal + $taxAmount;

            $totalItemTax += $taxAmount;
            $totalDiscount += ($discount * $quantity);

            $items[] = [
                'sku_code' => $variant->sku ?? $product->sku ?? 'SKU-' . $product->id,
                'name' => $product->name ?? 'Product',
                'display_price' => round($displayPrice, 2),
                'selling_price' => round($sellingPrice, 2),
                'is_substituted' => false,
                'quantity' => $quantity,
                'tax_percent' => $taxPercent,
                'tax' => round($taxAmount, 2),
                'unit_price' => round($sellingPrice, 2),
                'subtotal' => round($subtotal, 2),
                'total' => round($itemTotal, 2), // ✅ FIX: subtotal + tax
                'discount' => round($discount * $quantity, 2),
                'tax_inclusive' => true,
            ];
        }

        // Get country-specific settings
        $countryCode = config('services.omniful.country_code', 'KW');
        $mobileCode = $this->getMobileCode($countryCode);

        // Format delivery date
        $deliveryDate = $order->delivery_date
            ? \Carbon\Carbon::parse($order->delivery_date)->format('dmY')
            : \Carbon\Carbon::now()->addDays(2)->format('dmY');

        // Calculate invoice totals
        $subtotal = (float) $order->sub_total;
        $shippingPrice = (float) $order->delivery_cost;
        $tax = round($totalItemTax, 2);
        $discount = round($totalDiscount, 2);

        // IMPORTANT: Total calculation must be accurate
        $invoiceTotal = $subtotal - $discount + $tax + $shippingPrice;

        return [
            'shipment_type' => 'omniful_generated',
//            'order_id' => 'order_' . $order->id, // ✅ FIX: REQUIRED field (was missing!)
            'order_alias' => '#' . $order->id,
            'hub_code' => config('services.omniful.hub_code', 'A1'),
            'order_items' => $items,

            'billing_address' => [
                'address1' => $order->street ?? 'N/A',
                'address2' => $order->address_name ?? '',
                'city' => optional($order->area)->name ?? 'N/A',
                'country' => config('services.omniful.country', 'Kuwait'),
                'first_name' => $this->getFirstName($order->name),
                'last_name' => $this->getLastName($order->name),
                'phone' => $this->formatPhoneNumber($order->mobile ?? '', $countryCode), // ✅ FIX: Formatted phone
                'state' => optional($order->governorate)->name ?? optional($order->area)->name ?? 'N/A',
                'zip' => $order->block ?: '00000',
                'state_code' => $this->getStateCode($order),
                'country_code' => $countryCode,
                'latitude' => $order->latitude ? (float) $order->latitude : null,
                'longitude' => $order->longitude ? (float) $order->longitude : null,
            ],

            'shipping_address' => [
                'address1' => $order->street ?? 'N/A',
                'address2' => $order->address_name ?? '',
                'city' => optional($order->area)->name ?? 'N/A',
                'country' => config('services.omniful.country', 'Kuwait'),
                'first_name' => $this->getFirstName($order->name),
                'last_name' => $this->getLastName($order->name),
                'phone' => $this->formatPhoneNumber($order->mobile ?? '', $countryCode), // ✅ FIX: Formatted phone
                'state' => optional($order->governorate)->name ?? optional($order->area)->name ?? 'N/A',
                'zip' => $order->block ?: '00000',
                'state_code' => $this->getStateCode($order),
                'country_code' => $countryCode,
                'latitude' => $order->latitude ? (float) $order->latitude : null,
                'longitude' => $order->longitude ? (float) $order->longitude : null,
            ],

            'invoice' => [
                'currency' => config('services.omniful.currency', 'KWD'),
                'subtotal' => round($subtotal, 2),
                'shipping_price' => round($shippingPrice, 2),
                'shipping_refund' => 0.0,
                'tax' => $tax, // ✅ FIX: Sum of item taxes
                'discount' => $discount, // ✅ FIX: Sum of item discounts
                'total' => round($invoiceTotal, 2), // ✅ FIX: subtotal - discount + tax + shipping
                'total_paid' => $order->payment_status == 'paid' ? round($invoiceTotal, 2) : 0.0,
                'total_due' => $order->payment_status != 'paid' ? round($invoiceTotal, 2) : 0.0,
                'total_refunded' => 0.0,
                'payment_mode' => $order->payment_method == 1 ? 'Cash' : 'Credit Card',
                'tax_percent' => 10,
                'shipping_tax' => 0.0,
                'sub_total_tax_inclusive' => true,
                'sub_total_discount_inclusive' => true,
                'shipping_tax_inclusive' => false,
                'shipping_discount_inclusive' => false,
                'attachments' => [],
            ],

            'customer' => [
                'id' => (string) $order->user_id,
                'first_name' => $this->getFirstName($order->name),
                'last_name' => $this->getLastName($order->name),
                'mobile' => preg_replace('/[^0-9]/', '', $order->mobile ?? ''), // ✅ FIX: Just digits, no code
                'mobile_code' => $mobileCode,
                'email' => $order->email ?? 'noemail@example.com',
                'avatar' => optional($order->user)->avatar ?? '',
                'gender' => optional($order->user)->gender ?? 'male',
            ],

            'labels' => [],

            'slot' => [
                'delivery_date' => $deliveryDate,
                'start_time' => 1000,
                'end_time' => 1800,
            ],

            'payment_method' => $order->payment_method == 1 ? 'postpaid' : 'prepaid',
            'is_cash_on_delivery' => $order->payment_method == 1,
            'require_shipping' => true,
            'note' => optional($order->deliveryNote)->delivery_note ?? '',
            'type' => 'b2c',
            'external_fields' => [
                [
                    'key' => 'order_id',
                    'value' => (string) $order->id,
                ],
                [
                    'key' => 'customer_name',
                    'value' => $order->name ?? 'Customer',
                ],
                [
                    'key' => 'status',
                    'value' => (string) $order->status,
                ],
            ],
            'cancel_order_after_seconds' => 3600,
        ];
    }

    /**
     * Get state code
     */
    protected function getStateCode(\App\Models\Order $order): string
    {
        $governorate = optional($order->governorate)->name;

        $stateCodes = [
            'Hawally' => 'HAW',
            'Capital' => 'CAP',
            'Ahmadi' => 'AHM',
            'Farwaniya' => 'FAR',
            'Jahra' => 'JAH',
            'Mubarak Al-Kabeer' => 'MUB',
        ];

        return $stateCodes[$governorate] ?? 'N/A';
    }

    /**
     * Get first name from full name
     */
    protected function getFirstName(?string $fullName): string
    {
        if (!$fullName) return 'Customer';
        $parts = explode(' ', trim($fullName));
        return $parts[0];
    }

    /**
     * Get last name from full name
     */
    protected function getLastName(?string $fullName): string
    {
        if (!$fullName) return '';
        $parts = explode(' ', trim($fullName));
        return count($parts) > 1 ? implode(' ', array_slice($parts, 1)) : '';
    }

    /**
     * Verify webhook signature
     */
    public function verifyWebhookSignature(string $payload, string $signature): bool
    {
        $secret = config('services.omniful.webhook_secret');
        $expectedSignature = hash_hmac('sha256', $payload, $secret);

        return hash_equals($expectedSignature, $signature);
    }

    /**
     * Handle webhook events
     */
    public function handleWebhook(string $eventType, array $data): bool
    {
        Log::info('Omniful webhook received', [
            'event_type' => $eventType,
            'data' => $data,
        ]);

        try {
            switch ($eventType) {
                case 'order.updated':
                case 'order.shipped':
                    return $this->updateOrderStatus($data);

                case 'order.delivered':
                    return $this->markOrderDelivered($data);

                case 'order.cancelled':
                    return $this->cancelOrder($data);

                case 'inventory.updated':
                case 'stock.updated':
                    return $this->updateInventory($data);

                case 'inventory.adjustment':
                    return $this->handleInventoryAdjustment($data);

                case 'product.stock_sync':
                    return $this->syncProductStock($data);

                default:
                    Log::info('Unhandled webhook event', ['event_type' => $eventType]);
                    return true;
            }
        } catch (\Exception $e) {
            Log::error('Webhook processing failed', [
                'event_type' => $eventType,
                'error' => $e->getMessage(),
            ]);
            return false;
        }
    }

    /**
     * Update inventory from Omniful webhook
     */
    protected function updateInventory(array $data): bool
    {
        $sku = $data['sku'] ?? $data['sku_code'] ?? null;
        $quantity = $data['quantity'] ?? $data['available_quantity'] ?? null;

        if (!$sku || $quantity === null) {
            Log::warning('Invalid inventory update data', ['data' => $data]);
            return false;
        }

        $variant = \App\Models\ProductVariant::where('sku', $sku)->first();

        if ($variant) {
            $oldQuantity = $variant->quantity;
            $variant->update(['quantity' => $quantity]);

            if ($variant->product) {
                $totalQuantity = \App\Models\ProductVariant::where('product_id', $variant->product_id)
                    ->sum('quantity');
                $variant->product->update(['quantity' => $totalQuantity]);
            }

            Log::info('Variant inventory updated from Omniful', [
                'sku' => $sku,
                'variant_id' => $variant->id,
                'old_quantity' => $oldQuantity,
                'new_quantity' => $quantity,
            ]);

            return true;
        }

        $product = \App\Models\Product::where('sku', $sku)->first();

        if ($product) {
            $oldQuantity = $product->quantity;
            $product->update(['quantity' => $quantity]);

            Log::info('Product inventory updated from Omniful', [
                'sku' => $sku,
                'product_id' => $product->id,
                'old_quantity' => $oldQuantity,
                'new_quantity' => $quantity,
            ]);

            return true;
        }

        Log::warning('Product/Variant not found for SKU', ['sku' => $sku]);
        return false;
    }

    /**
     * Handle inventory adjustment
     */
    protected function handleInventoryAdjustment(array $data): bool
    {
        $sku = $data['sku'] ?? $data['sku_code'] ?? null;
        $adjustment = $data['adjustment'] ?? null;
        $adjustmentType = $data['adjustment_type'] ?? 'set';
        $reason = $data['reason'] ?? 'omniful_adjustment';

        if (!$sku || $adjustment === null) {
            Log::warning('Invalid inventory adjustment data', ['data' => $data]);
            return false;
        }

        $variant = \App\Models\ProductVariant::where('sku', $sku)->first();

        if ($variant) {
            $oldQuantity = $variant->quantity;

            switch ($adjustmentType) {
                case 'set':
                    $variant->update(['quantity' => $adjustment]);
                    break;
                case 'add':
                case 'increment':
                    $variant->increment('quantity', $adjustment);
                    break;
                case 'subtract':
                case 'decrement':
                    $variant->decrement('quantity', abs($adjustment));
                    break;
            }

            $variant->refresh();

            if ($variant->product) {
                $totalQuantity = \App\Models\ProductVariant::where('product_id', $variant->product_id)
                    ->sum('quantity');
                $variant->product->update(['quantity' => $totalQuantity]);
            }

            Log::info('Variant inventory adjusted from Omniful', [
                'sku' => $sku,
                'variant_id' => $variant->id,
                'old_quantity' => $oldQuantity,
                'new_quantity' => $variant->quantity,
                'adjustment' => $adjustment,
                'type' => $adjustmentType,
                'reason' => $reason,
            ]);

            return true;
        }

        $product = \App\Models\Product::where('sku', $sku)->first();

        if ($product) {
            $oldQuantity = $product->quantity;

            switch ($adjustmentType) {
                case 'set':
                    $product->update(['quantity' => $adjustment]);
                    break;
                case 'add':
                case 'increment':
                    $product->increment('quantity', $adjustment);
                    break;
                case 'subtract':
                case 'decrement':
                    $product->decrement('quantity', abs($adjustment));
                    break;
            }

            $product->refresh();

            Log::info('Product inventory adjusted from Omniful', [
                'sku' => $sku,
                'product_id' => $product->id,
                'old_quantity' => $oldQuantity,
                'new_quantity' => $product->quantity,
                'adjustment' => $adjustment,
                'type' => $adjustmentType,
                'reason' => $reason,
            ]);

            return true;
        }

        Log::warning('Product/Variant not found for SKU', ['sku' => $sku]);
        return false;
    }

    /**
     * Sync product stock
     */
    protected function syncProductStock(array $data): bool
    {
        $products = $data['products'] ?? $data['items'] ?? [];

        if (empty($products)) {
            Log::warning('No products in stock sync data');
            return false;
        }

        $successCount = 0;
        $failCount = 0;

        foreach ($products as $item) {
            $sku = $item['sku'] ?? $item['sku_code'] ?? null;
            $quantity = $item['quantity'] ?? $item['available_quantity'] ?? null;

            if (!$sku || $quantity === null) {
                $failCount++;
                continue;
            }

            $variant = \App\Models\ProductVariant::where('sku', $sku)->first();

            if ($variant) {
                $variant->update(['quantity' => $quantity]);

                if ($variant->product) {
                    $totalQuantity = \App\Models\ProductVariant::where('product_id', $variant->product_id)
                        ->sum('quantity');
                    $variant->product->update(['quantity' => $totalQuantity]);
                }

                $successCount++;
                continue;
            }

            $product = \App\Models\Product::where('sku', $sku)->first();

            if ($product) {
                $product->update(['quantity' => $quantity]);
                $successCount++;
                continue;
            }

            $failCount++;
        }

        Log::info('Bulk stock sync completed', [
            'total' => count($products),
            'success' => $successCount,
            'failed' => $failCount,
        ]);

        return $failCount === 0;
    }

    protected function updateOrderStatus(array $data): bool
    {
        $omnifulOrderId = $data['order_id'] ?? null;
        $status = $data['status'] ?? null;
        $trackingNumber = $data['tracking_number'] ?? null;

        if (!$omnifulOrderId) {
            return false;
        }

        $order = \App\Models\Order::where('omniful_order_id', $omnifulOrderId)->first();

        if ($order) {
            $updateData = ['omniful_status' => $status];

            if ($trackingNumber) {
                $updateData['tracking_number'] = $trackingNumber;
            }

            if ($status === 'shipped') {
                $updateData['status'] = 'shipped';
            }

            $order->update($updateData);

            Log::info('Order status updated', [
                'order_id' => $order->id,
                'status' => $status,
            ]);

            return true;
        }

        return false;
    }

    protected function markOrderDelivered(array $data): bool
    {
        $omnifulOrderId = $data['order_id'] ?? null;

        if (!$omnifulOrderId) {
            return false;
        }

        $order = \App\Models\Order::where('omniful_order_id', $omnifulOrderId)->first();

        if ($order) {
            $order->update([
                'status' => 'delivered',
                'omniful_status' => 'delivered',
            ]);

            Log::info('Order marked as delivered', ['order_id' => $order->id]);

            return true;
        }

        return false;
    }

    protected function cancelOrder(array $data): bool
    {
        $omnifulOrderId = $data['order_id'] ?? null;

        if (!$omnifulOrderId) {
            return false;
        }

        $order = \App\Models\Order::where('omniful_order_id', $omnifulOrderId)->first();

        if ($order) {
            $order->update([
                'status' => 'cancelled',
                'omniful_status' => 'cancelled',
            ]);

            foreach ($order->products as $orderProduct) {
                if ($orderProduct->variant) {
                    $orderProduct->variant->increment('quantity', $orderProduct->quantity);
                }
                if ($orderProduct->product) {
                    $orderProduct->product->increment('quantity', $orderProduct->quantity);
                }
            }

            Log::info('Order cancelled and inventory restored', ['order_id' => $order->id]);

            return true;
        }

        return false;
    }
}
