FROM php:8.2-fpm

# Instalar dependencias del sistema
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    zip \
    unzip \
    git \
    curl \
    && docker-php-ext-install pdo_mysql gd

# Instalar Composer
COPY --from=composer:2.6 /usr/bin/composer /usr/bin/composer

# Establecer el directorio de trabajo
WORKDIR /var/www

# Copiar los archivos del proyecto
COPY . .

# Establecer permisos
RUN chown -R www-data:www-data /var/www \
    && chmod -R 755 /var/www

# Instalar dependencias de PHP
RUN composer install --no-dev --optimize-autoloader

# Puerto de escucha
EXPOSE 9000

CMD ["php-fpm"]
