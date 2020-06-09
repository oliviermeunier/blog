<?php 

// Initialisation des variables que l'on souhaite transmettre au template
$email = null;
$error = null;

// Si le formulaire a été soumis
if (!empty($_POST)) {

    $email = $_POST['email'];
    $password = $_POST['password'];

    // On va chercher l'utilisateur dans la base de données à partir de l'email
    $userModel = new \App\Models\UserModel();
    $user = $userModel->getUserByEmail($email);

    if ($user) {

        // L'adresse email existe bien dans la BDD, il faut maintenant vérifier le mot de passe
        if (password_verify($password, $user['password'])) {

            // Enregistrement de l'utilisateur en session pour le connecter
            userSessionRegister($user['id'], $user['email'], $user['firstname'], $user['lastname']);

            header('Location: ' . buildUrl('/admin'));
            exit;
        }
        else {
            $error = 'Identifiants incorrects.';
        }
    }
    else {
        $error = 'Identifiants incorrects.';
    }
}

/**
 * Appel de la fonction render() pour faire le rendu du template HTML
 * On lui donne le nom du template et un tableau avec les données qu'on souhaite transmettre au template
 */
render('login', [
    'email' => $email,
    'error' => $error
]);