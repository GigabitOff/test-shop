<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCounterpartiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('counterparties', function (Blueprint $table) {
            $table->id();
            $table->string('id_1c')->nullable();
            $table->foreignId('founder_id')->nullable()
                ->constrained('users')->cascadeOnUpdate()->nullOnDelete();
            $table->foreignId('parent_id')->nullable()
                ->constrained('counterparties')->nullOnDelete();
            $table->string('parent_id_1c')->nullable();
            $table->foreignId('type_id')->nullable()
                ->constrained('counterparty_types')->nullOnDelete();
            $table->foreignId('city_id')->nullable()
                ->constrained()->nullOnDelete();
            $table->foreignId('manager_id')->nullable()
                ->constrained('users')->nullOnDelete();
            $table->foreignId('region_manager_id')->nullable()
                ->constrained('users')->nullOnDelete();
            $table->string('name');
            $table->string('okpo');
            $table->string('phone')->nullable();
            $table->boolean('is_nds')->default(false);  // НДС
            $table->boolean('is_payment_cash')->default(true);  // нал / безнал
            $table->boolean('is_can_bonus')->default(true);  // участие в бонусной программе
            $table->string('custom_type')->nullable();
            $table->string('contract')->nullable();     // url контракта
            $table->double('bonus_earned')->default(0);
            $table->double('bonus_used')->default(0);
            $table->double('cashback')->default(0);
            $table->boolean('moderated')->default(false);
            $table->boolean('transferred')->default(false);
            $table->softDeletes();
            $table->timestamps();

            $table->unique(['id', 'okpo']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('counterparties');
    }
}
