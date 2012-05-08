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

/**
 * /polls ->  (GET => liste, POST => new, PUT => nothing (not update function planned), DELETE => delete)
 * => GET = list all
 * => POST = new
 * => PUT = no update handle planned
 * => DELETE = not handled here
 *
 * /polls/{id|name}
 *  => GET = all questions -> mount questions
 *  => POST = not handled
 *  => PUT = update for survey {id}
 *  => DELETE = delete survey {id}
 *
 *
 * questions/
 *
 *
 *
 * /polls/{id|name}/questions/{id|number}
 *
 *
 */


return $app;