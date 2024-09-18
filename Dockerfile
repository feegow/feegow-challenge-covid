FROM php:8.2-fpm-alpine3.19

RUN apk add --no-cache linux-headers libzip-dev zip composer

RUN docker-php-ext-install pdo
RUN docker-php-ext-install pdo_mysql
RUN docker-php-ext-install sockets
RUN docker-php-ext-install bcmath
RUN docker-php-ext-install session
RUN docker-php-ext-install zip

RUN apk --update --no-cache add \
    supervisor \
    nginx \
    curl \
    dpkg \
    php82-tokenizer \
    php82-dom \
    bash

RUN rm -rf /etc/supervisor.d/ \
    && rm -rf /etc/nginx/conf.d/ /etc/nginx/http.d/ /etc/nginx/sites-enabled/ \
    && rm -rf /usr/local/etc/php-fpm.d/*docker* \
    && rm -rf /usr/local/etc/php-fpm.d/www.conf.default \
    && mkdir -p /run/nginx

# Configurando NGINX
COPY setup/etc/nginx/ /etc/nginx/

# Configurando PHP-FPM
COPY setup/usr/local/etc /usr/local/etc/

# Supervisord
COPY setup/etc/supervisord.conf /etc/supervisord.conf
COPY setup/etc/supervisor.d /etc/supervisor.d/

WORKDIR /var/www/html

EXPOSE 80

CMD ["/usr/bin/supervisord", "-n", "-c", "/etc/supervisord.conf"]
