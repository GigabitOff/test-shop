#Модуль Favourives (Избранное)
#### v 1.0

### Description
Модуль предназначен для работы с Избранными товарами.
Работает для зарегистрированных пользователей через модель Favourite
и для незарегистрированных сохраняя данные в сессии

### Set Up
- Скопировать весь каталог Favourites в подкаталог App\Modules
- Добавить в файл *config\app.php* в раздел *providers* ссылку на провайдер `App\Modules\Favourites\FavoutitesServiceProvider::class`.
- Добавить в файл *config\app.php* в раздел *aliases* ссылку на сервис `'FavouritesService' => App\Modules\Favourites\FavouritesProvider::class`.

### Settings

### Examples
````php
/** Добавление товара в избранное */
FavouritesService::addProduct($product_id);
 
/** Удаление товара из избранного */
FavouritesService::removeProduct($product_id); 
````
### ChangeLog
- #### v 1.0
    - Собрана структура модуля
