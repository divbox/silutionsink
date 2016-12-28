<?php

session_start();

require __DIR__ . '/../vendor/autoload.php';

use Slim\App;
use Noodlehaus\Config;
use Dotenv\Dotenv;

$app = new App([
  'settings' => [
    'displayErrorDetails' => true,
  ],
]);

if (file_exists(__DIR__ . '/../.env')) {
  $dotenv = new Dotenv(__DIR__ . '/../');
  $dotenv->load();
}

$container = $app->getContainer();

$container['config'] = function ($c) {
  return new Config(__DIR__ . '/../config');
};

$container['view'] = function ($c) {
  $view = new \Slim\Views\Twig(__DIR__ . '/../resources/views', [
    'cache' => false,
    'debug' => true,
  ]);

  // Instantiate and add Slim specific extension
  $basePath = rtrim(str_ireplace('index.php', '', $c['request']->getUri()->getBasePath()), '/');
  $view->addExtension(new Slim\Views\TwigExtension($c['router'], $basePath));
  return $view;
};

$container['notFoundHandler'] = function ($c) {
  return function ($request, $response) use ($c) {
    $c->view->render($response, 'errors/404.twig');
    return $response->withStatus(404);
  };
};

require __DIR__ . '/../routes/routes.php';
