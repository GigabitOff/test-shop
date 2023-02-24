<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCounterpartyPriceTypeCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('counterparty_price_type_categories', function (Blueprint $table) {
            $table->foreignId('counterparty_id')->constrained('counterparties')
                ->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('category_id')->constrained('categories')
                ->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('price_type_id')->constrained('price_types')
                ->cascadeOnDelete()->cascadeOnUpdate();
            $table->dateTime('date_end')->nullable();

            $table->unique(
                ['counterparty_id', 'category_id'],
                'counterparty_price_type_categories_all_unique'
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
        Schema::dropIfExists('counterparty_price_type_categories');
    }
}
