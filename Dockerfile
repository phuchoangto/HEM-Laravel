FROM php:8.0.0RC3-fpm-alpine3.12

RUN apt-get update -y && apt-get install -y libmcrypt-dev

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
RUN docker-php-ext-install pdo mbstring

WORKDIR /app
COPY . /app

RUN composer install

EXPOSE 8000

CMD php artisan migrate:fresh --seed && php artisan serve --host=0.0.0.0 --port=8000