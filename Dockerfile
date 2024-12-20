FROM php:8.2-apache

# Instalar dependencias del sistema
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    zip \
    unzip \
    git \
    curl \
    nodejs \
    npm \
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

# Instalar dependencias de PHP y Node.js
RUN composer install --no-dev --optimize-autoloader \
    && npm install \
    && npm run build

# Puerto de escucha
EXPOSE 80

CMD ["apache2-foreground"]
