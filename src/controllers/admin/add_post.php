<?php 

// Import des classes
use App\Core\ImageFileUploader;

// Si l'utilisateur n'est pas connecté
if (!isAuthenticated()) {
    header('Location: ' . buildUrl('/admin/login'));
    exit;
}

// Initialisation de la variable $error qui contiendra le cas échéant un message d'erreur
$error = null;

// Si le formulaire est soumis 
if (!empty($_POST)) {

    try {
        $userId = getUserSessionId();

        $title = $_POST['title'];
        $content = $_POST['content'];
        $categoryId = $_POST['category'];
        $image = $_FILES['image'];

        // File
        $fileUploader = new ImageFileUploader('image');
        $filename = $fileUploader->moveTempFile('upload/posts/');

        // Insertion de l'article en BDD
        $postModel = new \App\Models\PostModel();
        $postId = $postModel->insertPost($title, $content, $categoryId, $filename, $userId);

        // Message flash de confirmation
        addFlashMessage('Article ajouté.');

        // Redirection vers le dashboard
        header('Location: ' . buildUrl('/admin'));
        exit;
    }
    catch(Exception $exception) {
        $error = $exception->getMessage();
    }
}

// Si le formualire n'a pas été soumis OU si il comporte des erreurs, on l'affiche

// On récupère la liste des catégories pour afficher le liste déroulante des catégories
$categoryModel = new \App\Models\CategoryModel();
$categories = $categoryModel->getAllCategories();

render('admin/add_post', [
    'categories' => $categories,
    'error' => $error
]);