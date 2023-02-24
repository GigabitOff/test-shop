<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeyShopIdToContuctsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('contucts', function (Blueprint $table) {
            $table->dropColumn('shop_id');

        });

        Schema::table('contucts', function (Blueprint $table) {
            $table->foreignId('shop_id')->nullable()->after('id')->constrained('shops')
                ->cascadeOnUpdate()->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('contucts', function (Blueprint $table) {
            $table->dropForeign(['shop_id']);
            //$table->dropColumn('shop_id');
            //
        });
    }
}
