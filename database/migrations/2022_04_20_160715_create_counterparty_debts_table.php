<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCounterpartyDebtsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('counterparty_debts', function (Blueprint $table) {
            $table->foreignId('counterparty_id')->constrained('counterparties')
                ->cascadeOnUpdate()->cascadeOnDelete();
            $table->string('id_1c')->nullable();
            $table->string('currency')->nullable();
            $table->double('limit_sum')->default(0);
            $table->integer('limit_days')->default(0);
            $table->double('debt_sum')->default(0);
            $table->double('overdue_sum')->default(0);
            $table->integer('overdue_days')->default(0);
            $table->double('expected_sum')->default(0);
            $table->dateTime('expected_to')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('counterparty_debts');
    }
}
