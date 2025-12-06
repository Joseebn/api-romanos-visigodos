<?php

use Slim\App;
use App\Application\Actions\Site\GalleryAction;
use App\Application\Actions\Site\ListDictionaryTermsAction;
use App\Application\Actions\Site\ShowDictionaryTermAction;
use App\Application\Actions\Site\PostAction;
use App\Application\Actions\Site\MonumentAction;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Interfaces\RouteCollectorProxyInterface as Group;


return function (App $app) {

    $app->group('/site', function (Group $group) {

        // dictionary routes
        $group->get('/dictionary', ListDictionaryTermsAction::class);
        $group->get('/dictionary/{slug}', ShowDictionaryTermAction::class);

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
        
        $group->get('/gallery', function (Request $request, Response $response) {
    	        $response->getBody()->write('all terms');
	        return $response;
        });
    });
};