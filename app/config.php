<?php

function tranformsDotCloud()
{
    $cloudConfig = json_decode(file_get_contents("/home/dotcloud/environment.json"),true);

    return array(
        'driver' => 'pdo_mysql',
        'dbname' => 'pollex',
        'host' => $cloudConfig['DOTCLOUD_DB_MYSQL_HOST'],
        'user' => $cloudConfig['DOTCLOUD_DATA_MYSQL_LOGIN'],
        'password' => $cloudConfig['DOTCLOUD_DATA_MYSQL_PASSWORD'],
        'port' => $cloudConfig['DOTCLOUD_DATA_MYSQL_PORT'],
    );
}

return array(
    // database settings
    'db' => array(
        'prod' => tranformsDotCloud(),
        'dev' => array(
            'driver'    => 'pdo_mysql',
            'dbname'    => 'pollex',
            'host'      => '127.0.0.1',
            'user'      => 'root',
            'password'  => 'root',
            'port'      => '3306'
        ),
        'test' => array(
            'driver'    => 'pdo_mysql',
            'dbname'    => 'pollex',
            'host'      => '127.0.0.1',
            'user'      => 'root',
            'password'  => 'root',
            'port'      => '3306'
        ),

        'citest' => array(
            'driver'    => 'pdo_mysql',
            'dbname'    => 'pollex',
            'host'      => '127.0.0.1',
            'user'      => 'root',
            'password'  => '',
            'port'      => '3306'
        ),
    ),
);