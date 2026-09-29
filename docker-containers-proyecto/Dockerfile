# Dockerfile para PHP 8.2 con extensiones útiles

FROM php:8.2-fpm

# Instalar dependencias del sistema
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libzip-dev \
    unzip \
    git \
    curl \
    && rm -rf /var/lib/apt/lists/*

# Instalar extensiones PHP
RUN docker-php-ext-configure gd \
        --with-freetype \
        --with-jpeg \
    && docker-php-ext-install -j$(nproc) \
        gd \
        pdo \
        pdo_mysql \
        mysqli \
        zip \
        json \
        curl \
        mbstring \
        bcmath \
        ctype \
        fileinfo

# Copiar configuración personalizada
COPY php.ini /usr/local/etc/php/conf.d/custom.ini

# Establecer directorio de trabajo
WORKDIR /var/www/html

# Usuario para correr PHP
RUN useradd -m -u 1000 phpuser && chown -R phpuser:phpuser /var/www/html
USER phpuser

# Exponer puerto FPM
EXPOSE 9000

# Comando por defecto
CMD ["php-fpm"]
