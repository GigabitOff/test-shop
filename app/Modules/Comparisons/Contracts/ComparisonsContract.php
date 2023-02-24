<?php

namespace App\Modules\Comparisons\Contracts;

interface ComparisonsContract
{
    public function products();

    public function productIds();

    public function clear();

    public function count();

    public function isEmpty();

    public function isNotEmpty();

    public function isExistProduct($product_id);

    public function addProduct($product_id);

    public function removeProduct($product_id);

    public function toggleProduct($product_id);

}
