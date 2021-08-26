FROM php:5.6-apache

RUN docker-php-ext-install mysql && docker-php-ext-enable mysql

COPY 000-default.conf /etc/apache2/sites-available/000-default.conf

RUN a2enmod rewrite

COPY . /var/www/html/
RUN chown -R www-data:www-data /var/www/html

CMD ["/usr/sbin/apachectl", "-D", "FOREGROUND"]