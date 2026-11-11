<?php

namespace App\Models;

use App\Services\Database;
use RuntimeException;

abstract class Vignette
{
    protected int $id;
    protected int $numero;
    protected int $equipeId;

    public function __construct(int $id, int $numero, int $equipeId)
    {
        $this->id = $id;
        $this->numero = $numero;
        $this->equipeId = $equipeId;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getNumero(): int
    {
        return $this->numero;
    }

    public function getEquipeId(): int
    {
        return $this->equipeId;
    }

    public function getEquipe(): ?Equipe
    {
        return Equipe::findById($this->equipeId);
    }

    abstract public function getType(): string;

    public static function findById(int $id): ?self
    {
        $pdo = Database::getConnection();
        $statement = $pdo->prepare(
            'SELECT v.id, v.numero, v.equipe_id, v.type, vj.joueur_id
             FROM vignettes v
             LEFT JOIN vignettes_joueurs vj ON vj.vignette_id = v.id
             WHERE v.id = :id'
        );
        $statement->execute(['id' => $id]);
        $row = $statement->fetch();

        if ($row === false) {
            return null;
        }

        return self::createFromRow($row);
    }

    /**
     * @return self[]
     */
    public static function findByEquipe(int $equipeId): array
    {
        $pdo = Database::getConnection();
        $statement = $pdo->prepare(
            'SELECT v.id, v.numero, v.equipe_id, v.type, vj.joueur_id
             FROM vignettes v
             LEFT JOIN vignettes_joueurs vj ON vj.vignette_id = v.id
             WHERE v.equipe_id = :equipe_id
             ORDER BY v.numero'
        );
        $statement->execute(['equipe_id' => $equipeId]);
        $rows = $statement->fetchAll();

        $vignettes = [];
        foreach ($rows as $row) {
            $vignettes[] = self::createFromRow($row);
        }

        return $vignettes;
    }

    private static function createFromRow(array $row): self
    {
        if ($row['type'] === 'joueur') {
            return new VignetteJoueur(
                (int) $row['id'],
                (int) $row['numero'],
                (int) $row['equipe_id'],
                (int) $row['joueur_id']
            );
        }

        throw new RuntimeException('Type de vignette inconnu : ' . $row['type']);
    }
}
