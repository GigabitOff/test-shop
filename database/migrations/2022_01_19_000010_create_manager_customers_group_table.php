<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateManagerCustomersGroupTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Связка менеджеров и групп покупателей
        Schema::create('manager_customers_group', function (Blueprint $table) {
            $table->foreignId('manager_id')
                ->constrained('users')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('group_id')->nullable()
                ->constrained('user_groups')->cascadeOnDelete()->cascadeOnUpdate();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('manager_customers_group');
    }
}
