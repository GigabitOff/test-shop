<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeTableServicesToservicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('services', function (Blueprint $table) {
            //$table->dropColumn('on_main');
            //$table->dropColumn('on_footer');
            $table->integer('quantity')->nullable()->after('price');
            $table->integer('age_limit')->nullable()->after('quantity');
            $table->boolean('abonement')->default(false)->after('age_limit');
            $table->boolean('show_calendar')->default(false)->after('abonement');
            $table->string('image_bg')->nullable()->after('image');
            $table->date('date_start')->nullable()->after('image_bg');
            $table->date('date_end')->nullable()->after('date_start');

            $table->foreignId('category_id')->nullable()->after('id')->constrained('categories')
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
        Schema::table('services', function (Blueprint $table) {

            $table->dropColumn('quantity');
            $table->dropColumn('age_limit');
            $table->dropColumn('show_calendar');
            $table->dropColumn('abonement');
            $table->dropColumn('image_bg');
            $table->dropColumn('date_start');
            $table->dropColumn('date_end');
            $table->dropForeign(['category_id']);

            $table->boolean('on_main')->default(false)->after('price');
            $table->boolean('on_footer')->default(false)->after('price');
        });
    }
}
