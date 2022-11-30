<?php

namespace App\Model;

use PDO;

class ActionManager extends AbstractManager
{
    public const TABLE = 'action';

    /**
     * action update item in database / admin only
     */
    public function adminUpdateAction(array $action): bool
    {
        $query = "UPDATE " . self::TABLE . " SET 
        `label` = :label,
        `owner_id` = :owner_id,
        `target_id` = :target_id
        WHERE id=:id;
        ";

        $statement = $this->pdo->prepare($query);
        $statement->bindValue('id', $action['id'], PDO::PARAM_INT);
        $statement->bindValue('label', $action['label'], PDO::PARAM_STR);
        $statement->bindValue('owner_id', $action['owner_id'], PDO::PARAM_INT);
        $statement->bindValue('target_id', $action['target_id'], PDO::PARAM_INT);

        return $statement->execute();
    }

    public function adminInsertAction(array $action): bool
    {
        $query = "INSERT INTO " . self::TABLE . " SET 
        `label` = :label,
        `owner_id` = :owner_id,
        `target_id` = :target_id;
        ";

        $statement = $this->pdo->prepare($query);
        $statement->bindValue('label', $action['label'], PDO::PARAM_STR);
        $statement->bindValue('owner_id', $action['owner_id'], PDO::PARAM_INT);
        $statement->bindValue('target_id', $action['target_id'], PDO::PARAM_INT);

        return $statement->execute();
    }

    public function selectActionWithTargetIdIsNull(): array
    {
        $query = "SELECT id FROM " . self::TABLE . " WHERE target_id IS NULL;";

        return $this->pdo->query($query)->fetchAll();
    }
}
