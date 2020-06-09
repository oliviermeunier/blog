<?php 

namespace App\Models;

use App\Core\Model;

class UserModel extends Model {   

  /**
    * Récupère un enregitrement de la table User à partir d'une adresse email
    */
  function getUserByEmail(string $email)
  {
    $sql = 'SELECT * 
            FROM User
            WHERE email = ?';

    return self::$database->fetchOneRow($sql, [ $email ]);
  }
}