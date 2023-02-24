<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColsStockToProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->after('sort_order', function(Blueprint $table) {
               $table->double('stock')->default(0);
               $table->double('reserve')->default(0);
               $table->unsignedInteger('reserve_days')->default(1);
               $table->boolean('on_backorder')->default(false);
               $table->boolean('show_stock')->default(true);
            });
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
            $table->dropColumn('stock');
            $table->dropColumn('on_backorder');
            $table->dropColumn('show_stock');
            $table->dropColumn('reserve_days');
        });
    }
}
