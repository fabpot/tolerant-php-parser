ARG PHP_VERSION
FROM php:$PHP_VERSION
RUN curl https://getcomposer.org/download/latest-2.x/composer.phar -o /usr/bin/composer.phar && chmod a+x /usr/bin/composer.phar
WORKDIR /tolerant-php-parser
RUN apt-get update && apt-get install -y unzip && apt-get clean
ADD composer.json ./
RUN composer.phar install && composer.phar clear-cache

ADD . .
