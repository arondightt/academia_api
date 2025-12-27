FROM php:8.2-cli

WORKDIR /var/www/html

RUN apt-get update && apt-get install -y \
    default-mysql-client \
    && docker-php-ext-install pdo pdo_mysql

COPY . .

EXPOSE 8080

CMD [ "php", "-S", "0.0.0.0:8080", "-t" ,"public" ]