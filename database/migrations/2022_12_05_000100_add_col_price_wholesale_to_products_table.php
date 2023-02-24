<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColPriceWholesaleToProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->double('price_wholesale')->default(0)->after('price_init');
        });

        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn('price_furniture');
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
            $table->dropColumn('price_wholesale');
            $table->double('price_furniture')->default(0)->after('price_init');
        });
    }
}
