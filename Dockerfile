FROM php:7.4-fpm-alpine

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
    && cp /usr/local/etc/php/php.ini-development /usr/local/etc/php/php.ini \
    && pecl install xdebug \
    && echo "zend_extension = xdebug.so" >> /usr/local/etc/php/php.ini \
    && echo "xdebug.mode = debug" >> /usr/local/etc/php/conf.d/xdebug.ini \
    && echo "xdebug.start_with_request = yes" >> /usr/local/etc/php/conf.d/xdebug.ini \
    && echo "xdebug.discover_client_host = 1" >> /usr/local/etc/php/conf.d/xdebug.ini \
    && echo "xdebug.client_host = 172.17.0.1" >> /usr/local/etc/php/conf.d/xdebug.ini \
    # Cleanup dev dependencies
    && apk del -f .build-deps \
    && sed -i -e 's/bind 127.0.0.1/bind 0.0.0.0/' /etc/redis.conf \
    # Install composer
    && curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

WORKDIR /home/php-redis

EXPOSE 6379

CMD ["redis-server", "/etc/redis.conf"]
