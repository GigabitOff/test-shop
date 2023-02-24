<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContuctsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contucts', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->default(0);
            $table->integer('parent_id')->default(0);
            $table->integer('shop_id')->default(0);
            $table->string('email')->nullable();
            $table->text('emails')->nullable();
            $table->text('phones')->nullable();
            $table->string('phone')->nullable();
            $table->string('image')->nullable();
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
        Schema::dropIfExists('contucts');
    }
}
