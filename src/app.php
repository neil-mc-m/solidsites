<?php
use Silex\Application;
use Silex\Provider\TwigServiceProvider;
use Silex\Provider\SessionServiceProvider;
use Silex\Provider\SecurityServiceProvider;
use Silex\Provider\FormServiceProvider;
use JG\Silex\Provider\CapsuleServiceProvider;
use Solidsites\UserProvider;

require_once __DIR__.'/../vendor/autoload.php';

$app = new Application();

$app->register(new Silex\Provider\VarDumperServiceProvider());
$app->register(new TwigServiceProvider(), array(
    'twig.path' => __DIR__.'/../templates',
));
$app->register(new CapsuleServiceProvider(),
    [
        'capsule.connections' =>
        [
            'default' => [
                'driver' => 'mysql',
                'host' => 'localhost',
                'database' => 'solidsites',
                'username' => 'root',
                'password' => 'root'
            ]

        ],
        'capsule.options' => [
            'setAsGlobal'    => true,
            'bootEloquent'   => true,
        ]
    ]
);
$app->register(new SessionServiceProvider());
$app->register(new SecurityServiceProvider(), array(
        'security.firewalls' => array(
            'admin' => array(
                'pattern' => '^/admin',
                'form' => array('login_path' => '/login', 'check_path' => '/admin/login_check'),
                'logout' => array('logout_path' => '/admin/logout', 'invalidate_session' => true),
                'users' => function () use ($app) {
                    return new UserProvider();
                },
            )
        ),
        'security.encoder.bcrypt.cost' => 4,
    ));
$app->register(new Silex\Provider\ValidatorServiceProvider());
$app->register(new Silex\Provider\TranslationServiceProvider(), array(
    'translator.domains' => array(),
));
$app->register(new FormServiceProvider());

$app['debug'] = true;
// register custom forms here.

$app->extend('form.types', function ($types) {
    $types[] = new Solidsites\Forms\PackageType();
    return $types;
});
return $app;