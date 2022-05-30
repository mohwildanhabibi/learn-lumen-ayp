FROM php:8.1-fpm

# Set working directory
WORKDIR /var/www

# Add docker php extension repo
ADD https://github.com/mlocati/docker-php-extension-installer/releases/latest/download/install-php-extensions /usr/local/bin/

# Install php extensions
RUN chmod +x /usr/local/bin/install-php-extensions && sync && \
  install-php-extensions pdo_mysql mbstring exif pcntl bcmath gd

# Install dependencies
RUN apt-get update && apt-get install -y \
  build-essential \
  zip \
  unzip \
  curl \
  nginx \
  supervisor

# Install dev dependencies
RUN apt-get update && apt-get install -y \
  git \
  nano

# Install composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Clear cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# PHP error log files
RUN mkdir /var/log/php
RUN touch /var/log/php/errors.log && chmod 777 /var/log/php/errors.log

EXPOSE 80
