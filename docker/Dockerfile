FROM php:5.6-apache

RUN a2enmod rewrite

RUN apt-get update && \
    apt-get install -y \
        libfreetype6-dev \
        libjpeg62-turbo-dev \
        libmcrypt-dev \
        libpng-dev \
        libgmp-dev \
        libxml2-dev \
        libxslt-dev \
        zlib1g-dev \
        libncurses5-dev \
        libldap2-dev \
        libicu-dev \
        libmemcached-dev \
        libcurl4-openssl-dev \
        libssl-dev \
        libsqlite3-dev \
        exiftool \
        curl \
        ssmtp \
        mysql-client \
        git \
        wget && \
    rm -rf /var/lib/apt/lists/* && \
    wget https://getcomposer.org/download/1.10.22/composer.phar -O /usr/local/bin/composer && \
    chmod a+rx /usr/local/bin/composer

RUN docker-php-ext-configure pdo_mysql --with-pdo-mysql=mysqlnd && \
    docker-php-ext-install pdo_mysql && \
    docker-php-ext-configure mysql --with-mysql=mysqlnd && \
    docker-php-ext-install mysql && \
    docker-php-ext-configure mysqli --with-mysqli=mysqlnd && \
    docker-php-ext-install mysqli && \
    docker-php-ext-configure gd --with-freetype-dir=/usr/include/ --with-png-dir=/usr/include/ --with-jpeg-dir=/usr/include && \
    docker-php-ext-install gd

RUN docker-php-ext-install \
    bcmath \
    exif \
    ftp \
    intl \
    mbstring \
    mcrypt \
    opcache \
    pcntl \
    soap \
    sockets \
    tokenizer\
    zip

RUN apt-get locales tzdata \

COPY 000-default.conf /etc/apache2/sites-available/000-default.conf

COPY . /var/www/html/
WORKDIR /var/www/html/

CMD ["/usr/sbin/apachectl", "-D", "FOREGROUND"]