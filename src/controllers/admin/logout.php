<?php 

// Déconnexion
logout();

// Ajout d'un message flash
addFlashMessage('Vous êtes déconnecté.');

// Redirection vers la page d'accueil 
header('Location: ' . buildUrl('/'));
exit;