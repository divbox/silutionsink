<?php

$app->get('/', function($request, $response, $args) {
  return $this->view->render($response, 'pages/home.twig', [
    'response' => $response
  ]);
});

$app->get('/about', function($request, $response, $args) {
  return $this->view->render($response, 'pages/about.twig', [
    'response' => $response
  ]);
});

$app->get('/contact', function($request, $response, $args) {
  return $this->view->render($response, 'pages/contact.twig', [
    'response' => $response
  ]);
});

$app->get('/blog', function($request, $response, $args) {
  return $this->view->render($response, 'pages/blog.twig', [
    'response' => $response
  ]);
});

