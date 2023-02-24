<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function(Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('parent_id')->default(0);
            $table->string('id_1c')->nullable();
            $table->string('parent_id_1c')->nullable();
            $table->string('slug')->unique();
            $table->string('link')->nullable();
            $table->string('image')->nullable();
            $table->string('image_small')->nullable();
            $table->boolean('on_main')->default(false);
            $table->boolean('status')->default(true);
            $table->string('instagram')->nullable();
            $table->string('youtube')->nullable();
            $table->string('facebook')->nullable();
            $table->string('linkedin')->nullable();
            $table->string('twitter')->nullable();
            $table->integer('sort_order')->default(0);
            $table->integer('filter_order')->default(0);
            $table->boolean('filter_status')->default(true);
            $table->boolean('filter_for_desctop')->default(true);
            $table->boolean('filter_for_mobile')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('categories');
    }
}
