<?php
defined('APPLICATION_ENV')
    || define('APPLICATION_ENV', (getenv('APPLICATION_ENV') ? getenv('APPLICATION_ENV') : 'citest'));
//require_once __DIR__.'/../vendor/.composer/autoload.php';
require_once __DIR__.'/../app/silex.phar';

$app = require __DIR__.'/../app/app.php';
$app['autoloader']->registerNamespace('Tests', __DIR__);

return $app;
