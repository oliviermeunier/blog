<?php


///////////////////////////////////////////////////////////////
// Traitements : récupérer les données pour afficher 1 article

/**
 * Validation du paramètre postid. On vérifie si il y a un problème :
 *      - si le paramètre postid n'existe pas
 *      - ou bien si sa valeur est vide
 *      - ou bien si ce n'est pas un entier
 */ 
if(!array_key_exists('postid', $_GET) || empty($_GET['postid']) || !ctype_digit($_GET['postid'])){

    echo "Attention : pas de paramètre 'postid' dans l'URL !";
    exit;
}

// récupérer le paramètre postid dans la chaîne de requête (URL)
$postId = $_GET['postid'];

// Récupération de l'article
$postModel = new \App\Models\PostModel();
$post = $postModel->getOnePost($postId);

// Récupération des commentaires
$commentModel = new \App\Models\CommentModel();
$comments = $commentModel->getCommentsByPostId($postId);

// On récupère le cas échéant les messages flash
$successMessages = fetchFlashMessages('success');

/////////////////////////////////////////////////////////////
// Affichage : inclusion du fichier de template
render('show_post', [
    'post' => $post,
    'comments' => $comments,
    'successMessages' => $successMessages
]);