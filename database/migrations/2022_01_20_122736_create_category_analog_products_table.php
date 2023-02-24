<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoryAnalogProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('category_analog_products', function (Blueprint $table) {
            $table->id();
            $table->biginteger('category_id')->unsigned();
            $table->biginteger('product_id')->unsigned();

            $table->unique(['category_id', 'product_id']);
            $table->foreign('category_id')->references('id')
                    ->on('categories')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('product_id')->references('id')
                    ->on('products')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('category_analog_products');
    }
}
