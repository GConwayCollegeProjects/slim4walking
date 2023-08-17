<?php


declare(strict_types=1);

use Slim\Psr7\Request;
use Slim\Psr7\Response;
use Slim\Views\Twig;

$app->get('/processregistration', function(Request $request, Response $response, $args) {
    $view = Twig::fromRequest($request);
    return $view->render($response, 'home-page.html.twig', [
    ]);
})->setName('processregistration');;
