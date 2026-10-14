<?php

namespace App\Controllers;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class AccueilController
{
    public function index(Request $request, Response $response): Response
    {
        $titrePage = 'Collection Panini';

        ob_start();
        include dirname(__DIR__, 2) . '/src/Views/accueil.php';
        $response->getBody()->write(ob_get_clean());

        return $response;
    }
}