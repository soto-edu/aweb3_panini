<?php

use Slim\App;
use App\Controllers\AccueilController;
use App\Controllers\EquipesController;

return function (App $app) {
    $app->get('/', [AccueilController::class, 'index']);
    $app->get('/equipes', [EquipesController::class, 'getAllEquipes']);
    $app->get('/equipes/{id}', [EquipesController::class, 'getEquipeById']);
};