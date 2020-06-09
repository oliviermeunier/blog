<?php

namespace App\Models;

use App\Core\Model;

class PostModel extends Model {

    /**
     * Récupère tous les articles
     */
    function getAllPosts(): array 
    {
        $sql = 'SELECT P.id AS postid, title, content, P.updatedAt AS postUpdatedAt, P.createdAt AS postCreatedAt, firstname, lastname, image, C.name AS category
                FROM post AS P
                INNER JOIN user AS U ON P.userId = U.id
                INNER JOIN category AS C ON P.categoryId = C.id
                ORDER BY P.createdAt DESC';

        // Récupération des résultats
        return self::$database->fetchAllRows($sql);
    }

    /**
     * Récupère 1 article
     */
    function getOnePost(int $postId): array
    {
        // récupérer les données de l'article
        $sql = 'SELECT P.id AS postid, title, content, P.updatedAt AS postUpdatedAt, P.createdAt AS postCreatedAt, firstname, lastname, image, C.name AS category, C.id AS categoryId
                FROM post AS P
                INNER JOIN user AS U ON P.userId = U.id
                INNER JOIN category AS C ON P.categoryId = C.id
                WHERE P.id = ?';

        // Récupération des résultats
        return self::$database->fetchOneRow($sql, [$postId]);
    }

    /**
     * Insère un article dans la base de données
     */
    function insertPost(string $title, string $content, int $categoryId, string $image, int $userId): ?int
    {
        $sql = 'INSERT INTO post
                (title, content, image, categoryId, userId, createdAt)
                VALUES (?, ?, ?, ?, ?, NOW())';

        return self::$database->insertQuery($sql, [$title, $content, $image, $categoryId, $userId]);
    }

    /**
     * Met à jour un article
     */
    function updatePost(string $title, string $content, int $categoryId, string $image, int $postid)
    {
        $sql = 'UPDATE post 
                SET title = ?, content = ?, categoryId = ?, image = ?, updatedAt = NOW()
                WHERE id = ?';

        self::$database->executeQuery($sql, [$title, $content, $categoryId, $image, $postid]);
    }

    /**
     * Supprime un article
     */
    function deletePost(int $postId) 
    {
        $sql = 'DELETE FROM post WHERE id = ?';

        self::$database->executeQuery($sql, [$postId]);
    }
}