# ===================================================================================================
#                                          --- Base ---
# ===================================================================================================
FROM php:8.0-fpm-alpine3.15 AS php

FROM php AS s6overlay

### install s6 overlay
RUN set -eux; \
    curl -sL https://github.com/just-containers/s6-overlay/releases/download/v2.2.0.3/s6-overlay-amd64.tar.gz -o /tmp/s6overlay.tar.gz; \
    tar xzf /tmp/s6overlay.tar.gz -C /; \
    rm /tmp/s6overlay.tar.gz;
ENV S6_KEEP_ENV=1;
ENV S6_BEHAVIOUR_IF_STAGE2_FAILS=2;
ENV S6_SYNC_DISKS=1;

FROM s6overlay AS base

WORKDIR /app

RUN set -eux; \
    apk update; \
    apk add git; \
    apk add zip; \
    apk add unzip; \
    apk add nginx; \
    apk add supervisor; \
    apk add tzdata; \
    apk add musl; \
    apk add libxml2-dev; \
    apk add php8-intl; \
    apk add php8-opcache; \
    apk add php8-common; \
    apk add php8-xml; \
    apk add php8-zip; \
    apk add php8-soap; \
    apk add php8-pdo; \
    apk add php8-pdo_pgsql; \
    mkdir -p /run/nginx;

COPY docker/rootfs/ /

# Install composer
COPY --from=composer:2.1 /usr/bin/composer /usr/bin/composer
ENV PATH="${PATH}:/root/.composer/vendor/bin"
ENV COMPOSER_ALLOW_SUPERUSER=1
ENV COMPOSER_MEMORY_LIMIT=-1
ARG COMPOSER_AUTH="{}"

# Install extensions
RUN apk add --no-cache postgresql-dev; \
    docker-php-ext-install intl; \
    docker-php-ext-enable intl; \
    docker-php-ext-install opcache; \
    docker-php-ext-enable opcache; \
    docker-php-ext-install common; \
    docker-php-ext-enable common; \
    docker-php-ext-install xml; \
    docker-php-ext-install xmlreader; \
    docker-php-ext-install xmlrpc; \
    docker-php-ext-enable xml; \
    docker-php-ext-enable xmlreader; \
    docker-php-ext-enable xmlrpc; \
    docker-php-ext-install soap; \
    docker-php-ext-enable soap; \
    docker-php-ext-install pdo_mysql; \
    docker-php-ext-enable pdo_mysql; \
    docker-php-ext-install pdo_pgsql; \
    docker-php-ext-enable pdo_pgsql;

# Set timezone
RUN cp /usr/share/zoneinfo/Europe/Warsaw /etc/localtime
RUN echo "Europe/Warsaw" > /etc/timezone

# ===================================================================================================
#                                       --- Production ---
# ===================================================================================================

FROM base AS production

ENV APP_ENV prod
ENV APP_DEBUG 0
ARG APP_VERSION="v0.0.0"
ENV APP_VERSION=$APP_VERSION

RUN ln -s $PHP_INI_DIR/php.ini-production $PHP_INI_DIR/php.ini
RUN sed -i 's/;date.timezone =/date.timezone = "Europe\/Warsaw"/g' $PHP_INI_DIR/php.ini

COPY . .
RUN cd app && composer install -n --no-progress --ignore-platform-reqs --prefer-dist --no-dev

RUN rm -rf .env app/composer.lock app/symfony.lock app/auth.json

RUN set -eux \
	&& mkdir -p app/var/cache app/var/log \
    && chown www-data:www-data -R app/var/*

CMD ["/init"]
EXPOSE 80

# ===================================================================================================
#                                       --- Development ---
# ===================================================================================================

FROM base AS development

RUN ln -s $PHP_INI_DIR/php.ini-development $PHP_INI_DIR/php.ini
RUN sed -i 's/;date.timezone =/date.timezone = "Europe\/Warsaw"/g' $PHP_INI_DIR/php.ini

# Install Xdebug
#RUN pecl install xdebug && docker-php-ext-enable xdebug

CMD ["/init"]
EXPOSE 80

