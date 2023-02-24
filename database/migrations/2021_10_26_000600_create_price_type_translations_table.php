<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePriceTypeTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('price_type_translations', function(Blueprint $table) {
            $table->id();
            $table->foreignId('price_type_id')->constrained('price_types')->cascadeOnDelete();
            $table->string('locale')->index();
            $table->string('name');

            $table->unique(['price_type_id', 'locale']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('price_type_translations');
    }
}
