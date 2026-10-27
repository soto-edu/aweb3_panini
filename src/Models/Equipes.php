<?php

/**
 * Documentation PHP, pour acceder à la connexion PDO $pdo = Database::getConnection();
 * https://www.php.net/manual/fr/language.oop5.paamayim-nekudotayim.php
 */

namespace App\Models;

use App\Services\Database;
use PDO;

class Equipes
{
    private PDO $pdoConnection;
    private $id;
    private $pays;

    public function __construct($id, $pays)
    {
        $this->id = $id;
        $this->pays = $pays;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getPays()
    {
        return $this->pays;
    }

    public static function findAll(): array
    {
        $pdo = Database::getConnection();
        $statement = $pdo->query('SELECT id, pays FROM equipes ORDER BY id');
        $rows = $statement->fetchAll();

        $equipes = [];
        foreach ($rows as $row) {
            $equipes[] = new self($row['id'], $row['pays']);
        }

        return $equipes;
    }

    public static function findById(int $id): ?self
    {
        $pdo = Database::getConnection();
        $statement = $pdo->prepare('SELECT id, pays FROM equipes WHERE id = :id');
        $statement->execute(['id' => $id]);
        $row = $statement->fetch();

        if ($row === false) {
            return null;
        }

        return new self($row['id'], $row['pays']);
    }
}
