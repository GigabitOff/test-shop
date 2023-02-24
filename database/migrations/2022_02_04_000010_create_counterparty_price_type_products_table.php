<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCounterpartyPriceTypeProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('counterparty_price_type_products', function (Blueprint $table) {
            $table->foreignId('counterparty_id')->constrained('counterparties')
                ->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('price_type_id')->constrained('price_types')
                ->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('product_id')->constrained('products')
                ->cascadeOnDelete()->cascadeOnUpdate();
            $table->dateTime('date_end')->nullable();

            $table->unique(
                ['counterparty_id', 'product_id'],
                'counterparty_price_type_products_all_unique'
            );
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('counterparty_price_type_products');
    }
}
