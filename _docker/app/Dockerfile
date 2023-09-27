FROM php:8.1.3-fpm-buster

# Install Node.js
RUN curl -sL https://deb.nodesource.com/setup_18.x | bash
RUN apt-get install --yes nodejs
RUN node -v
RUN npm -v
FROM php:8.1-fpm

RUN docker-php-ext-install pdo pdo_mysql
RUN apt-get update && \
    apt-get upgrade -y && \
    apt-get install -y git
RUN apt-get install -y libpng-dev

RUN apt-get install -y libwebp-dev libjpeg62-turbo-dev libpng-dev libxpm-dev \
    libfreetype6-dev \
    zlib1g-dev \
    libzip-dev \
    unzip \
    && apt-get install -y libicu-dev \
    && docker-php-ext-configure intl \
    && docker-php-ext-install intl

COPY ./_docker/app/php.ini /usr/local/etc/php/conf.d/php.ini

RUN curl -sL https://deb.nodesource.com/setup_19.x | bash -
RUN apt-get install -y nodejs

RUN docker-php-ext-install zip

RUN docker-php-ext-configure gd --with-freetype --with-jpeg

RUN docker-php-ext-install -j$(nproc) gd
RUN apt-get install -y libz-dev libmemcached-dev && rm -r /var/lib/apt/lists/*

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
RUN docker-php-ext-configure calendar && docker-php-ext-install calendar

RUN docker-php-ext-configure pcntl --enable-pcntl \
    && docker-php-ext-install \
      pcntl

RUN pecl install -o -f redis \
    &&  rm -rf /tmp/pear \
    &&  docker-php-ext-enable redis


CMD ["php-fpm"]

WORKDIR /var/www/

