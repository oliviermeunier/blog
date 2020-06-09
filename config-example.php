<?php 

// Définition de constantes de configuration
define('BDD_HOST', '');
define('BDD_NAME', '');
define('BDD_USER', '');
define('BDD_PASSWORD', '');

// Configuration du serveur SMTP (envoi de mails)
define('SMTP_HOST', '');
define('SMTP_PORT', 2525);
define('SMTP_USERNAME', '30bfd753cf4684');
define('SMTP_PASSWORD', '2b35e51f0dd89d');
define('EMAIL_CONTACT_FROM', 'no-reply@blog.loc');
define('EMAIL_CONTACT_TO', 'contact@blog.log');

define('ROOT_DIR', __DIR__);
define('PUBLIC_DIR', ROOT_DIR . '/www');
define('VIEWS_DIR', ROOT_DIR . '/views');
define('MODELS_DIR', ROOT_DIR . '/src/Models');
define('SERVICES_DIR', ROOT_DIR . '/src/services');
define('CONTROLLERS_DIR', ROOT_DIR . '/src/controllers');
define('CORE_DIR', ROOT_DIR . '/src/Core');

define('NGROK_URL', 'tyjtyjyktkyu.ngrok.io');

// Si on passe par le localhost, il faut ajouter tout le chemin dans les URLs
if ($_SERVER['HTTP_HOST'] === 'localhost' 
 || $_SERVER['HTTP_HOST'] === '127.0.0.1' 
 || $_SERVER['HTTP_HOST'] === NGROK_URL) 
{
    define('BASE_URL', '/path/to/your/blog/www');
}

// Si on est sur le virtual host on ne doit pas mettre le chemin
else {
    define('BASE_URL', '');
}