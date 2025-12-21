# ---------- Build stage ----------
FROM php:8.3-fpm-alpine AS build

RUN apk add --no-cache \
    $PHPIZE_DEPS \
    libzip-dev

RUN docker-php-ext-install \
    pdo \
    pdo_mysql \
    opcache

RUN pecl install redis \
    && docker-php-ext-enable redis

# ---------- Runtime stage ----------
FROM php:8.3-fpm-alpine

RUN apk add --no-cache \
    libzip

COPY --from=build /usr/local/lib/php/extensions /usr/local/lib/php/extensions
COPY --from=build /usr/local/etc/php/conf.d /usr/local/etc/php/conf.d

WORKDIR /var/www/html
COPY ./app .

RUN chown -R www-data:www-data /var/www/html
USER www-data

CMD ["php-fpm"]
