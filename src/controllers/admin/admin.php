<?php

// Si l'utilisateur n'est pas connecté
if (!isAuthenticated()) {
    header('Location: ' . buildUrl('/admin/login'));
    exit;
}

render('admin/admin', [
    'posts' => (new \App\Models\PostModel())->getAllPosts(),
    'successMessages' => fetchFlashMessages()
]);