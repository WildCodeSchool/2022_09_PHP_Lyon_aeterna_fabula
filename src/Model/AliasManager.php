<?php

namespace App\Model;

use PDO;

class AliasManager extends AbstractManager
{
    public const TABLE = 'alias';

    //insert new alias

    public function addAlias(array $alias, int $user_id): void
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
        $statement->bindValue('user_id', $user_id, PDO::PARAM_INT);


        $statement->execute();
    }
}
