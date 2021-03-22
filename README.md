# Site kosmopoisk.ks.ua

Developed on the Kohana 3.2.1 framework

## Config

Copy `application/config/database.dist.php` to `application/config/database.php` and set keys for DB

In the `application/bootstrap.php` file set `base_url` key for `Kohana::init`  

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
