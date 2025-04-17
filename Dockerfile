FROM php:8.3-fpm

# Evitar interacciones con paquetes
ENV DEBIAN_FRONTEND noninteractive
ENV TZ=UTC

# Actualizar e instalar dependencias
RUN apt-get update --fix-missing && \
    apt-get install -y --no-install-recommends \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    zip \
    unzip \
    git \
    curl \
    libzip-dev \
    libonig-dev \
    libxml2-dev \
    default-mysql-client \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*

# Configurar e instalar extensiones PHP
RUN docker-php-ext-configure gd --with-freetype --with-jpeg
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd zip

# Instalar Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Establecer directorio de trabajo
WORKDIR /var/www

# Copiar el composer.json y composer.lock primero para aprovechar la caché de Docker
COPY composer.json composer.lock* ./
RUN composer install --prefer-dist --no-scripts --no-dev --no-autoloader && rm -rf /root/.composer

# Copiar código de aplicación
COPY . /var/www/

# Completar la instalación de Composer
RUN composer dump-autoload --no-scripts --no-dev --optimize

# Establecer permisos
RUN chown -R www-data:www-data /var/www
RUN chmod -R 775 /var/www/storage /var/www/bootstrap/cache

# Exponer puerto 9000
EXPOSE 9000

CMD ["php-fpm"]