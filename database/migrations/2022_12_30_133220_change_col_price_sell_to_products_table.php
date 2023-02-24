<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeColPriceSellToProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->double('price_sale')->nullable();
            $table->boolean('price_sale_show')->default(false);
            $table->dropColumn('price_sell');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->double('price_sell')->nullable();
            $table->dropColumn('price_sale');
            $table->dropColumn('price_sale_show');
        });
    }
}
