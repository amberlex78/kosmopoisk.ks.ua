<?php defined('SYSPATH') or die('No direct access allowed.');

// Для localhost
if ($_SERVER['HTTP_HOST']=='kosmopoisk.test')
{
    return array
    (
        'default' => array
        (
            'type'       => 'mysql',
            'connection' => array(
                'hostname'   => 'db',
                'database'   => 'kosmopoisk',
                'username'   => 'dev',
                'password'   => 'dev',
                'persistent' => FALSE,
            ),
            'table_prefix' => '',
            'charset'      => 'utf8',
            'caching'      => false,
            'profiling'    => TRUE,
        )
    );
}

// Для сервера
else
{
    return array
    (
        'default' => array
        (
            'type'       => 'mysql',
            'connection' => array(
                'hostname'   => 'localhost',
                'database'   => 'kosmopoisk',
                'username'   => 'dev',
                'password'   => 'dev',
                'persistent' => FALSE,
            ),
            'table_prefix' => '',
            'charset'      => 'utf8',
            'caching'      => FALSE,
            'profiling'    => Kohana::$environment !== Kohana::PRODUCTION,
        )
    );
}
