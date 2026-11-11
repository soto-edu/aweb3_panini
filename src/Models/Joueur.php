<?php

namespace App\Models;

use App\Services\Database;

class Joueur
{
    private int $id;
    private string $nom;
    private string $prenom;
    private string $position;
    private int $numeroMaillot;
    private int $equipeId;

    public function __construct(
        int $id,
        string $nom,
        string $prenom,
        string $position,
        int $numeroMaillot,
        int $equipeId
    ) {
        $this->id = $id;
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->position = $position;
        $this->numeroMaillot = $numeroMaillot;
        $this->equipeId = $equipeId;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getNom(): string
    {
        return $this->nom;
    }

    public function getPrenom(): string
    {
        return $this->prenom;
    }

    public function getPosition(): string
    {
        return $this->position;
    }

    public function getNumeroMaillot(): int
    {
        return $this->numeroMaillot;
    }

    public function getEquipeId(): int
    {
        return $this->equipeId;
    }

    public function getNomComplet(): string
    {
        return $this->prenom . ' ' . $this->nom;
    }

    public function getEquipe(): ?Equipe
    {
        return Equipe::findById($this->equipeId);
    }

    public static function findById(int $id): ?self
    {
        $pdo = Database::getConnection();
        $statement = $pdo->prepare(
            'SELECT id, nom, prenom, position, numero_maillot, equipe_id
             FROM joueurs
             WHERE id = :id'
        );
        $statement->execute(['id' => $id]);
        $row = $statement->fetch();

        if ($row === false) {
            return null;
        }

        return new self(
            (int) $row['id'],
            $row['nom'],
            $row['prenom'],
            $row['position'],
            (int) $row['numero_maillot'],
            (int) $row['equipe_id']
        );
    }

    /**
     * @return self[]
     */
    public static function findByEquipe(int $equipeId): array
    {
        $pdo = Database::getConnection();
        $statement = $pdo->prepare(
            'SELECT id, nom, prenom, position, numero_maillot, equipe_id
             FROM joueurs
             WHERE equipe_id = :equipe_id
             ORDER BY numero_maillot'
        );
        $statement->execute(['equipe_id' => $equipeId]);
        $rows = $statement->fetchAll();

        $joueurs = [];
        foreach ($rows as $row) {
            $joueurs[] = new self(
                (int) $row['id'],
                $row['nom'],
                $row['prenom'],
                $row['position'],
                (int) $row['numero_maillot'],
                (int) $row['equipe_id']
            );
        }

        return $joueurs;
    }
}
