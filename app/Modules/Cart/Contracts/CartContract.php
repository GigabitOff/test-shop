<?php

namespace App\Modules\Cart\Contracts;

interface CartContract
{
    public function model();

    public function products();

    public function productIds();

    public function productUuids();

    public function clear(): CartContract;

    public function isEmpty(): bool;

    public function isNotEmpty(): bool;

    public function addProduct($product_id, $quantity, $uniq = null, $price_added = null): CartContract;

    public function removeProduct($product_id, $uniq = null): CartContract;

    public function removeProducts($uuid): CartContract;

    public function setQuantity($product_id, $quantity, $uniq = null): CartContract;

    public function setPriceAdded($product_id, $price_added = null, $uniq = null): CartContract;

    public function getQuantity($product_id, $uniq = null);

    public function checkProduct($product_id, $checked, $uniq = null): CartContract;

    public function checkProducts($uuid, $checked): CartContract;

    public function checkedProducts();

    public function checkedProductIds();

    public function checkedProductUuids();

    public function totalQuantity();

    public function totalCost();

    public function totalCartCheckedQuantity();

    public function totalCartCheckedCost();

    public function getProductByUuid($uuid);

}
