<?php

return array(
    // database settings
    'db' => array(
        'prod' => array(
            'driver'    => 'pdo_mysql',
            'dbname'    => 'pollex',
            'host'      => '127.0.0.1',
            'user'      => 'root',
            'password'  => 'root',
            'port'      => '3306'
        ),
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