FROM php:8.1-fpm

COPY ./php.ini /usr/local/etc/php/

RUN apt-get update \
  && apt-get install -y \
  git \
  zip \
  unzip \
  vim

# Laravel：requested PHP extensions
RUN docker-php-ext-install pdo_mysql

# Composer
RUN cd /usr/bin && curl -s http://getcomposer.org/installer | php && ln -s /usr/bin/composer.phar /usr/bin/composer

ENV COMPOSER_ALLOW_SUPERUSER 1

ENV TZ Asia/Tokyo
RUN echo "${TZ}" > /etc/timezone \
  && dpkg-reconfigure -f noninteractive tzdata

WORKDIR /var/www/html/src