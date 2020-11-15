FROM composer:2.0.6 AS composer
FROM php:7.4-cli
RUN apt-get update && apt-get install -y libzip-dev zip
RUN docker-php-ext-configure zip && docker-php-ext-install zip
ADD . /app
WORKDIR /app
COPY --from=composer /usr/bin/composer /usr/bin/composer
CMD ["php", "application.php"]
