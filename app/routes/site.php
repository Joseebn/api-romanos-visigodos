<?php

use Slim\App;
use App\Controller\Site\DictionaryController;
use App\Controller\Site\GalleryController;
use App\Controller\Site\MonumentController;
use App\Controller\Site\PostController;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Interfaces\RouteCollectorProxyInterface as Group;


return function (App $app) {

    $app->group('/site', function (Group $group) {
        $group->get('/posts', function (Request $request, Response $response) {
    	        $response->getBody()->write('all news');
	        return $response;
        });
        $group->get('/posts/{slug}', function (Request $request, Response $response, array $args) {
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
        $group->get('/dictionary', DictionaryController::class);
        
        $group->get('/gallery', function (Request $request, Response $response) {
    	        $response->getBody()->write('all terms');
	        return $response;
        });
    });
};