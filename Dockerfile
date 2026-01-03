FROM php:8.4-cli

# Dépendances système
RUN apt-get update && apt-get install -y \
    git unzip libzip-dev \
    && docker-php-ext-install zip pdo pdo_mysql

# Installer Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /app

# Copier tout le projet (artisan inclus)
COPY . .

# Installer les dépendances Laravel
RUN composer install --no-dev --optimize-autoloader

# Permissions
RUN chmod -R 775 storage bootstrap/cache

EXPOSE 8000

# Lancer Laravel sur Railway
CMD php artisan serve --host=0.0.0.0 --port=$PORT
