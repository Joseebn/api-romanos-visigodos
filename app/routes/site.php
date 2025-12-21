<?php

use Slim\App;
use App\Application\Actions\Site\ButtonEventAction;
use App\Application\Actions\Site\GalleryAction;
use App\Application\Actions\Site\ListDictionaryTermsAction;
use App\Application\Actions\Site\ShowDictionaryTermAction;
use App\Application\Actions\Site\PostAction;
use App\Application\Actions\Site\MonumentAction;
use App\Application\Middleware\AuthMiddleware;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Interfaces\RouteCollectorProxyInterface as Group;


return function (App $app) {

    $app->group('/site', function (Group $site) {

        $site->patch('/button-event/{name}/clicks', ButtonEventAction::class);

        $site->group('/dictionary', function (Group $dictionary) {
            $dictionary->get('', ListDictionaryTermsAction::class);
            $dictionary->get('/{slug}', ShowDictionaryTermAction::class);
        });

        $site->get('/gallery', GalleryAction::class);

        $site->get('/posts', function (Request $request, Response $response) {
    	        $response->getBody()->write('all news');
	        return $response;
        });
        $site->get('/posts/{slug}', function (Request $request, Response $response, array $args) {
            $response->getBody()->write('news item: ' . $args['slug']);
            return $response;
        });
        $site->get('/monuments', function (Request $request, Response $response) {
    	        $response->getBody()->write('all monuments');
	        return $response;
        });
        $site->get('/monuments/{slug}', function (Request $request, Response $response, array $args) {
            $response->getBody()->write('news item: ' . $args['slug']);
            return $response;
        });

        


    })->add(new AuthMiddleware());
};