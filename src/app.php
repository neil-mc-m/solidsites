<?php
use Silex\Application;
use Silex\Provider\TwigServiceProvider;
use Silex\Provider\SessionServiceProvider;
use Silex\Provider\SecurityServiceProvider;
use Silex\Provider\FormServiceProvider;
use JG\Silex\Provider\CapsuleServiceProvider;
use Solidsites\UserProvider;
use Solidsites\Forms\PackageType;
use Solidsites\Forms\ContactType;


require_once __DIR__ . '/../vendor/autoload.php';

$app = new Application();
$app['debug'] = true;
$app->register(new Solidsites\ConfigServiceProvider(), array(
    'config.file' => __DIR__ . '/../config/config.ini',
));
$app->register(new Silex\Provider\VarDumperServiceProvider());
$app->register(new TwigServiceProvider(), array(
    'twig.path' => __DIR__ . '/../templates',
));
$app->register(new CapsuleServiceProvider(),
    [
        'capsule.connections' =>
            [
                'default' => [
                    'driver' => 'mysql',
                    'host' => 'localhost',
                    'database' => $app['config']['database']['database'],
                    'username' => $app['config']['database']['username'],
                    'password' => $app['config']['database']['password']
                ],

        'capsule.options' => [
            'setAsGlobal' => true,
            'bootEloquent' => true,
            ]
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
    'security.encoder.bcrypt.cost' => $app['config']['bcrypt']['cost'],
));
$app->register(new Silex\Provider\LocaleServiceProvider());
$app->register(new Silex\Provider\TranslationServiceProvider(), array(
    'locale_fallbacks' => array('en'),
));
$app->register(new Silex\Provider\ValidatorServiceProvider());
$app->register(new Silex\Provider\HttpFragmentServiceProvider());
$app->register(new FormServiceProvider());
$app->register(new Cocur\Slugify\Bridge\Silex2\SlugifyServiceProvider());
$app->register(new Silex\Provider\SwiftmailerServiceProvider());


// register custom forms here.

$app->extend('form.types', function ($types) {
    $types[] = new PackageType();
    return $types;
});
$app->extend('form.types', function ($types) {
    $types[] = new ContactType();
    return $types;
});
return $app;