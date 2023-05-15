# ベースイメージの指定
FROM php:fpm-buster

# パッケージのインストール
RUN apt-get update && apt-get install -y \
    git \
    zip \
    unzip \
    vim \
    libpng-dev \
    libonig-dev \
    libxml2-dev

# Node.jsとNPMのインストール
RUN curl -sL https://deb.nodesource.com/setup_16.x | bash - \
    && apt-get install -y nodejs

# PHPの拡張機能をインストール
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

# 作成した設定ファイルをコンテナ内にコピー
COPY ./docker/php/php.ini /usr/local/etc/php/php.ini

# composerのインストール
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# 作業ディレクトリの指定
WORKDIR /var/www/html

# Composerを使って依存関係をインストール
COPY ./src /var/www/html
RUN chown -R www-data:www-data /var/www/html && su www-data -s /bin/sh -c "composer install"

# オーナーシップの変更とパーミッションの設定
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 775 /var/www/html/storage

# Laravelのストレージとキャッシュディレクトリのパーミッションを設定
RUN php artisan cache:clear \
    && php artisan config:clear \
    && php artisan view:clear \
    && php artisan route:clear
