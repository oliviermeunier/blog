<?php 

namespace App\Core;

class Database {

    /**
     * @var PDO l'objet de la classe PDO qui stocke la connexion à la BDD
     */
    private $pdo;

    /**
     * Constrcuteur
     */
    public function __construct()
    {
        $this->pdo = $this->initPDOConnection();
    }

    /**
     * Crée l'objet PDO à partir des paramètres de connexion à la base de données
     */
    function initPDOConnection(): \PDO 
    {
        $dsn = 'mysql:host=' . BDD_HOST . ';dbname=' . BDD_NAME . ';charset=utf8';

        ///////////////////////////////////////////////////////
        // Créer une connexion à la base de données avec PDO
        // PDO est une classe PHP qu'on va instancier (créer un objet PDO)
        try {
            $pdo = new \PDO(
                $dsn, // (string) DSN (Data Source Name)
                BDD_USER, // Utilisateur
                BDD_PASSWORD, // Mot de passe
                [
                    \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
                    \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC
                ]
            );

            return $pdo;
        }
        catch(\Exception $exception) {
            var_dump($exception->getMessage());
        }

    }


    /**
     * Prépare et exécute une requête SQL
     */
    function executeQuery(string $sql, array $values = []): \PDOStatement
    {
        // On commence par préparer la requête SQL
        $query = $this->pdo->prepare($sql);

        // Exécution de la requête
        $query->execute($values);

        // On retourne l'objet requête (de la classe PDOStatement)
        return $query;
    }

    /**
     * Exécute une requête de sélection et retourne PLUSIEURS résultats
     */
    function fetchAllRows(string $sql, array $values = []): array
    {
        // On exécute la requête
        $query = $this->executeQuery($sql, $values);

        // On retourne tous les résultats
        return $query->fetchAll();
    }
                        
    /**
     * Exécute une requête de sélection et retourne UN résultat
     */
    function fetchOneRow(string $sql, array $values = [])
    {
        // On exécute la requête
        $query = $this->executeQuery($sql, $values);

        // On retourne tous les résultats
        return $query->fetch();
    }

    /**
     * Exécute une requête SQL d'insertion et retourne l'id de l'enregistrement créé
     */
    function insertQuery(string $sql, array $values = []): ?int
    {
        // On commence par préparer la requête SQL
        $query = $this->pdo->prepare($sql);

        // Exécution de la requête
        $query->execute($values);

        // On retourne l'id de l'enregistrement créé
        return $this->pdo->lastInsertId();
    }

}