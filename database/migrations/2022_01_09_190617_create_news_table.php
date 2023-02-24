<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('news', function (Blueprint $table) {
            $table->id();
            $table->integer('parent_id')->default(0);
            $table->integer('page_id')->default(0);
            $table->integer('category_id')->default(0);
            $table->integer('user_id')->nullable();
            $table->string('name')->nullable();
            $table->string('image')->nullable();
            $table->string('image_bg')->nullable();
            $table->string('image_small')->nullable();
            $table->longtext('galery')->nullable();
            $table->string('slug')->unique();
            $table->boolean('status')->default(true);
            $table->integer('order');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('news');
    }
}
