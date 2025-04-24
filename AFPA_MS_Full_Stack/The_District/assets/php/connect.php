<?php
// session_set_cookie_params([
//     'lifetime' => 0, 
//     'path' => '/',
//     'domain' => $_SERVER['HTTP_HOST'], 
//     'secure' => true, 
//     'httponly' => true,
//     'samesite' => 'Strict' 
// ]);
session_start();
date_default_timezone_set('Europe/Paris');

require_once __DIR__.'/../../vendor/autoload.php';

use Dotenv\Dotenv;

try {
    $dotenv = Dotenv::createImmutable(__DIR__.'/../../../../'); // Chemin vers le .env en dehors de du projet <---
     // $dotenv = Dotenv::createImmutable(__DIR__.'/../../../../'); // .env dans le main projet <---
    $dotenv->load();

    $ip_link = $_ENV['URL_LINK_TD'];

    $dsn = 'mysql:host='.$_ENV['DB_HOST'].';dbname='.$_ENV['DB_NAME_TD'].';charset='.$_ENV['DB_CHARSET'];
    $username = $_ENV['DB_USER'];
    $password = $_ENV['DB_PASSWORD'];

    $mysqlClient = new PDO($dsn, $username, $password);
} catch (Exception $e) {
    echo '<h1>Erreur : Configurer le fichier connect.php dans /assets/php et le .env, et utilisez MariaDB.</h1>';
    exit('Erreur : '.$e->getMessage());
}

if (isset($_SESSION['email'])) {
    $req = $mysqlClient->prepare(query: 'SELECT id FROM clients WHERE email = :email');
    $req->execute(params: ['email' => $_SESSION['email']]);

    $userExists = $req->fetch();

    if (!$userExists) {
        unset($_SESSION['email']);
        unset($_SESSION['nom']);
        unset($_SESSION['prenom']);
        unset($_SESSION['telephone']);
        unset($_SESSION['adresse']);
        unset($_SESSION['admin']);
        unset($_SESSION['role']);
        unset($_SESSION['lostmail']);
        unset($_SESSION['nom_client']);
        unset($_SESSION['uuid']);
        unset($_SESSION['csrf']);
        unset($_SESSION['commande_list']);

        if (ini_get(option: 'session.use_cookies')) {
            setcookie(session_name(), '', time() - 42000);
        }

        session_destroy();
    }
}

require_once __DIR__.'/DAO.php';


header("Content-Security-Policy: frame-ancestors 'none';");
// $nonce = base64_encode(random_bytes(16));
// header("Content-Security-Policy: default-src 'self'; script-src 'self' 'nonce-$nonce';");


if (!isset($_SESSION['commande_list'])) { 

    $_SESSION['commande_list'] = [];

}

require_once __DIR__.'/commande_verif.php'; 