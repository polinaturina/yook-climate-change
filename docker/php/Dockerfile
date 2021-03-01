FROM php:8.0.2-cli

RUN apt-get update && apt-get install -my \
  git \
  zip \
  && rm -rf /var/lib/apt/lists/*

RUN docker-php-ext-install pcntl

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

COPY ./src /var/www/src
COPY ./script/runTask.php /var/www/script/runTask.php

WORKDIR /var/www
CMD php /var/www/script/runTask.php
