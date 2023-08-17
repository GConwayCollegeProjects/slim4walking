<?php

declare(strict_types=1);

require __DIR__ . '/../vendor/autoload.php';

use DI\ContainerBuilder;
use Slim\Factory\AppFactory;
use Slim\Handlers\Strategies\RequestHandler;
use Slim\Views\Twig;
use Slim\Views\TwigMiddleware;
use Slim\Views\TwigRuntimeExtension;

define('APP_ENV', $_ENV['APP_ENV'] ?? $_SERVER['APP_ENV'] ?? 'DEVELOPMENT');

$settings = (require __DIR__ . '/settings.php')(APP_ENV);


// Set up dependencies
$containerBuilder = new ContainerBuilder();
if($settings['di_compilation_path']) {
    $containerBuilder->enableCompilation($settings['di_compilation_path']);
}
(require __DIR__ . '/dependencies.php')($containerBuilder, $settings);

// Create app
//AppFactory::setContainer($containerBuilder->build());

$container = new \DI\Container();

AppFactory::setContainer($container);

$app = AppFactory::create();

$app->setBasePath(preg_replace('/(.*)\/.*/', '$1', $_SERVER['SCRIPT_NAME']));

//$twig = Twig::create('../app/views'); // ['cache' => '../var/cache']

$container->set('view', function() use($app) {
        $twig=new Twig('../app/.views', [
            'cache'=> false
            ]);


$twig -> addRuntimeLoader(
    new \Slim\Views\TwigRuntimeLoader(
        $app->getRouteCollector()->getRouteParser(),
        (new \Slim\Psr7\Factory\UriFactory())->createFromGlobals($_SERVER),
        ''
    )
);

    $twig -> addExtension(new \Slim\Views\TwigExtension());


$app->add(TwigMiddleware::create($app, $twig));

});

require __DIR__.'/settings/my_settings.php';

// Register middleware
(require __DIR__ . '/middleware.php')($app);

// Register routes
require  __DIR__ . '/routes.php';



// Run app
$app->run();