<?php
//require_once __DIR__.'/../vendor/.composer/autoload.php';
require_once __DIR__.'/../app/silex.phar';

use Symfony\Component\ClassLoader\UniversalClassLoader;

$loader = new UniversalClassLoader();
$loader->register();

return $loader;