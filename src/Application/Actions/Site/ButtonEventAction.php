<?php

namespace App\Application\Actions\Site;

use App\Models\ButtonClickCount;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Respect\Validation\Validator;

class ButtonEventAction
{
    public function __invoke(Request $request, Response $response, array $args): Response
    {
        $button =  $args['name'];

        $paramValidator = Validator::regex('/^[a-z-]+$/');

        if (!$paramValidator->validate($button)) {
            return $this->errorResponse($response, 'Invalid slug format', 400);
        }

        $event = ButtonClickCount::where('name', $args['name'])->first();
        
        if (!$event) {
            return $this->errorResponse($response, 'Button not found', 404);
        }

        $event->increment('count');

        return $response->withStatus(204);
    }

    private function errorResponse(Response $response, string $message, int $status): Response
    {
        $response->getBody()->write(json_encode([
            'status' => 'error',
            'message' => $message
        ]));

        return $response->withStatus($status)
            ->withHeader('Content-Type', 'application/json');
    }
}