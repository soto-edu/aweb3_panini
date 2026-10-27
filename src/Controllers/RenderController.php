<?php

namespace App\Controllers;

use Psr\Http\Message\ResponseInterface as Response;

class RenderController
{
    protected function render(Response $response, string $view, array $data = []): Response
    {
        extract($data);

        ob_start();
        include dirname(__DIR__) . '/Views/' . $view . '.php';
        $response->getBody()->write(ob_get_clean());

        return $response;
    }
}
