<?php

// Si l'utilisateur n'est pas connecté
if (!isAuthenticated()) {
    header('Location: ' . buildUrl('/admin/login'));
    exit;
}

if(!array_key_exists('postid', $_GET) || empty($_GET['postid']) || !ctype_digit($_GET['postid'])){

    echo "Attention : pas de paramètre 'postid' dans l'URL !";
    exit;
}

// récupérer le paramètre postid dans la chaîne de requête (URL)
$postId = $_GET['postid'];

// Création d'un objet PostModel
$postModel = new \App\Models\PostModel();
$postModel->deletePost($postId);

// Ajout d'un message flash
addFlashMessage('Article supprimé.');

// Redirection vers le dashboard admin
header('Location: ' . buildUrl('/admin'));
exit;