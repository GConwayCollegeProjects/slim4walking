<?php

declare(strict_types=1);

require __DIR__ . '/../vendor/autoload.php';

use DI\ContainerBuilder;
use Slim\Factory\AppFactory;
use Slim\Views\Twig;
use Slim\Views\TwigMiddleware;

define('APP_ENV', $_ENV['APP_ENV'] ?? $_SERVER['APP_ENV'] ?? 'DEVELOPMENT');

$settings = (require __DIR__ . '/settings.php')(APP_ENV);

// Set up dependencies
$containerBuilder = new ContainerBuilder();
if($settings['di_compilation_path']) {
    $containerBuilder->enableCompilation($settings['di_compilation_path']);
}
(require __DIR__ . '/dependencies.php')($containerBuilder, $settings);

// Create app

$container = new \DI\Container();

AppFactory::setContainer($container);

$app = AppFactory::create();

$app->setBasePath(preg_replace('/(.*)\/.*/', '$1', $_SERVER['SCRIPT_NAME']));

$container->set('view', function() use($app) {
    $twig = Twig::create('../app/views', ['cache' => false ]);  //'../var/cache'

$twig -> addRuntimeLoader(
    new \Slim\Views\TwigRuntimeLoader(
        $app->getRouteCollector()->getRouteParser(),
        (new \Slim\Psr7\Factory\UriFactory())->createFromGlobals($_SERVER),
        ''
    )
);

    $app->add(TwigMiddleware::create($app, $twig));
    return $twig;
});

require __DIR__.'/settings/my_settings.php';

// Register middleware
(require __DIR__ . '/middleware.php')($app);

// Register routes
//require  __DIR__ . '/routes.php';

$app->get('/routelist', function ($request, $response) use ($container) {
    if ($_SERVER['userid'] ='') {return $container->get('view')->render($response, 'logged-out.html.twig');
    }
    else {
        return $container->get('view')->render($response, 'routes.html.twig', [

            'route' => ROUTE_ARRAY


        ]);

    }

}

)
    -> setName('routelist');


$app->get('/', function ($request, $response) use ($container) {
    if ($_SERVER['userid'] ='') {return $container->get('view')->render($response, 'logged-out.html.twig');
    }
    else {
        return $container->get('view')->render($response, 'fresh.twig');
    }
})

    -> setName('homepage');

// Run app
$app->run();