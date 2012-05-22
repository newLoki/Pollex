<?php
//require_once __DIR__.'/../vendor/.composer/autoload.php';
require_once __DIR__.'/../app/silex.phar';



$app = require_once __DIR__.'/../app/app.php';
//seems to be broken O.o
$app['autoloader']->registerNamespace('Tests', __DIR__);


return $app;