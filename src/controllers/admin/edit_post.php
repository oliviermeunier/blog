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

// Si le formulaire est soumis 
if (!empty($_POST)) {

    $title = $_POST['title'];
    $content = $_POST['content'];
    $categoryId = $_POST['category'];
    $image = $_POST['image'];

    // Insertion de l'article en BDD
    $postModel->updatePost($title, $content, $categoryId, $image, $postId);
    
    // Ajout d'un message flash
    addFlashMessage('Article correctement mis à jour.');

    // Redirection vers le dashboard admin
    header('Location: ' . buildUrl('/admin'));
    exit;
}

// Récupération de l'article
$post = $postModel->getOnePost($postId);

// On récupère la liste des catégories pour afficher le liste déroulante des catégories
$categoryModel = new \App\Models\CategoryModel();
$categories = $categoryModel->getAllCategories();

// Affichage du template
render('admin/edit_post', [
    'categories' => $categories,
    'post' => $post
]);