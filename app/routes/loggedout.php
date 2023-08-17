<?php


declare(strict_types=1);

use Slim\Psr7\Request;
use Slim\Psr7\Response;
use Slim\Views\Twig;

$app->get('/rubbish', function(Request $request, Response $response, $args) {
    $view = Twig::fromRequest($request);
    return $view->render($response, 'logged-out.html.twig', [
  //  return $view->render($response, 'test.twig', [

    ]);
})->setName('loggedout');;

