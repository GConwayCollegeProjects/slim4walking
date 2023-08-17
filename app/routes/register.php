<?php

declare(strict_types=1);

use Slim\Psr7\Request;
use Slim\Psr7\Response;
use Slim\Views\Twig;

$app->get('/register', function(Request $request, Response $response, $args) {
    $view = Twig::fromRequest($request);
    return $view->render($response, 'register.html.twig', [
    ]);
})->setName('register');;
