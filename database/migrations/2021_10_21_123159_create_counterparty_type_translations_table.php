<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCounterpartyTypeTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('counterparty_type_translations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('counterparty_type_id')->constrained('counterparty_types')->cascadeOnDelete();
            $table->string('locale')->index();
            $table->string('name');

            $table->unique(['counterparty_type_id', 'locale'], 'translations_counterparty_type_id_locale_unique');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('counterparty_type_translations');
    }
}
