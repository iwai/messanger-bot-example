<?php
require_once __DIR__ . '/vendor/autoload.php';

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

$app = new Silex\Application();

$app->get('/callback', function (Request $request) use ($app) {
  if ($request->getQueryString()['hub.verify_token'] == getenv('VALIDATION_TOKEN')) {
    return new Response($request->getQueryString()['hub.challenge'], 200);
  }
  return new Response('Error, wrong validation token', 500);
});

$app->run();