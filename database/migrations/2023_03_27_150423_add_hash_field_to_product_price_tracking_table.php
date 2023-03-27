<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddHashFieldToProductPriceTrackingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('product_price_tracking', function (Blueprint $table) {
            @$table->bigIncrements('id')->first();
            @$table->string('hash', 40)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('product_price_tracking', function (Blueprint $table) {
            $table->dropColumn('hash');
            $table->dropColumn('id');
        });
    }
}

