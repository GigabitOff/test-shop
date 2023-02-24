<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RecreateCategoryProductTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $pack = DB::table('category_product')->get()
            ->filter(fn($el) => $el->product_id && $el->category_id)
            ->unique(fn($el) => "{$el->product_id}|{$el->category_id}")
            ->map(fn($el) => (array)$el)
            ->toArray();

        Schema::dropIfExists('category_product');

        Schema::create('category_product', function (Blueprint $table) {
            $table->foreignId('product_id')->constrained('products')
                ->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('category_id')->constrained('categories')
                ->cascadeOnDelete()->cascadeOnUpdate();

            $table->unique(['product_id', 'category_id']);
        });

        DB::table('category_product')->insert($pack);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('category_product', function (Blueprint $table) {
            //
        });
    }
}
