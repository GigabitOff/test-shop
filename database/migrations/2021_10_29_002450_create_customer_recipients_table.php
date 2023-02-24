<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomerRecipientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customer_recipients', function (Blueprint $table) {
            $table->id();
            $table->foreignId('customer_id')->constrained('users')
                ->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('delivery_address_id')->nullable()
                ->constrained('delivery_addresses')->cascadeOnDelete()->cascadeOnUpdate();
            $table->string('name');
            $table->string('inn', 25)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('customer_recipients');
    }
}
