<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeyToMenuCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('menu_categories', function (Blueprint $table) {
            $table->biginteger('page_id')->unsigned()->change();
            $table->biginteger('category_id')->unsigned()->change();
            $table->biginteger('menu_id')->unsigned()->change();

            $table->unique(['page_id', 'category_id','menu_id']);
            $table->foreign('page_id')->references('id')
                    ->on('pages')->onDelete('cascade');
            $table->foreign('category_id')->references('id')
                    ->on('categories')->onDelete('cascade');

            $table->foreign('menu_id')->references('id')
                    ->on('menus')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('menu_categories', function (Blueprint $table) {
            //
            $table->dropForeign('page_id');
            $table->dropForeign('category_id');
            $table->dropForeign('menu_id');

            $table->dropUnique('page_id');
            $table->dropUnique('category_id');
            $table->dropUnique('menu_id');
        });
    }
}
