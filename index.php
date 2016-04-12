<?php
require_once __DIR__ . '/vendor/autoload.php';

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

$app = new Silex\Application();

$app->get('/callback', function (Request $request) use ($app) {
  if ($request->query->get('hub_verify_token') == getenv('VALIDATION_TOKEN')) {
    return new Response($request->query->get('hub_challenge'), 200);
  }
  return new Response('Error, wrong validation token', 500);
});

$app->run();