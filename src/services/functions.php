<?php

/**
 * Initialise le tableau de messages en session en fonction d'un certain type de messages
 * @param string $type : le type de messages souhaité
 */
function initFlashBag(string $type)
{
    // Si aucune session n'existe... 
    if( session_status() == PHP_SESSION_NONE ){

        // on en démarre une
        session_start();
    }

    // Si la clé 'flashbag' N'existe PAS dans le tableau $_SESSION
    if(!array_key_exists('flashbag', $_SESSION)){

        // On crée cette clé et on stocke comme valeur associée un tableau vide
        $_SESSION['flashbag'] = [];
    }

    // Si la clé qui correspond au type de message ($type) N'existe PAS dans $_SESSION['flashbag']
    if(!array_key_exists($type, $_SESSION['flashbag'])){

        // On crée cette clé et on stocke comme valeur associée un tableau vide
        $_SESSION['flashbag'][$type] = [];    
    }
}

/**
 * Ajoute un message au flashbag en session
 * @param string $message : le message à ajouter
 * @param string $type : le type du message ('success', 'error', etc)
 */
function addFlashMessage(string $message, string $type = 'success'): void 
{
    // Initialisation du flashbag
    initFlashBag($type);

    // Ajouter le message ($message) au tableau
    $_SESSION['flashbag'][$type][] = $message;

}

/**
 * Récupère tous les messages flash d'un type particulier et les efface de la session
 * @param string $type : le type des messages qu'on souhaite récupérer ('success', 'error', etc)
 * @return array : le tableau contenant les messages
 */
function fetchFlashMessages(string $type = 'success'): array 
{
    // Initialisation du flashbag
    initFlashBag($type);

    // On récupère les messages du type demandé et on les stocke dans une variable
    $messages = $_SESSION['flashbag'][$type];

    // On les supprime (on remplace le tableau par un tableau vide)
    $_SESSION['flashbag'][$type] = [];

    // On retourne les messages
    return $messages;
}

/**
 * Vérifie si il existe des messages d'un certain type dans le falshbag en session
 * @param string $type : le type de message dont on veut savoir s'il y en a ou non
 * @return bool : true si il y a effectivement des messages, false sinon
 */
function hasFlashMessages(string $type): bool 
{
    // Initialisation du flashbag
    initFlashBag($type);

    // Retourne true s'il y a au moins 1 message de ce type, false sinon
    return count($_SESSION['flashbag'][$type]) > 0;
}

/**
 * Génère le rendu HTML d'une page
 */
function render(string $view, array $values = [])
{
    // Transformation du contenu du tableau associatif $values en variables
    // Le nom des variables correspond aux clés du tableau, les valeurs aux valeurs
    extract($values);

    include VIEWS_DIR . '/base.phtml';
}

/**
 * Construit une URL avec éventuellement des paramètres dans la chaîne de requête
 */
function buildUrl(string $route, array $params = []): string
{
    $url = BASE_URL . $route; // /web-developer/greta-live-share/blog/www/post par exemple

    if (!empty($params)) {
        $url .= '?' . http_build_query($params);
    };

    return $url;
}

/**
 * Initialise la session le cas échéant
 */
function startSession()
{
    // Si aucune session n'existe... 
    if( session_status() == PHP_SESSION_NONE ){

        // on en démarre une
        session_start();
    }
}

/**
 * 
 */
function userSessionRegister(int $id, string $email, string $firstname, string $lastname) 
{
    // Si aucune session n'existe... 
    startSession();

    $_SESSION['user'] = [
        'id' => $id,
        'email' => $email,
        'firstname' => $firstname,
        'lastname' => $lastname
    ];
}


function isAuthenticated(): bool 
{
    // Si aucune session n'existe... 
    startSession();

    if (array_key_exists('user', $_SESSION) && isset($_SESSION['user'])) {
        return true;
    }

    return false;
}


function getUserSessionId()
{
    if (isAuthenticated()) {
        return $_SESSION['user']['id'];
    }

    return null;
}


function logout()
{
    if (isAuthenticated()) {
        $_SESSION['user'] = []; // ou unset($_SESSION['user'])
        session_destroy();
    }
}


function formatDate(string $date)
{
    return date('d/m/Y',strtotime($date));
}

function asset(string $asset) {
    return BASE_URL . '/' . $asset;
}