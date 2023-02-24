<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserChangesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_changes', function (Blueprint $table) {
            $table->foreignId('user_id')->constrained('users')
                ->cascadeOnDelete()->cascadeOnUpdate();
            $table->string('name')->nullable();
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->dateTime('birth_date')->nullable();
            $table->string('position')->nullable();
            $table->foreignId('city_id')->nullable()
                ->constrained()->nullOnDelete();
            $table->foreignId('payment_type_id')->nullable()
                ->constrained('payment_types')->cascadeOnDelete();
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
        Schema::dropIfExists('user_changes');
    }
}
