#Модуль расширения для LaravelSocialite
#### v 1.0

### Description
Модуль позволяет добавлять новые провайдеры услуг аутентификации. Принцип работы идентичен работе расширения Socialite.  

### Set Up
- Скопировать весь каталог SocialiteEx в подкаталог App\Modules
- Добавить (или заменить если уже добавлен SocialiteProvider) в файл *config\app.php* в раздел *providers* ссылку на провайдер `App\Modules\SocialiteEx\SocialiteExServiceProvider::class`.
- Добавить (или заменить если уже добавлен SocialiteProvider) в файл *config\app.php* в раздел *aliases* ссылку на сервис `'Socialite' => App\Modules\SocialiteEx\SocialiteExServiceProvider::class`.
- Внимание! Для драйвера *'diia'* добавить в диск *locale* папку *certificate* и покласть туда файл сертификата. 
- Внимание! Для драйвера *'apple'* добавить в корень проекта файл приватного ключа *private_key.p8*. 

### Settings
- Добавить в файл *config\services.php* блок настроек для каждого выбранного драйвера, пример смотри в след пункте.
- ```php 
  // Пример для Дия
  'diia' => [
      'client_id' => env('DIIA_AUTH_CLIENT_ID'),
      'client_secret' => env('DIIA_AUTH_CLIENT_SECRET'),
      'redirect' => env('DIIA_AUTH_CLIENT_CALLBACK'),
      'cert' => env('DIIA_AUTH_CERT'),
  ],
  
  // Пример для БанкID
  'bankid' => [
      'client_id' => env('BANKID_AUTH_CLIENT_ID'),
      'client_secret' => env('BANKID_AUTH_CLIENT_SECRET'),
      'redirect' => env('BANKID_AUTH_CLIENT_CALLBACK'),
  ],
    
  // Пример для Apple
  'apple' => [
      'key_id' => env('APPLE_AUTH_KEY_ID'),
      'team_id' => env('APPLE_AUTH_TEAM_ID'),
      'client_id' => env('APPLE_AUTH_CLIENT_ID'),
      'private_key_file_name' => env('APPLE_AUTH_PRIVATE_KEY_FILE_NAME'),
      'redirect' => env('APPLE_AUTH_CLIENT_CALLBACK'),
  ],
- Заполнить в файле `.env` соответствующие констинты.

### Examples
````php
/**
 * Отправка пользователя  на аутентификацию 
 */
return Socialite::driver('diia')->redirect();
````
````php
/**
 * Получение данных о пользователе 
 * 
 * @var $user array Данные о пользователе. 
 */
$user = Socialite::driver('diia')->user();
````

### ChangeLog
- #### v 1.1
    - Подправлен алгоритм входа по AppleID. Добавлена автогенерация jwt токена. 
- #### v 1.0
    - Собрана структура модуля
    - Добавлен драйвер Diia. 
    - Добавлен драйвер BankID. 
    - Добавлен драйвер Apple. 
