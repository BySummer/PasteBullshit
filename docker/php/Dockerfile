FROM php:8.2-fpm-alpine3.18

ARG USER_ID=1000
ARG GROUP_ID=1000
ARG USE_XDEBUG

ENV BUILD_DEPS \
    autoconf \
    bash \
    build-base \
    libzip-dev \
    pcre-dev \
    shadow

RUN apk add --no-cache  \
      libzip gd libpng-dev gmp-dev icu-dev \
    && apk add --no-cache --virtual .build-deps ${BUILD_DEPS} \
    && cd /tmp \
    && docker-php-ext-configure gd --enable-gd \
    && docker-php-ext-configure intl \
    && docker-php-ext-install -j$(nproc) gd \
    && docker-php-ext-install pdo_mysql pcntl opcache zip gd gmp intl \
    && apk add --update linux-headers \
    && if [ ${USE_XDEBUG} = 1 ]; then pecl install xdebug-3.2.2 && docker-php-ext-enable xdebug; fi \
    && usermod -u ${USER_ID} www-data \
    && groupmod -g ${GROUP_ID} www-data \
    && apk del -f .build-deps

RUN apk add git

RUN curl -sS https://getcomposer.org/installer | php -- --version=2.3.3  --install-dir=/usr/local/bin --filename=composer

WORKDIR /var/www

USER www-data

CMD php-fpm