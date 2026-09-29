FROM php:8.3-fpm-alpine
RUN apk add --no-cache $PHPIZE_DEPS \
    && docker-php-ext-install pdo pdo_mysql \
    && docker-php-ext-enable pdo pdo_mysql
WORKDIR /app
EXPOSE 9000
CMD ["php-fpm"]


