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

    protected function getMobileCode(string $countryCode): string
    {
        $mobileCodes = [
            'KW' => '+965', 'SA' => '+966', 'AE' => '+971',
            'BH' => '+973', 'OM' => '+968', 'QA' => '+974',
        ];
        return $mobileCodes[$countryCode] ?? '+965';
    }

    protected function formatPhoneNumber(string $phone, string $countryCode): string
    {
        $cleanPhone = preg_replace('/[^0-9]/', '', $phone);
        $mobileCode = $this->getMobileCode($countryCode);
        if (strlen($cleanPhone) >= 8) {
            return $mobileCode . '-' . chunk_split($cleanPhone, 2, '-');
        }
        return $mobileCode . '-' . $cleanPhone;
    }

    public function createOrder(\App\Models\Order $order)
    {
        try {
            $orderData = $this->formatOrder($order);
            $url = $this->baseUrl . '/sales-channel/public/v1/orders';

            Log::info('Sending order to Omniful', ['order_id' => $order->id]);

            $response = Http::timeout(30)
                ->withHeaders([
                    'Authorization' => 'Bearer ' . $this->accessToken,
                    'Content-Type' => 'application/json',
                    'Accept' => 'application/json',
                ])
                ->post($url, $orderData);

            if ($response->successful()) {
                $responseData = $response->json();
                $omnifulOrderId = $responseData['order_id'] ?? $responseData['data']['order_id'] ?? 'order_' . $order->id;

                $order->update([
                    'omniful_order_id' => $omnifulOrderId,
                    'omniful_status' => 'created',
                ]);

                Log::info('✅ Order sent to Omniful', [
                    'order_id' => $order->id,
                    'omniful_order_id' => $omnifulOrderId,
                ]);

                return ['success' => true, 'data' => $responseData];
            }

            Log::error('Omniful order creation failed', [
                'order_id' => $order->id,
                'status' => $response->status(),
            ]);

            return [
                'success' => false,
                'error' => $response->json()['message'] ?? 'Failed to create order',
            ];

        } catch (\Exception $e) {
            Log::error('Omniful API exception', [
                'order_id' => $order->id,
                'error' => $e->getMessage(),
            ]);

            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    protected function formatOrder(\App\Models\Order $order): array
    {
        $items = [];
        $totalItemTax = 0;
        $totalDiscount = 0;

        foreach ($order->products as $orderProduct) {
            $variant = $orderProduct->variant;
            $product = $orderProduct->product;

            $displayPrice = (float) $orderProduct->price;
            $quantity = (int) $orderProduct->quantity;
            $discount = $orderProduct->offer_price > 0 ? (float) ($orderProduct->price - $orderProduct->offer_price) : 0.0;
            $sellingPrice = $displayPrice - $discount;
            $subtotal = $sellingPrice * $quantity;
            $taxPercent = 10;
            $taxAmount = $subtotal * ($taxPercent / (100 + $taxPercent));
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
                'total' => round($itemTotal, 2),
                'discount' => round($discount * $quantity, 2),
                'tax_inclusive' => true,
            ];
        }

        $countryCode = config('services.omniful.country_code', 'KW');
        $mobileCode = $this->getMobileCode($countryCode);
        $deliveryDate = $order->delivery_date
            ? \Carbon\Carbon::parse($order->delivery_date)->format('dmY')
            : \Carbon\Carbon::now()->addDays(2)->format('dmY');

        $subtotal = (float) $order->sub_total;
        $shippingPrice = (float) $order->delivery_cost;
        $tax = round($totalItemTax, 2);
        $discount = round($totalDiscount, 2);
        $invoiceTotal = $subtotal - $discount + $tax + $shippingPrice;

        return [
            'shipment_type' => 'omniful_generated',
            'order_id' => 'order_' . $order->id,
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
                'phone' => $this->formatPhoneNumber($order->mobile ?? '', $countryCode),
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
                'phone' => $this->formatPhoneNumber($order->mobile ?? '', $countryCode),
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
                'tax' => $tax,
                'discount' => $discount,
                'total' => round($invoiceTotal, 2),
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
                'mobile' => preg_replace('/[^0-9]/', '', $order->mobile ?? ''),
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
                ['key' => 'order_id', 'value' => (string) $order->id],
                ['key' => 'customer_name', 'value' => $order->name ?? 'Customer'],
                ['key' => 'status', 'value' => (string) $order->status],
            ],
            'cancel_order_after_seconds' => 3600,
        ];
    }

    protected function getStateCode(\App\Models\Order $order): string
    {
        $stateCodes = [
            'Hawally' => 'HAW', 'Capital' => 'CAP', 'Ahmadi' => 'AHM',
            'Farwaniya' => 'FAR', 'Jahra' => 'JAH', 'Mubarak Al-Kabeer' => 'MUB',
        ];
        return $stateCodes[optional($order->governorate)->name] ?? 'N/A';
    }

    protected function getFirstName(?string $fullName): string
    {
        if (!$fullName) return 'Customer';
        return explode(' ', trim($fullName))[0];
    }

    protected function getLastName(?string $fullName): string
    {
        if (!$fullName) return '';
        $parts = explode(' ', trim($fullName));
        return count($parts) > 1 ? implode(' ', array_slice($parts, 1)) : '';
    }

    public function handleWebhook(string $eventType, array $data): bool
    {
        Log::info('Processing webhook', ['event' => $eventType]);

        try {
            switch ($eventType) {
                case 'order.created': return $this->handleOrderCreated($data);
                case 'order.updated':
                case 'order.shipped': return $this->updateOrderStatus($data);
                case 'order.delivered': return $this->markOrderDelivered($data);
                case 'order.cancelled': return $this->cancelOrder($data);
                case 'inventory.updated':
                case 'stock.updated': return $this->updateInventory($data);
                case 'inventory.adjustment': return $this->handleInventoryAdjustment($data);
                case 'product.stock_sync': return $this->syncProductStock($data);
                default:
                    Log::info('Unhandled event', ['event_type' => $eventType]);
                    return true;
            }
        } catch (\Exception $e) {
            Log::error('Webhook processing failed', [
                'event' => $eventType,
                'error' => $e->getMessage(),
            ]);
            return false;
        }
    }

    protected function handleOrderCreated(array $data): bool
    {
        $omnifulOrderId = $data['order_id'] ?? $data['id'] ?? null;

        if (!$omnifulOrderId) {
            return false;
        }

        $order = $this->findOrder($omnifulOrderId);
        if ($order) {
            $order->update(['omniful_status' => 'created']);
            Log::info('✅ Order created event processed', ['order_id' => $order->id]);
            return true;
        }

        return true;
    }

    protected function updateInventory(array $data): bool
    {
        $sku = $data['sku'] ?? $data['sku_code'] ?? null;
        $quantity = $data['quantity'] ?? $data['quantity_on_hand'] ?? $data['available_quantity'] ?? null;

        Log::info('=== Updating Inventory ===', [
            'sku' => $sku,
            'quantity' => $quantity,
        ]);

        if (!$sku || $quantity === null) {
            Log::warning('⚠️ Invalid inventory data');
            return false;
        }

        $variant = \App\Models\ProductVariant::where('sku', $sku)->first();

        if ($variant) {
            $oldQuantity = $variant->quantity;
            $variant->update(['quantity' => $quantity]);

            if ($variant->product) {
                $totalQuantity = \App\Models\ProductVariant::where('product_id', $variant->product_id)->sum('quantity');
                $variant->product->update(['quantity' => $totalQuantity]);
            }

            Log::info('✅ Variant inventory updated', [
                'sku' => $sku,
                'old' => $oldQuantity,
                'new' => $quantity,
            ]);

            return true;
        }

        $product = \App\Models\Product::where('sku', $sku)->first();

        if ($product) {
            $oldQuantity = $product->quantity;
            $product->update(['quantity' => $quantity]);

            Log::info('✅ Product inventory updated', [
                'sku' => $sku,
                'old' => $oldQuantity,
                'new' => $quantity,
            ]);

            return true;
        }

        Log::warning('⚠️ SKU not found', ['sku' => $sku]);
        return false;
    }

    protected function handleInventoryAdjustment(array $data): bool
    {
        $sku = $data['sku'] ?? $data['sku_code'] ?? null;
        $adjustment = $data['adjustment'] ?? null;
        $adjustmentType = $data['adjustment_type'] ?? 'set';

        if (!$sku || $adjustment === null) {
            return false;
        }

        $variant = \App\Models\ProductVariant::where('sku', $sku)->first();

        if ($variant) {
            switch ($adjustmentType) {
                case 'set': $variant->update(['quantity' => $adjustment]); break;
                case 'add':
                case 'increment': $variant->increment('quantity', $adjustment); break;
                case 'subtract':
                case 'decrement': $variant->decrement('quantity', abs($adjustment)); break;
            }

            if ($variant->product) {
                $totalQuantity = \App\Models\ProductVariant::where('product_id', $variant->product_id)->sum('quantity');
                $variant->product->update(['quantity' => $totalQuantity]);
            }

            Log::info('✅ Variant adjusted', ['sku' => $sku]);
            return true;
        }

        $product = \App\Models\Product::where('sku', $sku)->first();

        if ($product) {
            switch ($adjustmentType) {
                case 'set': $product->update(['quantity' => $adjustment]); break;
                case 'add':
                case 'increment': $product->increment('quantity', $adjustment); break;
                case 'subtract':
                case 'decrement': $product->decrement('quantity', abs($adjustment)); break;
            }

            Log::info('✅ Product adjusted', ['sku' => $sku]);
            return true;
        }

        return false;
    }

    protected function syncProductStock(array $data): bool
    {
        $products = $data['products'] ?? $data['items'] ?? $data['data'] ?? [];

        if (empty($products)) {
            return false;
        }

        $successCount = 0;

        foreach ($products as $item) {
            $sku = $item['sku'] ?? $item['sku_code'] ?? null;
            $quantity = $item['quantity'] ?? $item['quantity_on_hand'] ?? null;

            if (!$sku || $quantity === null) {
                continue;
            }

            $variant = \App\Models\ProductVariant::where('sku', $sku)->first();

            if ($variant) {
                $variant->update(['quantity' => $quantity]);
                if ($variant->product) {
                    $totalQuantity = \App\Models\ProductVariant::where('product_id', $variant->product_id)->sum('quantity');
                    $variant->product->update(['quantity' => $totalQuantity]);
                }
                $successCount++;
                continue;
            }

            $product = \App\Models\Product::where('sku', $sku)->first();

            if ($product) {
                $product->update(['quantity' => $quantity]);
                $successCount++;
            }
        }

        Log::info('✅ Bulk sync completed', ['success' => $successCount]);
        return $successCount > 0;
    }

    protected function updateOrderStatus(array $data): bool
    {
        $omnifulOrderId = $data['order_id'] ?? $data['id'] ?? null;
        $status = $data['status'] ?? $data['order_status'] ?? null;
        $trackingNumber = $data['tracking_number'] ?? null;

        if (!$omnifulOrderId) {
            return false;
        }

        $order = $this->findOrder($omnifulOrderId);

        if ($order) {
            $updateData = ['omniful_status' => $status];

            if ($trackingNumber) {
                $updateData['tracking_number'] = $trackingNumber;
            }

            if (in_array($status, ['shipped', 'in_transit'])) {
                $updateData['status'] = 'shipped';
            } elseif ($status === 'delivered') {
                $updateData['status'] = 'delivered';
            } elseif ($status === 'cancelled') {
                $updateData['status'] = 'cancelled';
            }

            $order->update($updateData);

            Log::info('✅ Order status updated', [
                'order_id' => $order->id,
                'status' => $status,
            ]);

            return true;
        }

        return false;
    }

    protected function markOrderDelivered(array $data): bool
    {
        $omnifulOrderId = $data['order_id'] ?? $data['id'] ?? null;

        if (!$omnifulOrderId) {
            return false;
        }

        $order = $this->findOrder($omnifulOrderId);

        if ($order) {
            $order->update([
                'status' => 'delivered',
                'omniful_status' => 'delivered',
            ]);

            Log::info('✅ Order delivered', ['order_id' => $order->id]);
            return true;
        }

        return false;
    }

    protected function cancelOrder(array $data): bool
    {
        $omnifulOrderId = $data['order_id'] ?? $data['id'] ?? null;

        Log::info('=== Cancelling Order ===', ['omniful_order_id' => $omnifulOrderId]);

        if (!$omnifulOrderId) {
            Log::error('❌ Missing order_id');
            return false;
        }

        $order = $this->findOrder($omnifulOrderId);

        if (!$order) {
            Log::error('❌ Order not found');
            return false;
        }

        $order->update([
            'status' => 'cancelled',
            'omniful_status' => 'cancelled',
        ]);

        Log::info('Order cancelled, restoring inventory');

        foreach ($order->products as $orderProduct) {
            $quantityToRestore = $orderProduct->quantity;

            if ($orderProduct->variant) {
                $oldQty = $orderProduct->variant->quantity;
                $orderProduct->variant->increment('quantity', $quantityToRestore);
                $orderProduct->variant->refresh();

                Log::info('✅ Variant restored', [
                    'sku' => $orderProduct->variant->sku,
                    'old' => $oldQty,
                    'new' => $orderProduct->variant->quantity,
                ]);
            }

            if ($orderProduct->product) {
                $oldQty = $orderProduct->product->quantity;
                $orderProduct->product->increment('quantity', $quantityToRestore);
                $orderProduct->product->refresh();

                Log::info('✅ Product restored', [
                    'name' => $orderProduct->product->name,
                    'old' => $oldQty,
                    'new' => $orderProduct->product->quantity,
                ]);
            }
        }

        Log::info('=== Order Cancellation Complete ===', [
            'order_id' => $order->id,
        ]);

        return true;
    }

    protected function findOrder(string $omnifulOrderId): ?\App\Models\Order
    {
        $order = \App\Models\Order::where('omniful_order_id', $omnifulOrderId)->first();

        if ($order) {
            return $order;
        }

        if (strpos($omnifulOrderId, 'order_') === 0) {
            $orderId = str_replace('order_', '', $omnifulOrderId);
            $order = \App\Models\Order::find($orderId);

            if ($order) {
                $order->update(['omniful_order_id' => $omnifulOrderId]);
                Log::info('Order found and linked', [
                    'order_id' => $order->id,
                    'omniful_order_id' => $omnifulOrderId,
                ]);
                return $order;
            }
        }

        return null;
    }
}
