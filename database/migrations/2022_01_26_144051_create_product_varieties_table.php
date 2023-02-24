<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductVarietiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_varieties', function (Blueprint $table) {
            $table->id();

            $table->biginteger('cur_product_id')->unsigned();
            $table->biginteger('product_id')->unsigned();
            $table->unique(['cur_product_id', 'product_id']);
            $table->foreign('cur_product_id')->references('id')
                    ->on('products')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('product_varieties');
    }
}
