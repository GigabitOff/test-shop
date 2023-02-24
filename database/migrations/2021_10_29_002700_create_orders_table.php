<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function(Blueprint $table) {
            $table->id();
            $table->string('id_1c')->nullable();
            $table->foreignId('customer_id')->constrained('users')->cascadeOnDelete();
            $table->foreignId('counterparty_id')->nullable()
                ->constrained('counterparties')->nullOnDelete()->cascadeOnUpdate();
            $table->foreignId('manager_id')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('driver_id')->nullable()->constrained('drivers')->nullOnDelete();
            $table->foreignId('status_id')->nullable()->constrained('order_status_types')->nullOnDelete();
            $table->foreignId('delivery_address_id')->nullable()->constrained('delivery_addresses')->nullOnDelete();
            $table->string('counterparty_okpo')->nullable();
            $table->string('fio')->nullable();
            $table->string('phone')->nullable();
            $table->string('company')->nullable();
            $table->double('total')->default(0);
            $table->float('total_quantity')->default(0);
            $table->float('total_weight')->default(0);
            $table->float('total_volume')->default(0);
            $table->double('bonus')->default(0);
            $table->double('bonus_used')->default(0);
            $table->double('bonus_earned')->default(0);
            $table->double('cashback_used')->default(0);
            $table->double('cashback_earned')->default(0);
            $table->double('debt_sum')->default(0);
            $table->dateTime('debt_end_at')->nullable();
            $table->dateTime('date_registration')->nullable();
            $table->dateTime('date_delivery')->nullable();
            $table->dateTime('departure_at')->nullable();
            $table->string('type_payment')->nullable();
            $table->unsignedTinyInteger('payment_status')->default(0);
            $table->string('ttn')->nullable();
            $table->string('invoice')->nullable();
            $table->boolean('fast_order')->default(false);
            $table->boolean('callback_off')->default(false);
            $table->text('comment')->nullable();
            $table->boolean('transferred')->default(false);
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
        Schema::dropIfExists('orders');
    }
}
