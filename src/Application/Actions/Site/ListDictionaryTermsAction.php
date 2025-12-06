<?php

namespace App\Application\Actions\Site;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use App\Models\DictionaryTerm;

class ListDictionaryTermsAction
{
    public function __invoke(Request $request, Response $response): Response
    {
        $dictionary = $this->getTerms();
        $response->getBody()->write(json_encode($dictionary));
        return $response->withStatus(200)
            ->withHeader('Content-Type', 'application/json');
    }

    private function getTerms(): array
    {
        $terms = DictionaryTerm::select('name', 'description', 'term_path')
            ->orderBy('name', 'asc')
            ->get();
        
        $result = [];

        foreach ($terms as $term) {
            $index = substr($term->term_path, 0, 1);

            if (!isset($result[$index])) {
                $result[$index] = [];
            }

            array_push($result[$index], [
                'name' => $term->name,
                'description' => $term->description,
                'term_path' => $term->term_path,
            ]);
        }

        return $result;
    }
}
