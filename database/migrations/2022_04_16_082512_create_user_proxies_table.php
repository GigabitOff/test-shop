<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserProxiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_proxies', function (Blueprint $table) {
            $table->foreignId('from_id')->constrained('users')
                ->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('to_id')->constrained('users')
                ->cascadeOnUpdate()->cascadeOnDelete();
            $table->dateTime('date_to');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_proxies');
    }
}
