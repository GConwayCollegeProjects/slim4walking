<?php

declare(strict_types=1);

use Slim\Psr7\Request;
use Slim\Psr7\Response;
use Slim\Views\Twig;


$app->get('/', function ($request, $response) use ($container) {
    if ($_SERVER['userid'] ='') {return $container->get('view')->render($response, 'logged-out.html.twig');
    }
    else {
        return $container->get('view')->render($response, 'home.twig');
    }
})

    -> setName('homepage');