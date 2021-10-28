ARG PHP_VERSION

FROM composer as dependency-manager

WORKDIR /src

COPY composer.json /src/
RUN composer install \
    --ignore-platform-reqs \
    --no-ansi \
    --no-dev \
    --no-interaction \
    --no-scripts

RUN composer dump-autoload #--no-dev --optimize --classmap-authoritative

# Base image
FROM php:${PHP_VERSION}-apache

# Install PHP extensions
RUN pecl install xdebug \
    && docker-php-ext-enable xdebug

# Copy installed dependencies
COPY --from=dependency-manager /src/vendor /var/www/html/vendor/
COPY src/index.php /var/www/html/