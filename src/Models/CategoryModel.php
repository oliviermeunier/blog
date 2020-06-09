<?php 

namespace App\Models;

use App\Core\Model;

class CategoryModel extends Model {

    /**
     * Récupère toutes les catégories d'articles
     */
    function getAllCategories()
    {
        $sql = 'SELECT *
                FROM category
                ORDER BY name';

        return self::$database->fetchAllRows($sql);
    }
}