<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class ChangeTriggersOfProductUserPriceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        DB::statement('DROP TRIGGER IF EXISTS `tr_calc_user_current_price_insert`;');
        DB::statement('DROP TRIGGER IF EXISTS `tr_calc_user_current_price_update`;');

        DB::statement('
            CREATE TRIGGER `tr_calc_user_current_price_insert`
            BEFORE INSERT ON `product_user_price`
            FOR EACH ROW BEGIN
                IF NEW.`product` != 0 THEN SET @discount = NEW.`product`;
                ELSEIF NEW.`group` != 0 THEN SET @discount = NEW.`group`;
                ELSEIF NEW.`category` != 0 THEN SET @discount = NEW.`category`;
                ELSEIF NEW.`brand` != 0 THEN SET @discount = NEW.`brand`;
                ELSE SET @discount = 0;
                END IF;
                SET NEW.`calc_retail`= NEW.`retail` * (100 - @discount)/100;
                IF @discount != 0 THEN SET NEW.`calc_wholesale` = NEW.`calc_retail`;
                ELSE SET NEW.`calc_wholesale` = NEW.`wholesale`;
                END IF;
            END;
        ');

        DB::statement('
            CREATE TRIGGER `tr_calc_user_current_price_update`
            BEFORE UPDATE ON `product_user_price`
            FOR EACH ROW BEGIN
                IF NEW.`product` != 0 THEN SET @discount = NEW.`product`;
                ELSEIF NEW.`group` != 0 THEN SET @discount = NEW.`group`;
                ELSEIF NEW.`category` != 0 THEN SET @discount = NEW.`category`;
                ELSEIF NEW.`brand` != 0 THEN SET @discount = NEW.`brand`;
                ELSE SET @discount = 0;
                END IF;
                SET NEW.`calc_retail`= NEW.`retail` * (100 - @discount)/100;
                IF @discount != 0 THEN SET NEW.`calc_wholesale` = NEW.`calc_retail`;
                ELSE SET NEW.`calc_wholesale` = NEW.`wholesale`;
                END IF;
            END;
        ');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
    }
}
