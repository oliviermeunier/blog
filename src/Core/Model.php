<?php

namespace App\Core;

abstract class Model {

    /**
     * @var Database - static property (same for all Model objects) that stores the Database object
     */
    static protected $database = null;

    /**
     * Constructeur
     */
    public function __construct()
    {
        // Si la propriété statiques $database n'a pas encore été initialisée...
        if (self::$database === null) {

            // ... on l'initialise en créant un objet Database
            self::$database = new Database();
        }
    }
}