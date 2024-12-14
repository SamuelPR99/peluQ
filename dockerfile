# Usa una imagen con PHP y Composer preinstalados
FROM composer:2 AS base

# Instala Node.js y npm
RUN apt-get update && apt-get install -y curl && curl -fsSL https://deb.nodesource.com/setup_18.x | bash - && apt-get install -y nodejs

# Establece el directorio de trabajo
WORKDIR /app

# Copia los archivos del proyecto
COPY . .

# Instala las dependencias de Composer y Node.js
RUN composer install --optimize-autoloader --no-dev && npm install && npm run build

# Usa una imagen ligera para correr la aplicación
FROM php:8.3-apache

COPY --from=base /app /var/www/html

# Exponer el puerto
EXPOSE 80
