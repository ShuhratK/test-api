FROM php:7.2-apache
RUN apt-get update
RUN docker-php-ext-install pdo pdo_mysql mysqli
RUN a2enmod rewrite
COPY rest.conf /etc/apache2/sites-enabled/000-default.conf
RUN rm -rf /etc/apache2/sites-enabled/000-default.conf