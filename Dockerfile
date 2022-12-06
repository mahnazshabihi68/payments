FROM php:8.1.13-fpm

RUN apt-get update && apt-get install -y libmcrypt-dev \
    mysql-client --no-install-recommends

    libmagickwand-dev && pecl install imagick \
    && docker-php-ext-enable imagick \
&& docker-php-ext-install mcrypt pdo_mysql

RUN apk add --update --no-cache ${PHPIZE_DEPS} \
        nginx \
        gmp-dev

RUN docker-php-ext-install -j$(nproc) \
		bcmath \
		gd \
		mysqli \
		pdo \
		pdo_mysql \
        gmp \
        zip \
        pcntl


# Installing composer
RUN curl -sS https://getcomposer.org/installer -o composer-setup.php && \
    php composer-setup.php --install-dir=/usr/local/bin --filename=composer && \
    rm -rf composer-setup.php

# Installing
RUN mkdir -p /var/www/html

# Setup Working Dir
WORKDIR /var/www/html
COPY . .
COPY docker/index.php .
COPY env /var/www/html/.env
RUN mkdir -p /var/www/html/storage/logs && \
    touch /var/www/html/storage/logs/laravel.log

RUN chown -R www-data:www-data /var/www/html

# Install project requirements and finish build steps
USER www-data
RUN composer install --no-dev --optimize-autoloader --no-interaction --no-plugins --no-scripts --no-cache


# Prepare nginx and php-fpm configuration
USER root
#PHP : TODO: Check if it works or not
COPY .docker/nginx/nginx.conf /etc/nginx/nginx.conf
COPY .docker/nginx/default.conf /etc/nginx/http.d/default.conf
COPY .docker/entrypoint.sh /usr/bin/entrypoint.sh
RUN chmod +x /usr/bin/entrypoint.sh

ENTRYPOINT ["/usr/bin/entrypoint.sh"]
