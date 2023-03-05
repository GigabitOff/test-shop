<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPricesColsToServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('services', function (Blueprint $table) {
            $table->double('price_sale_sum')->after('price')->default(0);
            $table->double('price_products_sum')->after('price_sale_sum')->default(0);
            $table->integer('profit')->after('price_products_sum')->default(0);
            $table->double('price_profit_sum')->after('profit')->default(0);

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('services', function (Blueprint $table) {
            $table->dropColumn('price_sale_sum');
            $table->dropColumn('price_products_sum');
            $table->dropColumn('profit');
            $table->dropColumn('price_profit_sum');
            //
        });
    }
}
