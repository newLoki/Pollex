<?php

defined('APPLICATION_ENV')
    || define('APPLICATION_ENV', (getenv('APPLICATION_ENV') ? getenv('APPLICATION_ENV') : 'citest'));
$env = APPLICATION_ENV;
$config = require __DIR__ . '/app/config.php';

var_dump($config['db'][$env]);