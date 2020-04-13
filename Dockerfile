FROM php:7.2-fpm-alpine

# Install dependencies
RUN apk add --no-cache \
    curl \
    zip \
    unzip \
    redis \
    git \
    vim

# Install composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Copy existing application directory contents
COPY . /home/php-redis

WORKDIR /home/php-redis

CMD ["php-fpm"]