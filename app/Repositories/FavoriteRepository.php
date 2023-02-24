<?php

namespace App\Repositories;

use App\Models\Product;
use App\Models\User;

class FavoriteRepository
{
    public static function addUpdateByUser(User $user, $product_id, $quantity = 1)
    {
        try {
            if ($user->favouriteProducts()->where('product_id', $product_id)->count()){
                $user->favouriteProducts()
                    ->updateExistingPivot($product_id, ['quantity' => $quantity]);
            } else {
                $user->favouriteProducts()
                    ->attach($product_id, ['quantity' => $quantity]);
            }
        } catch (\Exception $e) {}
    }

    public static function removeByUser(User $user, $product_id)
    {
        try {
            $user->favouriteProducts()->detach($product_id);
        } catch (\Exception $e) {}
    }

    public static function removeAllByUser(User $user)
    {
        try {
            $user->favouriteProducts()->detach();
        } catch (\Exception $e) {}
    }

    public static function toggleByUser(User $user, $product_id)
    {
        if ($user && $product_id){
            $user->favouriteProducts()->toggle($product_id);
        } else {
            throw new \Exception('Not enough arguments');
        }
    }

    public static function toggleByProduct(Product $product, $user_id)
    {
        if ($user_id && $product){
            $product->favoritesUsers()->toggle($user_id);
        } else {
            throw new \Exception('Not enough arguments');
        }
    }

    /**
     * Check if product has favorites for user_id or for any users.
     *
     * @param int $user_id
     * @return bool
     */
    public static function isExistByProduct(Product $product, $user_id = 0)
    {
        if ($user_id){
            return $product->favoritesUsers()->where('user_id',  $user_id)->exists();
        }
        return $product->favoritesUsers()->exists();
    }

    /**
     * Check if user has favorites for product_id or for any products.
     *
     * @param int $product_id
     * @return bool
     */
    public static function isExistByUser(User $user, $product_id = 0)
    {
        if ($product_id){
            return $user->favouriteProducts()->where('product_id',  $product_id)->exists();
        }
        return $user->favouriteProducts()->exists();
    }

    public static function countByUser(User $user)
    {
        return $user->favouriteProducts()->count();
    }
}
