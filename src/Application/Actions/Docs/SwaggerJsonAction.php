<?php

namespace App\Application\Actions\Docs;

use OpenApi\Generator;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class SwaggerJsonAction
{
    public function __invoke(Request $request, Response $response): Response
    {
        $openapi = Generator::scan([__DIR__ . '/../../../']);

        $response->getBody()->write($openapi->toJson());
        return $response->withHeader('Content-Type', 'application/json');
    }
}
