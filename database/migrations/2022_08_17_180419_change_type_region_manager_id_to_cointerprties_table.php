<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeTypeRegionManagerIdToCointerprtiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('counterparties', function (Blueprint $table) {
            $table->dropConstrainedForeignId('region_manager_id');
        });

        Schema::table('counterparties', function (Blueprint $table) {
            $table->text('region_manager_id')->after('manager_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('counterparties', function (Blueprint $table) {
            $table->dropColumn('region_manager_id');
            $table->foreignId('region_manager_id')->after('manager_id')->nullable()
                ->constrained('users')->nullOnDelete();
        });
    }
}
