<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShopsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shops', function (Blueprint $table) {
            $table->id();
            $table->integer('page_id')->default(0);
            $table->integer('city_id')->default(0);
            $table->text('coords')->nullable();
            $table->string('coords_latitude')->nullable();
            $table->string('coords_longitude')->nullable();
            $table->text('emails')->nullable();
            $table->text('address')->nullable();
            $table->text('phones')->nullable();
            $table->string('image')->nullable();
            $table->string('schedule')->nullable();
            $table->string('whours')->nullable();
            $table->boolean('status')->default(true);
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
        Schema::dropIfExists('shops');
    }
}
