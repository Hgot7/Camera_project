# FROM nginx
# COPY . /usr/share/nginx/html/test

FROM php:8.2-apache
COPY . /var/www/html/