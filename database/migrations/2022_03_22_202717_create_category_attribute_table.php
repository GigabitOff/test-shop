<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoryAttributeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('category_attribute', function (Blueprint $table) {
            $table->foreignId('category_id')->constrained('categories')
                ->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('attribute_id')->constrained('attributes')
                ->cascadeOnDelete()->cascadeOnUpdate();
            $table->boolean('main')->default(false);

            $table->unique(['category_id', 'attribute_id']);
            $table->index('main');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('category_attribute');
    }
}
