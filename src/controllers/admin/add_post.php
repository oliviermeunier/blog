<?php 

// Si l'utilisateur n'est pas connecté
if (!isAuthenticated()) {
    header('Location: ' . buildUrl('/admin/login'));
    exit;
}

// Si le formulaire est soumis 
if (!empty($_POST)) {

    $title = $_POST['title'];
    $content = $_POST['content'];
    $categoryId = $_POST['category'];
    $image = $_POST['image'];
    $userId = getUserSessionId();

    // Insertion de l'article en BDD
    $postModel = new \App\Models\PostModel();
    $postId = $postModel->insertPost($title, $content, $categoryId, $image, $userId);

    // Message flash de confirmation
    addFlashMessage('Article ajouté.');

    // Redirection vers le dashboard
    header('Location: ' . buildUrl('/admin'));
    exit;
}

// Si le formualire n'a pas été soumis OU si il comporte des erreurs, on l'affiche

// On récupère la liste des catégories pour afficher le liste déroulante des catégories
$categoryModel = new \App\Models\CategoryModel();
$categories = $categoryModel->getAllCategories();

render('admin/add_post', [
    'categories' => $categories
]);