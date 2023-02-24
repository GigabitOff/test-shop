<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColPaymentTypeIdToOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->after('delivery_address_id', function (Blueprint $table) {
                $table->foreignId('payment_type_id')->nullable()
                    ->constrained('payment_types')->nullOnDelete()->cascadeOnUpdate();
                $table->foreignId('recipient_id')->nullable()
                    ->constrained('customer_recipients')->nullOnDelete()->cascadeOnUpdate();
            });
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropConstrainedForeignId('payment_type_id');
            $table->dropConstrainedForeignId('recipient_id');
            $table->dropColumn('departure_at');
            $table->dropColumn('callback_off');
        });
    }
}
