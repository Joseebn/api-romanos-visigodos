<?php

declare(strict_types=1);

use App\Application\Actions\Auth\LoginAction;
use App\Application\Actions\Docs\SwaggerJsonAction;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\App;
use Slim\Interfaces\RouteCollectorProxyInterface as Group;

return function (App $app) {
    // swagger doc
    $app->get('/swagger.json', SwaggerJsonAction::class);

    // TODO: Uncomment and refactor when adding CORS middleware
    $app->options('/{routes:.*}', function (Request $request, Response $response) {
        // CORS Pre-Flight OPTIONS Request Handler
        return $response;
    });

    $app->group('/auth', function (Group $group) {
        $group->post('/login', LoginAction::class);
    });

    // website routes
    (require __DIR__ . '/routes/site.php')($app);
};
