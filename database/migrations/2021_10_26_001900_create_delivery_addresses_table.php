<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDeliveryAddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('delivery_addresses', function(Blueprint $table) {
            $table->id();
            $table->string('id_1c')->nullable();
            $table->foreignId('delivery_type_id')
                ->constrained('delivery_types')->cascadeOnDelete();
            $table->morphs('owner');
            $table->foreignId('city_id')->nullable()
                ->constrained('cities')->nullOnDelete();
            $table->string('street_type')->nullable();  // Тип улицы
            $table->string('street_name')->nullable();  // Улица
            $table->string('dom')->nullable();  // Дом
            $table->string('korpus')->nullable();   // Корпус
            $table->string('office')->nullable();   // Офис
            $table->string('city_name')->nullable();    // Наименование населенного пункта
            $table->string('city_guid')->nullable();    // ГУИД населенного пункта из АПИ Новой почты
            $table->string('otdel_number')->nullable(); // Номер отделения Новой почты
            $table->string('otdel_guid')->nullable();   // ГУИД номера отделения из АПИ Новой почты
            $table->string('otdel_name')->nullable();
            $table->text('additional_data')->nullable();    // доп. данные
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
        Schema::dropIfExists('delivery_addresses');
    }
}
