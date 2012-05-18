<?php
//require_once __DIR__.'/../vendor/.composer/autoload.php';
require_once __DIR__.'/../app/silex.phar';

use Symfony\Component\ClassLoader\UniversalClassLoader;

$loader = new UniversalClassLoader();
$loader = require_once __DIR__.'/../app/bootstrap.php';
$loader->registerNamespace('Pollex\\Tests', __DIR__);
$loader->register();

return $loader;