# Imagen base con Node.js
FROM node:18 AS build

# Instalar PHP y extensiones necesarias
RUN apt-get update && apt-get install -y \
    php-cli \
    php-mbstring \
    php-xml \
    unzip \
    git \
    curl && \
    curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Establecer directorio de trabajo
WORKDIR /app

# Copiar archivos
COPY . .

# Instalar dependencias
RUN composer install --optimize-autoloader --no-dev && npm install && npm run build

# Fase final con PHP y Apache
FROM php:8.3-apache

# Copiar archivos desde la fase de construcción
COPY --from=build /app /var/www/html

# Exponer el puerto 80
EXPOSE 80
