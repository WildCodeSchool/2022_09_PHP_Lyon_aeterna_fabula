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
            `number`,
            `title`,
            `description`,
            `background_image`,
            `background_image_alt`
            )

             VALUES (
                :name,
                :number,
                :title,
                :description,
                :background_image,
                :background_image_alt             
                )";

        $statement = $this->pdo->prepare($query);

        $statement->bindValue('name', $chapter['name'], PDO::PARAM_STR);
        $statement->bindValue('number', $chapter['number'], PDO::PARAM_INT);
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
        `number` = :number,
        `name` = :name,
        `title` = :title,
        `description` = :description,
        `background_image` = :background_image,
        `background_image_alt` = :background_image_alt
        WHERE id=:id
        ";

        $statement = $this->pdo->prepare($query);
        $statement->bindValue('id', $chapter['id'], PDO::PARAM_INT);
        $statement->bindValue('number', $chapter['number'], PDO::PARAM_INT);
        $statement->bindValue('name', $chapter['name'], PDO::PARAM_STR);
        $statement->bindValue('title', $chapter['title'], PDO::PARAM_STR);
        $statement->bindValue('description', $chapter['description'], PDO::PARAM_STR);
        $statement->bindValue('background_image', $chapter['background_image'], PDO::PARAM_STR);
        $statement->bindValue('background_image_alt', $chapter['background_image_alt'], PDO::PARAM_STR);

        return $statement->execute();
    }

    /**
     * Get rows from database by ID.
     */
    public function selectActionsByChapterId(int $id): array|false
    {
        // prepared request
        $statement = $this->pdo->prepare(
            "SELECT c.background_image, c.id, c.number, c.title, c.description, a.id AS actionID, a.owner_id, a.target_id, label
            FROM chapter AS c
            LEFT JOIN action AS a ON a.owner_id = c.id
            WHERE c.id=:id"
        );
        $statement->bindValue('id', $id, \PDO::PARAM_INT);
        $statement->execute();

        return $statement->fetchAll();
    }

        /**
     * Get rows from database by ID.
     */
    public function selectActionsByChapterIdForAdmin(int $id): array|false
    {
        // prepared request
        $statement = $this->pdo->prepare(
            "SELECT c.background_image, c.id, c.number, c.title, c.description, c.name, c.background_image_alt, 
            a.owner_id, a.target_id, a.label
            FROM chapter AS c
            LEFT JOIN action AS a ON a.owner_id = c.id
            WHERE c.id=:id"
        );
        $statement->bindValue('id', $id, \PDO::PARAM_INT);
        $statement->execute();

        return $statement->fetchAll();
    }
}
