<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColToCounterpartiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('counterparties', function (Blueprint $table) {
            $table->string('email')->after('phone')->nullable();
            $table->string('iban')->after('transferred')->nullable();
            $table->string('bank_name')->after('transferred')->nullable();
            $table->string('mfo')->after('transferred')->nullable();
            $table->string('ur_address')->after('transferred')->nullable();
            $table->string('fact_address')->after('transferred')->nullable();
            $table->string('post_address')->after('transferred')->nullable();
            $table->string('nds_certificate')->after('transferred')->nullable();
            $table->string('form_nalog')->after('transferred')->nullable();
            $table->date('date_registration_inn')->after('transferred')->nullable();
            $table->string('inn')->after('transferred')->nullable();
            $table->string('authorized_capital')->after('transferred')->nullable();
            $table->string('owner')->after('transferred')->nullable();
            $table->string('activity_type')->after('transferred')->nullable();
            $table->foreignId('form_id')->after('transferred')->nullable()
                ->constrained('counterparty_forms')->nullOnDelete()->cascadeOnUpdate();
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
            $table->dropColumn('iban');
            $table->dropColumn('bank_name');
            $table->dropColumn('mfo');
            $table->dropColumn('ur_address');
            $table->dropColumn('fact_address');
            $table->dropColumn('post_address');
            $table->dropColumn('nds_certificate');
            $table->dropColumn('form_nalog');
            $table->dropColumn('date_registration_inn');
            $table->dropColumn('inn');
            $table->dropColumn('authorized_capital');
            $table->dropColumn('owner');
            $table->dropColumn('activity_type');
            $table->dropForeign(['form_id']);
            $table->dropColumn('form_id');
            //
        });
    }
}
