   
#!/bin/sh

# ログファイル用書き込み権限変更(winで必要かも)
#chmod -R 777 ./src/storage

# Dockerイメージビルド
docker-compose build --no-cache
# Dockerコンテナ起動
docker-compose up -d

#
# --Dockerイメージビルド後のコンテナ内での処理--
#

# ローカル用環境ファイル
docker-compose run --rm --no-deps app ln -s .env.local .env

# .envにAPP_KEY記載済みなら不要
#docker-compose run --rm --no-deps app php artisan key:generate

# composer
docker-compose run --rm --no-deps app composer install

# autoload更新
docker-compose run --rm --no-deps app composer dump-autoload

# migrate
docker-compose run --rm app php artisan migrate --seed