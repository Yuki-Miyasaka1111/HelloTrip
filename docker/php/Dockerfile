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
    libxml2-dev \
    && rm -rf /var/lib/apt/lists/*

# Node.jsとNPMのインストール
RUN curl -sL https://deb.nodesource.com/setup_16.x | bash - \
    && apt-get install -y nodejs

# PHPの拡張機能をインストール
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

# 作成した設定ファイルをコンテナ内にコピー
COPY ./docker/php/php.ini /usr/local/etc/php/php.ini

# composerのインストール
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# ユーザーを追加
RUN groupadd -g 1000 user && \
    useradd -u 1000 -g user -m user

# 作業ディレクトリの指定
WORKDIR /var/www/html

# Composerを使って依存関係をインストール
COPY ./src /var/www/html
RUN chown -R user:user /var/www/html && su user -s /bin/sh -c "composer install"

# オーナーシップの変更とパーミッションの設定
RUN chown -R user:user /var/www/html \
    && chmod -R 775 /var/www/html/storage

# 以降のRUN、CMD、ENTRYPOINTのコマンドはこのユーザーで実行される
USER user