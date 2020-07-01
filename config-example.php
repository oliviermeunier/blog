<?php 

// Définition de constantes de configuration
define('BDD_HOST', '');
define('BDD_NAME', '');
define('BDD_USER', '');
define('BDD_PASSWORD', '');

// Configuration du serveur SMTP (envoi de mails)
define('SMTP_HOST', '');
define('SMTP_PORT', 2525);
define('SMTP_USERNAME', 'regeherhtrthj');
define('SMTP_PASSWORD', 'ykjyrukryjyuj');
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

switch ($_SERVER['HTTP_HOST']) {
    case 'localhost':
    case '127.0.0.1':
    case NGROK_URL:
        define('BASE_URL', '/path/to/your/blog/www');
        break;

    case 'domain.com':
    case 'www.domain.com':
        define('BASE_URL', '/path/to/your/online/blog/www');
        break;

    default:
        define('BASE_URL', '');
}