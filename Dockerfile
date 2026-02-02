FROM 8ct8pus/apache-php-fpm-alpine:2.5.2

WORKDIR /sites/localhost/html/public

#COPY docker/etc/ /docker/etc/

RUN chown -R apache:apache /sites/localhost || true

# composer commands
WORKDIR /sites/localhost/html/public/app
COPY ./website/app/composer.json ./

RUN apk add composer
RUN composer install
RUN composer update

EXPOSE 80 443 8025