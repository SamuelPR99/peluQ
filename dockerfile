# Imagen base con PHP, Composer y Node.js
FROM node:18 as build

# Instalar PHP y Composer
RUN apt-get update && apt-get install -y php-cli unzip git curl && \
    curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Establecer directorio de trabajo
WORKDIR /app

# Copiar archivos
COPY . .

# Instalar dependencias
RUN composer install --optimize-autoloader --no-dev && npm install && npm run build

# Fase final
FROM php:8.3-apache
COPY --from=build /app /var/www/html
EXPOSE 80
