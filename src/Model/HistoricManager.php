<?php

namespace App\Model;

use PDO;

class HistoricManager extends AbstractManager
{
    public const TABLE = 'historic';

    public function historicInsert(int $actionId, int $aliasId): void
    {
        $query = "INSERT INTO " . self::TABLE . " (
            `historic_date`,
            `action_id`,
            `alias_id`
            )

            VALUES (
                NOW(),
                :action_id,
                :alias_id     
                )";

        $statement = $this->pdo->prepare($query);

        $statement->bindValue('action_id', $actionId, PDO::PARAM_INT);
        $statement->bindValue('alias_id', $aliasId, PDO::PARAM_INT);

        $statement->execute();
    }

    public function selectActionsByHistoric(): array|false
    {
        // prepared request
        $query = "SELECT h.id, h.action_id, h.historic_date, a.id AS actionID, a.label, c.number, c.title, c.description
        FROM historic AS h
        LEFT JOIN action AS a ON h.action_id  = a.id
        LEFT JOIN chapter AS c ON a.owner_id = c.id;";

        return $this->pdo->query($query)->fetchAll();
    }
}
