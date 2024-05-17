FROM php:8.2.4-apache

ADD https://github.com/mlocati/docker-php-extension-installer/releases/latest/download/install-php-extensions /usr/local/bin/

RUN chmod +x /usr/local/bin/install-php-extensions && \
    install-php-extensions pdo_mysql intl

RUN curl -sS https://getcomposer.org/installer | php -- --disable-tls && \ 
    mv composer.phar /usr/local/bin/composer

RUN curl -fsSL https://deb.nodesource.com/setup_lts.x | bash

RUN apt-get install -y nodejs zip unzip git

RUN npm install -g npm

COPY . /var/www/

COPY ./docker/apache.conf /etc/apache2/sites-available/000-default.conf

WORKDIR /var/www/

ENV COMPOSER_ALLOW_SUPERUSER 1

RUN composer update
RUN composer install

EXPOSE 80