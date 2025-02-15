
FROM php:8.1-apache-bullseye
RUN docker-php-ext-install mysqli
RUN a2enmod rewrite
COPY ./app /var/www/html/
RUN mkdir -p /var/www/html/uploads && chmod -R 777 /var/www/html/uploads
EXPOSE 80
WORKDIR /var/www/html