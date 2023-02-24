<?php

namespace App\Repositories;

use App\Models\Order;
use App\Models\User;

class OrderRepository
{
    public static function addUpdateProduct(Order $order, $product_id, $quantity = 1)
    {
        try {
            if ($order->products()->where('product_id', $product_id)->count()){
                $order->products()
                    ->updateExistingPivot($product_id, ['quantity' => $quantity]);
            } else {
                $order->products()
                    ->attach($product_id, ['quantity' => $quantity]);
            }
        } catch (\Exception $e) {}
    }

    public static function removeProduct(Order $order, $product_id)
    {
        try {
            $order->products()->detach($product_id);
        } catch (\Exception $e) {}
    }

    public static function removeAllProducts(Order $order)
    {
        try {
            $order->products()->detach();
        } catch (\Exception $e) {}
    }

    /**
     * Check if order has product_id or for any products.
     *
     * @param int $product_id
     * @return bool
     */
    public static function isExistProduct(Order $order, $product_id = 0)
    {
        if ($product_id){
            return $order->products()->where('product_id',  $product_id)->exists();
        }
        return $order->products()->exists();
    }

    public static function countProducts(Order $order)
    {
        return $order->products()->count();
    }

    public static function createOrderFromCart(User $user)
    {
        $order = new Order();
        $order->customer()->associate($user);
        $order->save();

        $synced = cart()->products()->keyBy('id')->map(fn($p)=>['quantity' => $p->cartQuantity]);
        $order->products()->sync($synced);

        cart()->clear();

        return $order;
    }
}
