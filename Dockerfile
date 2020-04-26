FROM php:7.2-fpm-alpine

# Install dev dependencies
RUN apk add --no-cache --virtual .build-deps \
    $PHPIZE_DEPS

# Install dependencies
RUN apk add --no-cache \
    curl \
    zip \
    unzip \
    redis \
    git \
    vim

# Install PECL and PEAR extensions
#RUN pecl install xdebug

# Enable PECL and PEAR extensions
#RUN docker-php-ext-enable xdebug

# Cleanup dev dependencies
RUN apk del -f .build-deps

# Install composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

#COPY ./docker/php/xdebug.ini /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini

WORKDIR /home/php-redis

CMD ["redis-server"]