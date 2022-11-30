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
        false
        )";

        $statement = $this->pdo->prepare($query);

        $statement->bindValue('email', $user['email'], PDO::PARAM_STR);
        $statement->bindValue('password', password_hash($user['password'], PASSWORD_DEFAULT), PDO::PARAM_STR);
        $statement->execute();

        return (int)$this->pdo->lastInsertId();
    }

    public function selectOneByEmail(array $user): array|false
    {
        $statement = $this->pdo->prepare("SELECT * FROM " . static::TABLE . " WHERE email=:email");
        $statement->bindValue('email', $user['email'], PDO::PARAM_STR);
        $statement->execute();

        return $statement->fetch();
    }
}
