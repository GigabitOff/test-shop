<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePersonalOfferProductTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('personal_offer_product', function (Blueprint $table) {
            $table->foreignId('personal_offer_id')->constrained('personal_offers')
                ->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('product_id')->constrained('products')
                ->cascadeOnUpdate()->cascadeOnDelete();
            $table->double('price')->nullable();
            $table->double('discount')->nullable();
            $table->float('min_quantity')->nullable();
            $table->float('max_quantity')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('personal_offer_product');
    }
}
