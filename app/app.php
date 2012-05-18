<?php
use Silex\Provider\SymfonyBridgesServiceProvider;
use Silex\Provider\TranslationServiceProvider;
use Silex\Provider\FormServiceProvider;

require_once __DIR__.'/bootstrap.php';

$app = new Silex\Application();
$app['debug'] = true;

/**
 * Register own namepsace
 */
$app['autoloader']->registerNamespace('SilexExtension', __DIR__ . '/../vendor/silex-extension/src');
$app->register(new SilexExtension\MongoDbExtension(),
    array(
        'mongodb.class_path' => __DIR__ . '/../vendor/mongodb/lib',
        'mongodb.connection' => array(
            'server' => 'mongodb://mysecretuser:mysecretpassw@localhost',
            'options' => array(),
            'eventmanager' => function($eventmanager) {}
        )
    )
);

//ensure that content type is json
$app->before(function (Request $request) {
    if (0 === strpos($request->headers->get('Content-Type'), 'application/json')) {
        $data = json_decode($request->getContent(), true);
        $request->request = new ParameterBag($data);
    }
});

//ensure it is authentificated
//look @ http://chemicaloliver.net/programming/http-basic-auth-in-silex/


return $app;