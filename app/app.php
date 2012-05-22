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

//register config dir
$app->register(new KevinGH\Silex\Config\Provider, array(
    'config.path' => __DIR__ . '/config'
));

//ensure that content type is json
$app->before(function ($request) {
    if (0 === strpos($request->headers->get('Content-Type'), 'application/json')) {
        $data = json_decode($request->getContent(), true);
        $request->request = new ParameterBag($data);
    }
});

$app->get('/', function() use ($app) {

    $test = new stdClass();
    $test->name = 'foo';

    return $app->json($test);
});

//ensure it is authentificated
//look @ http://chemicaloliver.net/programming/http-basic-auth-in-silex/
$app->before(function() use ($app)
{
    if (!isset($_SERVER['PHP_AUTH_USER']))
    {
        $domain = $app['config']->get('domain');
        header('WWW-Authenticate: Basic realm="' . $domain . '"');
        return $app->json(array('Message' => 'Not Authorised'), 401);
    }
    else
    {
        //once the user has provided some details, check them
        $users = array(
            'workflow' => 'password'
            );

        if($users[$_SERVER['PHP_AUTH_USER']] !== $_SERVER['PHP_AUTH_PW'])
        {
            //If the password for this user is not correct then resond as such
            return $app->json(array('Message' => 'Forbidden'), 403);
        }

        //If everything is fine then the application will carry on as normal
    }
});

return $app;