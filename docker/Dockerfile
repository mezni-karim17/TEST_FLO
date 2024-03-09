FROM php:8.1-apache

RUN echo "ServerName localhost" >> /etc/apache2/apache2.conf

#Install Packages
RUN apt-get -y update && apt-get install -y libicu-dev libzip-dev zip libjpeg-dev libpng-dev libfreetype6-dev
RUN docker-php-ext-configure intl
RUN docker-php-ext-configure gd '--with-jpeg' '--with-freetype'
RUN docker-php-ext-install intl opcache pdo_mysql zip gd
RUN pecl install xdebug
RUN a2enmod rewrite

#INSTALL APCU
RUN pecl install apcu-5.1.22 && docker-php-ext-enable apcu
RUN echo "extension=apcu.so" > /usr/local/etc/php/php.ini
RUN echo "apc.enable_cli=1" > /usr/local/etc/php/php.ini
RUN echo "apc.enable=1" > /usr/local/etc/php/php.ini
#APCU

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
RUN curl -sS https://get.symfony.com/cli/installer | bash && mv /root/.symfony5/bin/symfony /usr/local/bin/symfony

# Install NVM
RUN curl https://raw.githubusercontent.com/creationix/nvm/master/install.sh | bash

WORKDIR /var/www/
