<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColToServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('services', function (Blueprint $table) {
            $table->foreignId('counterparty_id')->nullable()->after('category_id')->constrained('counterparties')->cascadeOnUpdate()->cascadeOnDelete();
            $table->string('article')->after('slug')->nullable();
            $table->string('unit')->after('article')->nullable();
            $table->boolean('product_with_service')->after('unit')->default(false);


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('services', function (Blueprint $table) {
            $table->dropForeign(['counterparty_id']);
            $table->dropColumn('counterparty_id');
            $table->dropColumn('article');
            $table->dropColumn('unit');
            $table->dropColumn('product_with_service');

        });
    }
}
