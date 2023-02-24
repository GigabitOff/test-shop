<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function(Blueprint $table) {
            $table->id();
            $table->string('id_1c')->nullable();
            $table->string('slug')->unique();
            $table->double('price_init')->default(0);
            $table->double('price_sell')->nullable();
            $table->double('price_rrc')->nullable();
            $table->double('price_purchase')->nullable(); //Ціна закупки
            $table->integer('comission')->nullable(); //Ціна закупки
            $table->biginteger('category_id')->default(0);
            $table->float('depth')->nullable();
            $table->float('width')->nullable();
            $table->float('height')->nullable();
            $table->string('length')->nullable(); //розмір довжина
            $table->float('weight')->nullable();
            $table->string('category_id_1c')->nullable();
            $table->string('type')->nullable();
            $table->string('application')->nullable();
            $table->string('code_1c')->nullable();
            $table->text('brand_search')->nullable();
            $table->string('articul')->nullable(); //артикул товара
            $table->string('articul_search')->nullable();
            $table->string('unit')->nullable(); //одиниця виміру
            $table->unsignedInteger('multiplicity')->default(1);
            $table->unsignedInteger('sort_order')->default(0);
            $table->unsignedInteger('availability')->default(0);
            $table->integer('availability_supplier')->nullable(); //Наявність товару у постачальника
            $table->integer('shipping_payment')->nullable(); //Наявність товару у постачальника
            $table->boolean('cut_out')->default(false); //Раскроить
            $table->string('warranty')->nullable(); //Країна реєстрації бренду
            $table->boolean('deleted')->default(false);
            $table->boolean('imported')->default(false);
            $table->boolean('recommended')->default(false);
            $table->string('replacement_ids')->nullable();
            $table->string('accompanying_ids')->nullable();
            $table->boolean('status')->default(true);
            $table->boolean('status_app')->default(true);
            $table->unsignedInteger('sales')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
