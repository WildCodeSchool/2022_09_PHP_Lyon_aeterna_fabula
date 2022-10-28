<?php

namespace App\Model;

use PDO;

class ChapterManager extends AbstractManager
{
    public const TABLE = 'chapter';

    /**
     * Insert new chapter in database / admin only
     */
    public function adminInsert(array $chapter): int
    {
        $query = "INSERT INTO " . self::TABLE . " (
            `name`,
            `title`,
            `description`,
            `background_image`,
            `background_image_alt`
            )

             VALUES (
                :name,
                :title,
                :description,
                :background_image,
                :background_image_alt             
                )";

        $statement = $this->pdo->prepare($query);

        $statement->bindValue('name', $chapter['name'], PDO::PARAM_STR);
        $statement->bindValue('title', $chapter['title'], PDO::PARAM_STR);
        $statement->bindValue('description', $chapter['description'], PDO::PARAM_STR);
        $statement->bindValue('background_image', $chapter['background_image'], PDO::PARAM_STR);
        $statement->bindValue('background_image_alt', $chapter['background_image_alt'], PDO::PARAM_STR);

        $statement->execute();
        return (int)$this->pdo->lastInsertId();
    }

    /**
     * Chapter update item in database / admin only
     */
    public function adminUpdate(array $chapter): bool
    {
        $query = "UPDATE " . self::TABLE . " SET 
        `name` = :name,
        `title` = :title,
        `description` = :description,
        `background_image` = :background_image,
        `background_image_alt` = :background_image_alt
        WHERE id=:id
        ";

        $statement = $this->pdo->prepare($query);
        $statement->bindValue('id', $chapter['id'], PDO::PARAM_INT);
        $statement->bindValue('name', $chapter['name'], PDO::PARAM_STR);
        $statement->bindValue('title', $chapter['title'], PDO::PARAM_STR);
        $statement->bindValue('description', $chapter['description'], PDO::PARAM_STR);
        $statement->bindValue('background_image', $chapter['background_image'], PDO::PARAM_STR);
        $statement->bindValue('background_image_alt', $chapter['background_image_alt'], PDO::PARAM_STR);

        return $statement->execute();
    }
}
