<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateActionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('actions', function (Blueprint $table) {
            $table->id();
            $table->integer('page_id')->default(0);
            $table->bigInteger('user_id')->default(0);
            $table->integer('order')->default(0);
            $table->string('image')->nullable();
            $table->string('image_small')->nullable();
            $table->string('slug')->unique();
            $table->boolean('status')->default(true);
            $table->boolean('on_main')->default(false);
            $table->date('date_start')->nullable();
            $table->date('date_end')->nullable();
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
        Schema::dropIfExists('actions');
    }
}
