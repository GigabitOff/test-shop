<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class AddColUuidToCartProductTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('cart_product', function (Blueprint $table) {
            $table->uuid('uuid')->after('cart_id');
            // uniq - поле идентификации товара
            // позволяет добавлять товары с одинаковым id в коризну и однозначно их определять.
            $table->string('uniq')->nullable()->index()->after('product_id');

        });

        DB::statement('UPDATE cart_product SET `uuid` = UUID();');
        DB::statement('ALTER TABLE cart_product ADD PRIMARY KEY (`uuid`);');

   }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('cart_product', function (Blueprint $table) {
            $table->dropColumn('uuid');
            $table->dropColumn('uniq');
        });
    }
}
