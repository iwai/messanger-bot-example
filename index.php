<?php
require_once __DIR__ . '/vendor/autoload.php';

use Symfony\Component\HttpFoundation\Request;

$app = new Silex\Application();

$app->get('/callback', function (Request $request) use ($app) {
  if ($request->get('hub.verify_token') === getenv('VALIDATION_TOKEN')) {
    return new Response($request->get('hub.challenge'), 200);
  }
  return new Response('Error, wrong validation token', 500);
});

$app->run();