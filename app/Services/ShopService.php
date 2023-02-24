<?php

namespace App\Services;

use App\Models\Shop;

class ShopService
{
   protected static $shopsData;

    public static function getShopsData()
    {
        if(empty(self::$shopsData))
            self::$shopsData = Shop::get();
        
        return self::$shopsData;
    }
  
}
