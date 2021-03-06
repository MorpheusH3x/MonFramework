<?php
namespace Framework;

use GuzzleHttp\Psr7\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class App
{
    public function run(ServerRequestInterface $request): ResponseInterface
    {
        $uri = $request->getUri()->getPath();

        if (!empty($uri) && $uri[-1] === "/") {
            return (new Response())
                ->withStatus(301)
                ->withHeader('Location', substr($uri, 0, -1));
        }

        if ($uri === '/blog') {
            return (new Response())
            ->withStatus(200)
            ->getBody()->write('<h1> Bienvenue sur le blog </h1>');
        }

        //If any page is triggered, return 404
        return (new Response())
        ->withStatus(404)
        ->getBody()->write('h1> Erreur 404 </h1>');
    }
}
