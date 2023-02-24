<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePersonalOfferClientTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('personal_offer_client', function (Blueprint $table) {
            $table->foreignId('personal_offer_id')->constrained('personal_offers')
                ->cascadeOnDelete()->cascadeOnUpdate();
            $table->morphs('owner');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('personal_offer_client');
    }
}
