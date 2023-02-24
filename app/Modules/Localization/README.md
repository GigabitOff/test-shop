#Модуль Localization
Laravel project

### Description

Модуль предназначен для настройки языковой локали приложения. Выполняет коррекцию url согласно выбранному языку. Для языка по умолчанию оставляет чистый url (без языкового сегмента).

Добавлено пользовательские файлы переводов в storage [VIKTOR]

### Set Up

-   Скопировать весь каталог Localization в подкаталог App\Modules
-   Добавить в файл `config\app.php` в раздел `providers` ссылку на провайдер `App\Modules\Localization\LocalizationServiceProvider::class`.
-   Добавить в файл `config\app.php` в раздел `aliases` ссылку на сервис `'LocalizationService' => App\Modules\Localization\LocalizationService::class`.
-   Добавить в файл `App\Http\Kernel.php` в раздел `$routeMiddleware` ссылку на посредника `'setLocale' => \App\Modules\Localization\SetLocaleMiddleware::class`. Также добавить этого посредника и в группу `web`.
-   Добавить в файл `App\Providers\RouteServiceProvider.php` в группу `web` префикс `->prefix(LocalizationService::locale())`.

Пользовательские файлы переводов:

-   Добавить в файл `App\Providers\AppServiceProvider` в boot - $this->loadTranslationsFrom(storage_path('app/public').'/lang/', 'custom');
-   в папке `\storage\app\public` добавить папку lang

доступ к параметрам: @lang('custom::admin.Category')

### Settings

-   В файле `Localization` поправить возвращаемые значения в функциях `defaultLocale` и `getLocales`.
