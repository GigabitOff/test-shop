<?php

namespace App\Services;

use App\Models\Order;
use App\Models\OrderEdited;
use App\Models\OrderStatusType;
use App\Models\User;
use Illuminate\Support\Arr;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class OrdersService
{

    /**
     * Return Order instance or null. Cache it in static variable.
     * @param $id
     * @return Order|null
     */
    public function getOrder($id): ?Order
    {
        static $orders = [];

        if (empty($orders[$id]) && (int)$id) {
            $orders[$id] = Order::find($id);
        }

        return $orders[$id] ?? null;
    }

    /**
     * @return Order
     * @throws \Throwable
     */
    public function createOrderFromCart(User $customer = null, $bonus = 0): Order
    {
        $customer = $customer ?? auth()->user();

        /** @var Order $order */
        $order = $customer->orders()->create();
        $order->status_id = Order::ORDER_NEW_STATUS_ID;
        $order->total = cart()->totalCartCheckedCost() - $bonus;
        $order->total_quantity = cart()->totalCartCheckedQuantity();
        $order->save();

        cart()->checkedProducts()
            ->each(function ($el) use ($order) {
                $offer = $el->personalOffer;
                $id = $offer->id ?? $el->id;
                $options = $offer ? ['personal_offer_id_1c' => $offer->id_1c] : null;
                $order->products()->attach($id, [
                    'price' => $el->price,
                    'quantity' => $el->cartQuantity,
                    'options' => $options,
                ]);
                if ($offer) {
                    $offer->quantity -= $el->cartQuantity;
                    $offer->save();
                }
                cart()->removeProducts($el->id);
            });

        return $order;
    }

    /**
     * Create fast order for currently visited product
     *
     * @return Order
     * @throws \Throwable
     */
    public function createFastOrder(User $customer = null, array $data = []): Order
    {
        $product_price = $data['product_price'] ?? 0;
        $product_quantity = $data['product_quantity'] ?? 1;
        $customer = $customer ?? auth()->user();
        /** @var Order $order */
        $order = $customer->orders()->create();
        $order->status_id = Order::ORDER_NEW_STATUS_ID;
        $order->total = $product_price * $product_quantity;
        $order->total_quantity = $product_quantity;
        $order->fio = $customer->name;
        $order->comment = $data['comment'] ?? '';
        $order->fast_order = true;
        $order->products()->attach($data['product_id'], [
            'price' => $product_price,
            'quantity' => $product_quantity,
        ]);
        $order->save();

        return $order;
    }

    public function replicateOrder(int $orderId): ?Order
    {
        if ($order = Order::query()->find($orderId)) {
            $order->load('products');
            $clone = $order->replicate();
            $clone->status_id = OrderStatusType::STATUS_DRAFT;
            $clone->created_at = Carbon::now();
            $clone->push();
            foreach ($order->products as $product) {
                $extra_attributes = Arr::except($product->pivot->getAttributes(), $product->pivot->getForeignKey());
                $clone->products()->attach($product, $extra_attributes);
            }
        }

        return $clone ?? null;
    }

    public function setOrderEdited(int $orderId): ?OrderEdited
    {
        if ($order = $this->getOrder($orderId)) {
            try {
                DB::BeginTransaction();

                $attributes = $order->getAttributes();
                $attributes['order_id'] = $order->id;

                $edited = OrderEdited::create($attributes);

                $products = $order->products->keyBy('id')
                    ->map(function ($product) {
                        $attributes =
                            Arr::except($product->pivot->getAttributes(), $product->pivot->getForeignKey());

                        $attributes['old_qty'] = $product->pivot->quantity;

                        // Вызываем свойство явно что бы раскодировать json строку options
                        // т.к. при сохранении она опять кодируется
                        $attributes['options'] = $product->pivot->options;

                        return $attributes;
                    });

                $edited->products()->sync($products);

                $order->status_id = OrderStatusType::STATUS_EDITED;
                $order->edited_id = $edited->id;
                $order->save();

                DB::commit();
            } catch (\Exception $e) {
                logger('Error in:' . __METHOD__ . ': ' . $e->getMessage(), ['orderId' => $orderId]);
                DB::rollBack();
                return null;
            }
        }

        return $edited ?? null;
    }

    public function cancelOrderEditing(int $orderId): ?Order
    {
        if ($order = $this->getOrder($orderId)) {
            try {
                DB::beginTransaction();

                $edited = $order->editedCopy;
                $order->status_id = $edited->status_id;
                $order->save();
                $order->editedCopy()->delete();

                $order->refresh();

                DB::commit();
            } catch (\Exception $e) {
                logger('Error in:' . __METHOD__ . ': ' . $e->getMessage(), ['orderId' => $orderId]);
                DB::rollBack();
                return null;
            }
        }

        return $order ?? null;
    }

    /**
     * Update order products from edited copy.
     *
     * @param int $orderId
     * @param int $bonus
     * @return Order
     */
    public function updateOrderFromEdited(int $orderId = 0, int $bonus = 0): Order
    {
        /** @var Order $order */
        $order = $this->getOrder($orderId);
        $edited = $order->editedCopy;

        $products = $edited->products->keyBy('id')
            ->map(function ($product) {
                //return Arr::except($product->pivot->getAttributes(), $product->pivot->getForeignKey());

                $attributes =
                    Arr::except($product->pivot->getAttributes(), $product->pivot->getForeignKey());

                unset($attributes['old_qty']);

                // Вызываем свойство явно что бы раскодировать json строку options
                // т.к. при сохранении она опять кодируется
                $attributes['options'] = $product->pivot->options;

                return $attributes;
            });

        $order->products()->sync($products);

        if ($order->bonus_used) {
            bonuses()->discardBonus($order->customer_id, $order->id, $order->bonus_used);
        }

        $attributes = collect($edited->getAttributes())
            ->except(['id', 'order_id', 'created_at', 'updated_at']);

        foreach ($attributes as $attribute => $value) {
            $order->{$attribute} = $value;
        }

        if ($order->bonus_used) {
            bonuses()->expenseBonus($order->customer->id, $order->id, $order->bonus_used);
        }

        $order->save();

        return $order;
    }
}
