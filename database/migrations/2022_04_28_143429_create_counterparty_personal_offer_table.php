<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCounterpartyPersonalOfferTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('counterparty_personal_offer', function (Blueprint $table) {
            $table->foreignId('counterparty_id')->constrained('counterparties')
                ->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('personal_offer_id')->constrained('personal_offers')
                ->cascadeOnDelete()->cascadeOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('counterparty_personal_offer');
    }
}
