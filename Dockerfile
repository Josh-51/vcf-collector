# Image PHP
FROM php:8.2-cli

# Dépendances système nécessaires à Laravel
RUN apt-get update && apt-get install -y \
    git unzip libzip-dev \
    && docker-php-ext-install zip pdo pdo_mysql

# Installer Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Dossier de travail
WORKDIR /app

# Copier les fichiers composer
COPY composer.json composer.lock ./

# Installer les dépendances PHP
RUN composer install --no-dev --optimize-autoloader

# Copier tout le reste du projet
COPY . .

# Permissions Laravel
RUN chmod -R 775 storage bootstrap/cache

# Exposer le port Railway
EXPOSE 8000

# Démarrer Laravel (IMPORTANT: $PORT)
CMD php artisan serve --host=0.0.0.0 --port=$PORT
