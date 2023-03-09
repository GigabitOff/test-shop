<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePopupContuctsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('popup_contucts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('popup_id')->constrained('popups')
            ->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('contuct_id')->constrained('contucts')
                ->cascadeOnDelete()->cascadeOnUpdate();

            $table->unique(['popup_id', 'contuct_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('popup_contucts');
    }
}
