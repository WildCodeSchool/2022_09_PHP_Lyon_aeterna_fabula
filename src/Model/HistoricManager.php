<?php

namespace App\Model;

use PDO;

class HistoricManager extends AbstractManager
{
    public const TABLE = 'historic';

    public function historicInsert(int | null $actionId): void
    {
        $query = "INSERT INTO " . self::TABLE . " (
            `historic_date`,
            `action_id`
            )

            VALUES (
                NOW(),
                :action_id         
                )";

        $statement = $this->pdo->prepare($query);

        $statement->bindValue('action_id', $actionId, PDO::PARAM_INT);

        $statement->execute();
    }
}
