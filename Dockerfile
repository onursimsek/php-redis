FROM php:8.1-alpine

COPY --from=mlocati/php-extension-installer /usr/bin/install-php-extensions /usr/local/bin/
COPY --from=composer:latest /usr/bin/composer /usr/local/bin/composer

ENV PHP_IDE_CONFIG="serverName=php-redis"

# Install dev dependencies
RUN apk add --no-cache --virtual .build-deps $PHPIZE_DEPS \
    # Install dependencies
    && apk add --no-cache \
        curl \
        zip \
        unzip \
        redis \
        git \
        vim \
    # Setup xdebug
    && install-php-extensions xdebug \
    && echo "xdebug.mode = debug,coverage" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
#    && echo "xdebug.start_with_request = yes" >> /usr/local/etc/php/conf.d/xdebug.ini \
#    && echo "xdebug.discover_client_host = 1" >> /usr/local/etc/php/conf.d/xdebug.ini \
#    && echo "xdebug.client_host = 172.17.0.1" >> /usr/local/etc/php/conf.d/xdebug.ini \
    # Cleanup dev dependencies
    && apk del -f .build-deps \
    && sed -i -e 's/bind 127.0.0.1/bind 0.0.0.0/' /etc/redis.conf

WORKDIR /home/php-redis

EXPOSE 6379

CMD ["redis-server", "/etc/redis.conf"]
