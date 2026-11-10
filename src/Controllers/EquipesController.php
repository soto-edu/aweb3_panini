<?php

namespace App\Controllers;

use App\Models\Equipe;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class EquipesController extends RenderController
{
    public function getAllEquipes(Request $request, Response $response): Response
    {
        $equipes = Equipe::findAll();
        $page = 'equipes';
        return $this->render($response, $page, [
            'equipes' => $equipes,
        ]);
    }

    public function getEquipeById(Request $request, Response $response, array $args): Response
    {
        $id = (int) $args['id'];
        $equipe = Equipe::findById($id);
        $page = 'equipe';
        return $this->render($response, $page, [
            'equipe' => $equipe,
        ]);
    }
}
