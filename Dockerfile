FROM php:8.2-cli

WORKDIR /app

RUN apt-get update && apt-get install -y \
    unzip git libpq-dev \
    && docker-php-ext-install pdo pdo_mysql

COPY . .

RUN php artisan key:generate
RUN php artisan config:clear

EXPOSE 8000

CMD php artisan serve --host=0.0.0.0 --port=8000
