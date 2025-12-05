<?php

namespace App\Application\Actions\Site;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use App\Models\ArchitectureType;

class DictionaryAction
{
    public function __invoke(Request $request, Response $response)
    {
        $getArchitectureType = $this->getTerms();
        $response->getBody()->write($getArchitectureType);
        return $response;
    }

    private function getTerms(): string
    {
        $terms = ArchitectureType::first();
        return $terms->name;
    }
}
