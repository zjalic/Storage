FROM php:7.2-apache
COPY . /var/www
WORKDIR /var/www
RUN chmod -R 777 storage


