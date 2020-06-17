<?php 

////////////////////////////////////////
// Inclusion des dépendances si besoin /
////////////////////////////////////////

// Inclusion du fichier d'autoload de Composer
require '../vendor/autoload.php';
require '../config.php';
require SERVICES_DIR . '/functions.php';

// Détection de la route
$route = '/'; // Par défaut on sera sur la page d'accueil 
if (array_key_exists('route', $_GET)) {
    $route = $_GET['route']; // Sinon on récupère présente dans l'URL
}

// Routing 
switch ($route) {

    // Page d'accueil
    case '/':
        require CONTROLLERS_DIR . '/home.php';
        break;

    // Page Article
    case '/post': 
        require CONTROLLERS_DIR . '/show_post.php';    
        break;

    // Ajout d'un commentaire
    case '/comment/new':
        require CONTROLLERS_DIR . '/add_comment.php';        
        break;

    // Connexion à l'interface d'administration
    case '/admin/login':
        require CONTROLLERS_DIR . '/login.php';        
        break;    

    // Interface d'administration
    case '/admin':
        require CONTROLLERS_DIR . '/admin/admin.php';        
        break; 

    // Rédaction d'article
    case '/admin/post/new':
        require CONTROLLERS_DIR . '/admin/add_post.php';        
        break;

    // Edition d'article
    case '/admin/post/edit':
        require CONTROLLERS_DIR . '/admin/edit_post.php';        
        break;

    // Suppression d'un article
    case '/admin/post/delete':
        require CONTROLLERS_DIR . '/admin/delete_post.php';        
        break;
        
    // Déconnexion
    case '/admin/logout':
        require CONTROLLERS_DIR . '/admin/logout.php';  
        break;

    // Contact
    case '/contact':
        require CONTROLLERS_DIR . '/contact.php';  
        break;

    // Traitement des données du formulaire de contact
    case '/ajax/contact':
        require CONTROLLERS_DIR . '/ajax/contact.php';  
        break;
}


