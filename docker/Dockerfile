FROM php:5.4-apache

#RUN docker-php-ext-install mysql mysqli && docker-php-ext-enable mysql mysqli

COPY 000-default.conf /etc/apache2/sites-available/000-default.conf
RUN a2ensite 000-default.conf

RUN a2enmod rewrite

COPY . /var/www/html/
RUN chown -R www-data:www-data /var/www/html

CMD ["/usr/sbin/apachectl", "-D", "FOREGROUND"]