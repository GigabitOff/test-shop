<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderStatusTypeTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_status_type_translations', function(Blueprint $table) {
            $table->id();
            $table->foreignId('status_type_id')->constrained('order_status_types')->cascadeOnDelete();
            $table->string('locale')->index();
            $table->string('name');

            $table->unique(['status_type_id', 'locale']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order_status_type_translations');
    }
}
