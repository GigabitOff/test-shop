<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserContuctTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_contuct', function (Blueprint $table) {
            $table->foreignId('user_id')->constrained('users')
            ->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('contuct_id')->constrained('contucts')
                ->cascadeOnDelete()->cascadeOnUpdate();

            $table->unique(['user_id', 'contuct_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_contuct');
    }
}
