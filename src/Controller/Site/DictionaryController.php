<?php

namespace App\Controller\Site;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

//use App\Aplication\Action\Site\DictionaryAction;

class DictionaryController
{
   public function __invoke(Request $request, Response $response)
    {
        $response->getBody()->write('All terms');
        return $response;
    }
}