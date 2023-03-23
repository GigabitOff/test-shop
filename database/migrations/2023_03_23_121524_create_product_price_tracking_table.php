<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductPriceTrackingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_price_tracking', function (Blueprint $table) {
            $table->foreignId('customer_id')->constrained('users')
                ->cascadeOnDelete();
            $table->foreignId('product_id')->constrained('products')
                ->cascadeOnDelete();
            $table->double('product_price')->nullable();
            $table->unique(['customer_id', 'product_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_price_tracking');
    }
}
