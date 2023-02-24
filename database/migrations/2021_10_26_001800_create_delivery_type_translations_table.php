<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDeliveryTypeTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('delivery_type_translations', function(Blueprint $table) {
            $table->id();
            $table->foreignId('delivery_type_id')->constrained('delivery_types')->cascadeOnDelete();
            $table->string('locale')->index();
            $table->string('name');

            $table->unique(['delivery_type_id', 'locale']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('delivery_type_translations');
    }
}
