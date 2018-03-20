## 目录权限
~~~
chmod -R 755 storage

chmod -R 755 bootstrap/cache

sudo chown www-data:www-data storage/oauth-*.key

sudo chmod 600 storage/oauth-*.key
~~~
## laravel依赖
~~~
composer install

composer update
~~~
## 前端打包环境
~~~
npm install -g npm bower yarn gulp

yarn install

bower init

sudo bower install admin-lte

sudo bower install fontawesome

sudo bower install ionicons

~~~
## Database & Seeding
~~~
php artisan migrate

php artisan db:seed
~~~
### Install Laravel Passport with encryption keys to generate secure access tokens.
~~~
php artisan passport:install
~~~
## 后台模板

https://github.com/almasaeed2010/AdminLTE/

## l5-repository

https://github.com/daofirst/l5-repository