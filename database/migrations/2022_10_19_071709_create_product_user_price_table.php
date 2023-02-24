<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateProductUserPriceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_user_price', function (Blueprint $table) {
            $table->foreignId('user_id')->constrained('users')
                ->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('product_id')->constrained('products')
                ->cascadeOnUpdate()->cascadeOnDelete();
            $table->float('init')->default(0);
            $table->float('current')->default(0);
            $table->float('brand')->default(0);
            $table->float('category')->default(0);
            $table->float('group')->default(0);
            $table->float('product')->default(0);

            $table->unique(['user_id', 'product_id']);
        });

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
                SET NEW.`current`= NEW.`init` * (100 - @discount)/100;
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
                SET NEW.`current`= NEW.`init` * (100 - @discount)/100;
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
        Schema::dropIfExists('product_user_price');

        DB::statement('DROP TRIGGER IF EXISTS `tr_calc_user_current_price_insert`;');
        DB::statement('DROP TRIGGER IF EXISTS `tr_calc_user_current_price_update`;');
    }
}
