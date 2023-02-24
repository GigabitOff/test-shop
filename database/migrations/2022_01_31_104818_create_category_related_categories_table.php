<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoryRelatedCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('category_related_categories', function (Blueprint $table) {
            $table->id();
            $table->biginteger('category_id')->unsigned();
            $table->biginteger('related_id')->unsigned();

            $table->unique(['category_id', 'related_id']);
            $table->foreign('category_id')->references('id')
                    ->on('categories')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('related_id')->references('id')
                    ->on('categories')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('category_related_categories');
    }
}
