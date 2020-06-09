<?php 

namespace App\Models;

use App\Core\Model;

class CommentModel extends Model {

    /**
     * Récupère les commentaires associés à un article
     */
    function getCommentsByPostId(int $postId): array 
    {
        // récupérer les commentaires associés à l'article
        $sql = 'SELECT * 
                FROM comment
                WHERE postId = ?
                ORDER BY createdAt DESC';

        // Récupération des résultats
        return self::$database->fetchAllRows($sql, [$postId]);
    }

    /**
     * Insère un commentaire
     */
    function insertComment(string $nickname, string $content, int $postId): ?int 
    {
        // insérer le commentaire
        $sql = 'INSERT INTO comment (nickname, content, createdAt, postId) 
                VALUES (?, ?, NOW(), ?)';

        // Exécution de la requête
        return self::$database->insertQuery($sql, [$nickname, $content, $postId]);
    }
}