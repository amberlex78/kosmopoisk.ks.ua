# Site kosmopoisk.ks.ua

Developed on the Kohana 3.2.1 framework

Requirements: PHP 5.2 - 5.6, MySQL 5.7

## Config

Permissions:
~~~
sudo chmod 0777 uploads application/cache application/logs
sudo chmod 0666 application/config/app.php
~~~

In the `application/bootstrap.php` file set `base_url` key for `Kohana::init`

Copy `application/config/database.dist.php` to `application/config/database.php` and set et params for your database: 
```
'hostname'   => 'localhost',
'database'   => 'your_database_name',
'username'   => 'root',
'password'   => 'root',
```

Example database dump in the `db.sql` file.

In the `.htaccess` file set type of environment

~~~
SetEnv KOHANA_ENV development
or
SetEnv KOHANA_ENV production
~~~

Credentials your `site_url/admin`
~~~
login:    admin
password: password
~~~
