ARG PHP_VERSION=8.2

FROM php:${PHP_VERSION}-fpm-alpine

RUN apk update
RUN apk add --no-cache git fcgi mysql-client msmtp perl wget procps shadow libzip \
    openssh libpng libjpeg-turbo libwebp freetype icu icu-data-full \
    gmp gmp-dev zip

RUN apk add --no-cache --virtual build-essentials \
    icu-dev icu-libs zlib-dev g++ make automake autoconf libzip-dev \
    libpng-dev libwebp-dev libjpeg-turbo-dev freetype-dev && \
    docker-php-ext-configure intl && \
    docker-php-ext-configure gmp && \
    docker-php-ext-configure gd --enable-gd --with-freetype --with-jpeg --with-webp && \
    docker-php-ext-install gd && \
    docker-php-ext-install mysqli && \
    docker-php-ext-install pdo_mysql && \
    docker-php-ext-install intl && \
    docker-php-ext-install opcache && \
    docker-php-ext-install exif && \
    docker-php-ext-install zip && \
    docker-php-ext-install gmp && \
    docker-php-ext-install bcmath && \
    apk del build-essentials && rm -rf /usr/src/php*

RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
RUN php composer-setup.php --install-dir=/usr/local/bin --filename=composer
RUN php -r "unlink('composer-setup.php');"
RUN apk add --no-cache bash

ENV SHELL=/bin/bash
ENV COMPOSER_ALLOW_SUPERUSER=1

COPY docker/php-fpm/docker-healthcheck.sh /usr/local/bin/docker-healthcheck
RUN chmod +x /usr/local/bin/docker-healthcheck

HEALTHCHECK --interval=10s --timeout=3s --retries=3 CMD ["docker-healthcheck"]

WORKDIR /srv/app

ENV COMPOSER_ALLOW_SUPERUSER=1

ARG SKELETON="coral-media/crune"
ENV SKELETON ${SKELETON}

ARG STABILITY="stable"
ENV STABILITY ${STABILITY}

ARG CRUNE_VERSION=""
ENV CRUNE_VERSION ${CRUNE_VERSION}

COPY docker/php-fpm/docker-entrypoint.sh /usr/local/bin/docker-entrypoint
RUN chmod +x /usr/local/bin/docker-entrypoint

RUN composer create-project "${SKELETON} ${CRUNE_VERSION}" . --stability=$STABILITY \
    --prefer-dist --no-dev --no-progress --no-interaction;

RUN git config --global init.defaultBranch main

COPY . .

RUN sed -i 's/user = www-data/user = root/g' /usr/local/etc/php-fpm.d/www.conf
RUN sed -i 's/group = www-data/user = root/g' /usr/local/etc/php-fpm.d/www.conf

ENTRYPOINT ["docker-entrypoint"]
CMD ["php-fpm", "-R"]
