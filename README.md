# Site kosmopoisk.ks.ua

Developed on the Kohana 3.2.1 framework

Requirements: PHP 5.2 - 5.6, MySQL 5.7

## Config

Permissions:
~~~
cd www/kosmopoisk.ks.ua
sudo chmod 0777 -R uploads application/cache application/logs
sudo chmod 0666 application/config/app.php

git config core.filemode false
~~~

In the `application/bootstrap.php` file set `base_url` key for `Kohana::init`

Copy `application/config/database.dist.php` to `application/config/database.php` and set et params for your database (for docker): 
```
'hostname'   => 'db',
'database'   => 'kosmopoisk',
'username'   => 'dev',
'password'   => 'dev',
```

Example database dump in the `db.sql` file.

In the `.htaccess` file set type of environment

~~~
SetEnv KOHANA_ENV development
or
SetEnv KOHANA_ENV production
~~~

Credentials your `kosmopoisk.test/admin`
~~~
login:    admin
password: password
~~~

## How to run

Commands in Makefile

`make build` is equivalent `docker-compose up --build -d`

`make up` is equivalent `docker-compose up -d`

`make down` is equivalent `docker-compose down --remove-orphans`

`make restart` is equivalent `docker-compose down --remove-orphans`

If you have running `mysql` and `apache` services you need stop these: `make stop-local-services`

Run services: `start-local-services`