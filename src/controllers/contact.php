<?php

// Si le formulaire est soumis
if (!empty($_POST)) {

    // Récupération des données du formulaire
    $name = $_POST['name'];
    $email = $_POST['email'];
    $message = $_POST['message'];

    // Create the Transport
    $transport = (new Swift_SmtpTransport(SMTP_HOST, SMTP_PORT))
    ->setUsername(SMTP_USERNAME)
    ->setPassword(SMTP_PASSWORD)
    ;

    // Create the Mailer using your created Transport
    $mailer = new Swift_Mailer($transport);

    // Create a message
    $message = (new Swift_Message('Nouveau message d\'un internaute'))
    ->setFrom([EMAIL_CONTACT_FROM])
    ->setTo([EMAIL_CONTACT_TO])
    ->setReplyTo([$email])
    ->setBody($message)
    ;

    // Send the message
    $result = $mailer->send($message);

    // Ajouter un message flash
    addFlashMessage('Votre message a bien été envoyé.');

    // @TODO : gérer les erreurs d'envoi 

    // Redirection vers la page d'accueil
    header('Location: ' . buildUrl('/'));
    exit;
}


render('contact');