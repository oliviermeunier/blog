<?php

// @TODO : Validation des données du formulaire

// Récupération des données du formulaire
$nickname = $_POST['nickname'];
$content = $_POST['content'];
$postId = $_POST['postid'];

// insérer le commentaire
$commentModel = new \App\Models\CommentModel();
$commentModel->insertComment($nickname, $content, $postId);

// Ajout d'un message flash
addFlashMessage('Commentaire ajouté.');

// Redirection vers la page Article
header('Location: ' . buildUrl('/post', ['postid' => $postId]));
exit;