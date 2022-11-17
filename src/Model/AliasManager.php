<?php

namespace App\Model;

use PDO;

class AliasManager extends AbstractManager
{
    public const TABLE = 'alias';

    //insert new alias

    public function addAlias(array $alias, int $userId): int
    {
        $query = "INSERT INTO " . self::TABLE . " (
            `player_name`,
            `nature`,
            `user_id`
            )
             VALUES (
                :player_name,
                'ONGOING',
                :user_id          
                )";

        $statement = $this->pdo->prepare($query);

        $statement->bindValue('player_name', $alias['player_name'], PDO::PARAM_STR);
        $statement->bindValue('user_id', $userId, PDO::PARAM_INT);

        $statement->execute();
        return (int)$this->pdo->lastInsertId();
    }

    public function modifyNature(int $aliasId): void
    {
        $query = "UPDATE " . self::TABLE . " SET nature='FINISHED' WHERE id = $aliasId;";
        $this->pdo->exec($query);
    }

    public function selectOneByUserId(int $id): array|false
    {
        // prepared request
        $statement = $this->pdo->prepare("SELECT * FROM " . static::TABLE . " WHERE user_id=:id");
        $statement->bindValue('id', $id, \PDO::PARAM_INT);
        $statement->execute();

        return $statement->fetchAll();
    }

    public function selectAliasNameOngoing(int $userId): array
    {
        $query = "SELECT player_name FROM " . self::TABLE . " WHERE nature = 'ONGOING' AND user_id = " . $userId . ";";

        return $this->pdo->query($query)->fetchAll();
    }

    public function selectAliasIdOngoing(int $userId): array
    {
        $query = "SELECT id FROM " . self::TABLE . " WHERE nature = 'ONGOING' AND user_id = " . $userId . ";";

        return $this->pdo->query($query)->fetchAll();
    }

    public function selectLastActionByHistoric(int $aliasId): array|false
    {
        // prepared request
        $query = "SELECT a.target_id, a.id
            FROM historic AS h
            LEFT JOIN action AS a ON h.action_id  = a.id
            LEFT JOIN chapter AS c ON a.owner_id = c.id
            WHERE h.alias_id = $aliasId
            ORDER BY historic_date DESC LIMIT 1;";

        return $this->pdo->query($query)->fetch();
    }
}
