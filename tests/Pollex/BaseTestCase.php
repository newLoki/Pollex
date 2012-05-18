<?php
namespace Pollex\Tests\Base;
use Silex\WebTestCase as BaseWebTestCase;

class BaseTestCase extends  BaseWebTestCase
{
    public function createApplication()
    {
        //load full application
        $app = require_once $this->getApplicationDir() . '/app.php';

        return $app;
    }

    public function getApplicationDir()
    {
        return $_SERVER['APP_DIR'];
    }
}