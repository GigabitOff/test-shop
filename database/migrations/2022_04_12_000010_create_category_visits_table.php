<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoryVisitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('category_visits', function(Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->constrained()
                ->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('user_id')->nullable()
                ->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->string('unregister_user_key')->nullable();
            $table->string('ip', 50)->nullable();
            $table->string('referer')->nullable();
            $table->unsignedInteger('quantity')->default(1);
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
        Schema::dropIfExists('category_visits');
    }
}
