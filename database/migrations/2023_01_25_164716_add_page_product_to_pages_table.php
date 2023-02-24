<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPageProductToPagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $page = \App\Models\Page::updateOrCreate(
            [
                'slug' => 'product'
            ],
            [
                'name' => 'product',
                'hidden' => 1,
                'status' => 1,
            ]
        );

        $page->locations()->updateOrCreate(
            [
                'page_id' => $page->id,
            ],
            [
                'page_id' => $page->id,
                'type' => 'banner',
            ]
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
    }
}
