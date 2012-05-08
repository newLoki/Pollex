<?php
//require_once __DIR__.'/../vendor/.composer/autoload.php';
require_once __DIR__.'/../app/silex.phar';

use Symfony\Component\ClassLoader\UniversalClassLoader;

$loader = new UniversalClassLoader();

//Application and library namespaces
$loader->registerNamespace('Slexboard',__DIR__.'/../src'); //@todo own library



$loader->register();

return $loader;