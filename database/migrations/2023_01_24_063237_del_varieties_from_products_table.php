<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DelVarietiesFromProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn('varieties');
        });

        Schema::dropIfExists('product_varieties');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->after('accompanying_ids', function (Blueprint $table) {
                $table->text('varieties')->nullable();
            });
        });

        Schema::create('product_varieties', function (Blueprint $table) {
            $table->id();
            $table->foreignId('cur_product_id')->constrained('products')
                ->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('product_id')->constrained('products')
                ->cascadeOnUpdate()->cascadeOnDelete();

            $table->unique(['cur_product_id', 'product_id']);
        });

    }
}
