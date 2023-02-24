<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateContractsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contracts', function(Blueprint $table) {
            $table->id();
            $table->string('id_1c');
            $table->foreignId('counterparty_id')->constrained()
                ->cascadeOnDelete()->cascadeOnUpdate();
            $table->string('registry_no');
            $table->string('name');
            $table->boolean('status');
            $table->string('payment_type');
            $table->dateTime('valid_at')->nullable();
            $table->dateTime('valid_to')->nullable();
            $table->double('sum')->default(0);
            $table->text('comment')->nullable();
            $table->string('contract_file')->nullable();
            $table->string('statute_file')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('contracts');
    }
}
