#Модуль EDR
#### v 1.0

### Description
Модуль предназначен получения информации о пользователях и компаниях из системы EDR (единый государственный реестр Украины) https://nais.gov.ua/.

### Set Up
- Скопировать весь каталог EDR в подкаталог App\Modules
- Добавить в файл *config\app.php* в раздел *providers* ссылку на провайдер `App\Modules\Edr\EdrServiceProvider::class`.
- Добавить в файл *config\app.php* в раздел *aliases* ссылку на сервис `'EdrService' => App\Modules\Edr\EdrServiceProvider::class`.

### Settings
- Добавить в файл *config\services.php* блок настроек для выбранного драйвера, пример смотри в след пункте.
- ```php 
  // Пример для Edr
  // параметр enabled позволяет отключить модуль на время разнаботки.
  'edr' => [
    'token' => env('EDR_TOKEN'),
    'host' => env('EDR_HOST'),
    'enabled' => env('EDR_ENABLED', true),
  ],```.
- Заполнить в файле `.env` соответствующие константы.

### Examples
````php
Проверка наличия пользователя
/**
 * @var $code string Едрпоу или Инн пользователя.
 * @return bool В отключенном режиме возвращает true и записывает напоминание в лог. 
 */
$status = EdrService::check($code); 
````
### ChangeLog
- #### v 1.0
    - Собрана структура модуля
    - Добавлен функционал проверки ниличия записи о субъекте. 
