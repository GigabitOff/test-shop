<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColFounderToCounterpartyAdditionalUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('counterparty_additional_users', function (Blueprint $table) {
            $table->boolean('founder')->after('job')->default(false);
            $table->string('email')->after('job')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('counterparty_additional_users', function (Blueprint $table) {
            $table->dropColumn('founder');
            $table->dropColumn('email');
            //
        });
    }
}
