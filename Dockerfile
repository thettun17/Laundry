FROM alpine:3.15
LABEL maintainer="thettun1741997@gmail.com"
ENV COMPOSER_ALLOW_SUPERUSER=1
# Setup document root
WORKDIR /var/www/html

# Install packages and remove default server definition
RUN apk add --no-cache \
  curl \
  nginx \
  php \
  php-ctype \
  php-curl \
  php-dom \
  php-fpm \
  php-gd \
  php-intl \
  php-mbstring \
  php-mysqli \
  php-opcache \
  php-openssl \
  php-phar \
  php-session \
  php-xml \
  php-xmlreader \
  php-pdo \
  php-fileinfo \
  php-tokenizer \
  php-xmlwriter \
  php-xmlreader \
  php-pdo_mysql \
  php-json \
  supervisor

# Create symlink so programs depending on `php7` still function
# RUN ln -s /usr/bin/php /usr/bin/php

# Configure nginx
COPY devops/nginx/nginx.conf /etc/nginx/nginx.conf

# Configure PHP-FPM
COPY devops/php/php-fpm.conf /etc/php7/php-fpm.d/www.conf
COPY devops/php/php.ini /etc/php7/conf.d/custom.ini

# Configure supervisord
COPY devops/supervisor/supervisor.conf /etc/supervisor/conf.d/supervisord.conf

# Install composer 
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/bin --filename=composer
# # Switch to use root user from here on
USER root

# set www-data group (82 is the standard uid/gid for www-data in Alpine)
RUN set -x ; \
	addgroup -g 82 -S www-data ; \
	adduser -u 82 -D -S -G www-data www-data && exit 0 ; exit 1

# Add application
# COPY laravel/ /var/www/html/
COPY . /var/www/html

# Install composer packages 
RUN chown -R www-data:www-data /var/www/html
RUN chmod -R 755 /var/www/html/storage
RUN chmod -R 755 /var/www/html/bootstrap/cache
RUN rm -rf /var/cache/apk/*

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/bin --filename=composer
# RUN composer install
# RUN chown -R www-data:www-data /var/www/html /run /var/lib/nginx /var/log/nginx

# Expose the port nginx is reachable on
EXPOSE 80

# Let supervisord start nginx & php-fpm
CMD ["/usr/bin/supervisord", "-c", "/etc/supervisor/conf.d/supervisord.conf"]

# Configure a healthcheck to validate that everything is up&running
HEALTHCHECK --timeout=10s CMD curl --silent --fail http://127.0.0.1:8000/fpm-ping