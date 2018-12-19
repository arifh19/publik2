#FROM php:7.2-fpm
FROM codemix/yii2-base:latest
LABEL maintainer="komatik.wg@ugm.ac.id"

# Copy your app's source code into the container
COPY . /var/www/html

# Installing dependencies
RUN apt-get update && apt-get install -y \
    build-essential \
    mysql-client \
    libpng-dev \
    libjpeg62-turbo-dev \
    libfreetype6-dev \
    locales \
    zip \
    jpegoptim optipng pngquant gifsicle

# Clear cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Installing extensions
RUN docker-php-ext-install pdo_mysql mbstring zip exif pcntl
RUN docker-php-ext-configure gd --with-gd --with-freetype-dir=/usr/include/ --with-jpeg-dir=/usr/include/ --with-png-dir=/usr/include/
RUN docker-php-ext-install gd

# Installing composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Allow container to write on host
# RUN usermod -u 1000 www-data

# Changing Workdir
# WORKDIR /application

RUN rm -rf /etc/localtime

RUN ln -s /usr/share/zoneinfo/Asia/Jakarta /etc/localtime

