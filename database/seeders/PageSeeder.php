<?php

namespace Database\Seeders;

use App\Models\Page;
use Illuminate\Database\Seeder;

class PageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->seedPages();
    }

    protected function seedPages()
    {
        $pages = [
            [
                "name" => "main",
                "slug" => "main",
                "uk" => [
                    "title" => "Головна",
                ]
            ],
            [
                "name" => "contacts",
                "slug" => "contacts",
                "uk" => [
                    "title" => "Контакти",

                ]
            ],
            [
                "name" => "about",
                "slug" => "about",
                "uk" => [
                    "title" => "Про компанію",
                ]
            ],
            [
                "name" => "delivery-payment",
                "slug" => "delivery-payment",
                "uk" => [
                    "title" => "Доставка та оплата",
                ]
            ],
            [
                "name" => "privacy-policy",
                "slug" => "privacy-policy",
                "uk" => [
                    "title" => "Використання та обробка інформації",
                ]
            ],
            [
                "name" => "jobs",
                "slug" => "jobs",
                "uk" => [
                    "title" => "Вакансії",
                ]
            ],
            [
                "name" => "vacancies",
                "slug" => "vacancies",
                "uk" => [
                    "title" => "Перелік вакансій",
                ]
            ],
            [
                "name" => "actions",
                "slug" => "actions",
                "uk" => [
                    "title" => "Акції",
                ]
            ],
            [
                "name" => "news",
                "slug" => "news",
                "uk" => [
                    "title" => "Новини",
                ]
            ],
            [
                "name" => "brands",
                "slug" => "brands",
                "uk" => [
                    "title" => "Бренди",
                ]
            ],
            [
                "name" => "reviews",
                "slug" => "reviews",
                "uk" => [
                    "title" => "Відгуки",
                ]
            ],
            [
                "name" => "shop_city",
                "slug" => "shop_cities",
                "uk" => [
                    "title" => "Міста",
                ]
            ],
            [
                "name" => "main-lk",
                "slug" => "main-lk",
                "uk" => [
                    "title" => "Головна ЛК",
                ]
            ],
            [
                "name" => "catalog",
                "slug" => "catalog",
                "hidden" => 1,
                "uk" => [
                    "title" => "Каталог",
                ]
            ],
            [
                "name" => "product",
                "slug" => "product",
                "hidden" => 1,
                "uk" => [
                    "title" => "Товар",
                ]
            ],
        ];

        foreach ($pages as $page) {
            if (Page::whereSlug($page['slug'])->doesntExist()) {
                Page::create($page);
            }
        }
    }
}
