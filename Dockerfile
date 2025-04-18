# Utilise l'image PHP 8.0 avec les extensions nécessaires
FROM php:8.0-fpm

# Installe les dépendances pour Laravel
RUN apt-get update && apt-get install -y libpng-dev libjpeg-dev libfreetype6-dev libzip-dev unzip git
RUN docker-php-ext-configure gd --with-freetype --with-jpeg
RUN docker-php-ext-install gd zip pdo pdo_mysql

# Installe Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Répertoire de travail dans le container
WORKDIR /var/www

# Copie les fichiers de ton application dans le container
COPY . .

# Installe les dépendances du projet Laravel
RUN composer install --no-dev --optimize-autoloader

# Expose le port 80
EXPOSE 80

# Commande pour démarrer le serveur PHP
CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=80"]
