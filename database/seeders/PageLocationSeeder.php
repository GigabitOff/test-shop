<?php

namespace Database\Seeders;

use App\Models\Page;
use App\Models\PageLocation;
use Illuminate\Database\Seeder;

class PageLocationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /**
         * Создаем по одной записи локации типа banner
         * для каждой страницы не имеющей локации такого типа
         */
        Page::query()
            ->withCount(['locations' => fn($q) => $q->onlyTypeBanner()])
            ->chunk(100, function ($chunk) {
                $chunk->each(function (Page $page) {
                    if (empty($page->locations_count)){
                        $page->locations()->create([
                            'type' => PageLocation::TYPE_BANNER,
                            'title:uk' => 'Рекламний банер 1',
                        ]);
                    }
                });
            });
    }
}
