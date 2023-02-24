<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColShipingPaymentToProductTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('product_translations', function (Blueprint $table) {
            $table->string('shipping_payment')->after('seller')->nullable();

        });

        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn('shipping_payment');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('product_translations', function (Blueprint $table) {
            $table->dropColumn('shipping_payment');
            //
        });

        Schema::table('products', function (Blueprint $table) {
            $table->string('shipping_payment')->after('availability_supplier')->nullable();
        });

    }
}
