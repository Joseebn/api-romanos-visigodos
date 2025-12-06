<?php

namespace App\Application\Actions\Site;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use App\Models\DictionaryTerm;
use Respect\Validation\Validator;

class ShowDictionaryTermAction
{
    public function __invoke(Request $request, Response $response): Response
    {
        $slug = $request->getAttribute('slug');
        $slugValidator = Validator::regex('/^[a-z-]+$/');

        if (!$slugValidator->validate($slug)) {
            return $this->errorSlug($response, 'Invalid slug format');
        }

        $term = $this->getTerm($slug);

        if (!$term) {
            return $this->errorTermNotFound($response);
        }
        
        $response->getBody()->write(json_encode($term));
        return $response->withStatus(200)
            ->withHeader('Content-Type', 'application/json');
    }

    private function errorSlug(Response $response, string $message): Response
    {
        $response->getBody()->write(json_encode([
            'status' => 'error',
            'message' => $message
        ]));
        return $response->withStatus(400)
            ->withHeader('Content-Type', 'application/json');
    }

    private function errorTermNotFound(Response $response): Response
    {
        $response->getBody()->write(json_encode([
            'status' => 'error',
            'message' => 'Term not found'
        ]));
        return $response->withStatus(404)
            ->withHeader('Content-Type', 'application/json');
    }

    private function getTerm(string $slug): ?DictionaryTerm
    {
        return DictionaryTerm::select('name', 'description', 'term_path')
            ->where('term_path', $slug)
            ->first();
    }
}
