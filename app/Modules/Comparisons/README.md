#Модуль Comparisons (Сравнения)
#### v 1.0

### Description
Модуль предназначен для работы со Сравниваемыми товарами.
Работает для зарегистрированных пользователей через связь(relation) 
c товарами из модели пользователя
и для незарегистрированных сохраняя данные в сессии

### Set Up
- Скопировать весь каталог Comparisons в подкаталог App\Modules
- Добавить в файл *config\app.php* в раздел *providers* ссылку на провайдер `App\Modules\Comparisons\ComparisonsServiceProvider::class`.
- Добавить в файл *config\app.php* в раздел *aliases* ссылку на сервис `'ComparisonsService' => App\Modules\Comparisons\ComparisonsProvider::class`.

### Settings

### Examples
````php
/** Добавление товара */
ComparisonsService::addProduct($product_id);
 
/** Удаление товара */
ComparisonsService::removeProduct($product_id); 
````
### ChangeLog
- #### v 1.0
    - Собрана структура модуля
