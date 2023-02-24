<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColWarehouseIdToDeliveryAddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('delivery_addresses', function (Blueprint $table) {
            $table->string('id_1c')->nullable()->change();
            $table->after('city_id', function (Blueprint $table) {
                $table->foreignId('warehouse_id')->nullable()
                    ->constrained('warehouses')->nullOnDelete()->cascadeOnUpdate();
                $table->string('address_full')->nullable();
                $table->date('departure_at')->nullable();
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
        Schema::table('delivery_addresses', function (Blueprint $table) {
            $table->dropConstrainedForeignId('warehouse_id');
            $table->dropColumn('address_full');
            $table->dropColumn('departure_at');
        });
    }
}
