# 移動
cd src

# composer
composer install

# autoload更新
composer dump-autoload

# migrate
php artisan migrate

# laravel-admin
php artisan vendor:publish --provider="Encore\Admin\AdminServiceProvider"
php artisan admin:install

#seed
php artisan db:seed