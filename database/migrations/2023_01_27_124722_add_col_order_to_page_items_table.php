<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColOrderToPageItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        \App\Models\PageItem::query()
            ->whereDoesntHave('page')
            ->delete();

        Schema::table('page_items', function (Blueprint $table) {
            $table->unsignedBigInteger('page_id')->nullable(false)->change();
            $table->unsignedInteger('order')->default(0)->after('status');
            $table->string('icon')->nullable()->after('image');

            $table->foreign('page_id')->references('id')
                ->on('pages')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('page_items', function (Blueprint $table) {
            $table->dropColumn('order');
            $table->dropColumn('icon');
        });
    }
}
