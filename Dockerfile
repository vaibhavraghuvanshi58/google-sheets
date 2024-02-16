FROM php:8.0-apache
WORKDIR /var/www/html
COPY . .
RUN apt-get update && \
    apt-get install -y libpng-dev && \
    docker-php-ext-install pdo pdo_mysql gd
ENV MYSQL_HOST=localhost
ENV MYSQL_USER=root
ENV MYSQL_PASSWORD=secret
EXPOSE 80
CMD ["apache2-foreground"]
