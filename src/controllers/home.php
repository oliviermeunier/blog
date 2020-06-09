<?php 

use App\Models\PostModel;

// Récupération des articles
$postModel = new PostModel();
$posts = $postModel->getAllPosts();

// Affichage : inclusion du fichier de template 
render('home', [
    'posts' => $posts,
    'successMessages' => fetchFlashMessages()
]);