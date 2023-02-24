#Модуль SMS
#### v 1.0

### Description
Модуль предназначен работы с серверами sms рассылок. 

### Set Up
- Скопировать весь каталог SMS в подкаталог App\Modules
- Добавить в файл *config\app.php* в раздел *providers* ссылку на провайдер `App\Modules\Sms\SmsServiceProvider::class`.
- Добавить в файл *config\app.php* в раздел *aliases* ссылку на сервис `'SmsService' => App\Modules\Sms\SmsServiceProvider::class`.

### Settings
- Добавить в файл *config\services.php* блок настроек для выбранного драйвера, пример смотри в след пункте.
- ```php 
  // Пример для SvitSms
  'svitsms' => [
    'user' => env('SVITSMS_USER'),
    'password' => env('SVITSMS_PASSWORD'),
    'alfa' => env('SVITSMS_ALFA'),
  ],```.
- Замолнить в файле `.env` соответствующие констинты.

### Examples
````php
Отправка СМС
/**
 * @var $status string|bool Ответ сервера или false в случае ошибки. 
 */
$status = SmsService::driver('svitsms')
    ->sendMessage('380123456789', 'testsms', 'description');
````
````php
Получение баланса
/**
 * @var $balance string|bool Ответ сервера или false в случае ошибки. 
 */
$balance = SmsService::driver('svitsms')->getBalance();
````

### ChangeLog
- #### v 1.1
    - Добавлен драйвер ESputnik. Драйвер выполняет только 2 функции: рассылка по одиночным и множественным контактам и проверка баланса.
- #### v 1.0
    - Собрана структура модуля
    - Добавлен драйвер SvitSms. Драйвер выполняет только 2 функции: рассылка по одиночным контактам и проверка баланса. 
