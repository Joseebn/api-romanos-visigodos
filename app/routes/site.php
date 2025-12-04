<?php

use Slim\App;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Interfaces\RouteCollectorProxyInterface as Group;


return function (App $app) {

    $app->group('/site', function (Group $group) {
        $group->get('/news', function (Request $request, Response $response) {
	        $response->getBody()->write('all news');
	        return $response;
        });
        $group->get('/news/{slug}', function (Request $request, Response $response, array $args) {
            $response->getBody()->write('news item: ' . $args['slug']);
            return $response;
        });
        $group->get('/monuments', function (Request $request, Response $response) {
	        $response->getBody()->write('all monuments');
	        return $response;
        });
        $group->get('/monuments/{slug}', function (Request $request, Response $response, array $args) {
            $response->getBody()->write('news item: ' . $args['slug']);
            return $response;
        });
        $group->get('/dictionary', function (Request $request, Response $response) {
	        $response->getBody()->write('all terms');
	        return $response;
        });
    });
};