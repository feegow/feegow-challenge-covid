FROM php:7.4-apache

# -- Diretorio de trabalho
WORKDIR "/var/www"

# -- Pacotes do OS
RUN apt update && apt install -y \
    zlib1g-dev libzip-dev \
    libbz2-dev libxml2-dev libpng-dev \
    cron

# -- Biblioteca do PHP
RUN docker-php-ext-install \
    zip bz2 calendar dom gd \
    intl pcntl bcmath mysqli \
    pdo_mysql opcache

# -- Instalação xdebug e opcache
RUN yes | pecl install xdebug-2.9.0 \
    && echo "zend_extension=$(find /usr/local/lib/php/extensions/ -name xdebug.so)" > /usr/local/etc/php/conf.d/xdebug.ini \
    && echo "xdebug.remote_enable=on" >> /usr/local/etc/php/conf.d/xdebug.ini \
    && echo "xdebug.remote_autostart=off" >> /usr/local/etc/php/conf.d/xdebug.ini

# -- Instalação do composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# -- a2endmode rewrite
RUN sed -i '/<Directory \/var\/www\/>/,/<\/Directory>/ s/AllowOverride None/AllowOverride All/' /etc/apache2/apache2.conf
RUN a2enmod rewrite
RUN service apache2 restart

EXPOSE 80