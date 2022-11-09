<?php

namespace App\Model;

use PDO;

class UserManager extends AbstractManager
{
    public const TABLE = 'user';

    public function addUser(array $user): int
    {
        $query = "INSERT INTO " . self::TABLE . "(
        `email`,
        `password`,
        `is_admin`
        )
        
        VALUES (
        :email,
        :password,
        :is_admin
        )";

        $statement = $this->pdo->prepare($query);

        $statement->bindValue('email', $user['email'], PDO::PARAM_STR);
        $statement->bindValue('password', $user['password'], PDO::PARAM_STR);
        $statement->bindValue('is_admin', false, PDO::PARAM_BOOL);
        $statement->execute();

        return (int)$this->pdo->lastInsertId();
    }
}
