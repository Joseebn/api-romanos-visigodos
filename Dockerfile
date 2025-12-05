# Imagen base oficial de PHP con CLI
FROM php:8.4-cli

# Evitar preguntas interactivas
ARG DEBIAN_FRONTEND=noninteractive

# Instalar dependencias del sistema necesarias
RUN apt-get update && apt-get install -y \
    libonig-dev \
    libzip-dev \
    unzip \
    git \
    curl \
    mariadb-client \
    && rm -rf /var/lib/apt/lists/*

# Instalar extensiones de PHP necesarias para Eloquent
RUN docker-php-ext-install pdo pdo_mysql

RUN echo "error_reporting = E_ALL & ~E_DEPRECATED & ~E_NOTICE" > /usr/local/etc/php/conf.d/custom.ini \
    && echo "display_errors = On" >> /usr/local/etc/php/conf.d/custom.ini

# Instalar Composer
COPY --from=composer:2 /usr/bin/composer /usr/local/bin/composer

# Crear directorio de trabajo
WORKDIR /var/www/html

# Copiar proyecto al contenedor
COPY . .

# Instalar dependencias PHP con Composer
RUN composer install --no-interaction --optimize-autoloader

# Exponer el puerto
EXPOSE 8080

# Comando por defecto para correr el servidor PHP
CMD ["php", "-S", "0.0.0.0:8080", "-t", "public"]
