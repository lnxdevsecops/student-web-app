FROM php:8.1-apache
COPY *.html /var/www/html/
COPY *.php /var/www/html
RUN apt-get update && \
    docker-php-ext-install mysqli pdo pdo_mysql
#CMD ["apache", "-D", "FOREGROUND"]
