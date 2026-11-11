<?php

namespace App\Models;

class VignetteJoueur extends Vignette
{
    private int $joueurId;

    public function __construct(int $id, int $numero, int $equipeId, int $joueurId)
    {
        parent::__construct($id, $numero, $equipeId);
        $this->joueurId = $joueurId;
    }

    public function getJoueurId(): int
    {
        return $this->joueurId;
    }

    public function getJoueur(): ?Joueur
    {
        return Joueur::findById($this->joueurId);
    }

    public function getType(): string
    {
        return 'joueur';
    }
}
