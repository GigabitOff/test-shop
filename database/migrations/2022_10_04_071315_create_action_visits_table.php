<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateActionVisitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('action_visits', function (Blueprint $table) {
            $table->id();
            $table->foreignId('action_id')->constrained()
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
        Schema::dropIfExists('action_visits');
    }
}
