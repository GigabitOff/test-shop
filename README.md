# Test project
Laravel project

### Set Up
- Install [Composer](https://getcomposer.org/).
- Run `composer install` to install dependencies.
- Create file *.env* (copy it from *.env.example*) and set your DB connections: *DB_CONNECTION* (mysql, pgsql, sqlsrv, sqlite), *DB_DATABASE*, *DB_PORT*, *DB_USERNAME*, *DB_PASSWORD*.
- To enable Google OAuth set in *.env* next props: GOOGLE_AUTH_CLIENT_ID, GOOGLE_AUTH_CLIENT_SECRET, GOOGLE_AUTH_CLIENT_CALLBACK.
- For production build change environment to production in your *.env* file: *APP_ENV=production*.
- Run `php artisan migrate --seed` to create the database tables and seed the roles and users tables. All users have default password: password.
- Run `php artisan key:generate` to generate app key.
- Run `php artisan storage:link` to create the storage symlink.
- If you use CDN please see `\App\Http\Middleware\TrustProxies` to set trustProxy IPs.
- To clear your cache run `php artisan optimize:clear`.
