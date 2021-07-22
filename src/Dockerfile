FROM php:7.4-cli

WORKDIR /app

RUN docker-php-ext-install pdo pdo_mysql sockets
RUN curl -sS https://getcomposer.org/installer | php -- \
     --install-dir=/usr/local/bin --filename=composer

RUN docker-php-source extract \
    # do important things \
    && docker-php-source delete

RUN apt-get update && apt-get install -y \
        libfreetype6-dev \
        libjpeg62-turbo-dev \
        libpng-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) gd

COPY . .
RUN composer install

CMD php artisan serve --host=0.0.0.0
EXPOSE 8000

CMD php artisan queue:work
