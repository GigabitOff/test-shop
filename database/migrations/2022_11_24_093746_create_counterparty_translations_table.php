<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCounterpartyTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('counterparty_translations', function (Blueprint $table) {
            $table->id();
            $table->biginteger('counterparty_id')->unsigned();
            $table->string('locale')->index();
            $table->string('form')->nullable();
            $table->string('title')->nullable();
            $table->text('description')->nullable();
            $table->text('body')->nullable();

            $table->unique(['counterparty_id', 'locale']);
            $table->foreign('counterparty_id')->references('id')
                ->on('counterparties')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('counterparty_translations');
    }
}
