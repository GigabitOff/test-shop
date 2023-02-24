<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentTypesAvailableTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payment_types_available', function(Blueprint $table) {
            $table->unsignedInteger('customer_type_id')->index();
            $table->foreignId('payment_type_id')->constrained()
                ->cascadeOnDelete()->cascadeOnUpdate();

            $table->unique(['customer_type_id' , 'payment_type_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('payment_types_available');
    }
}
