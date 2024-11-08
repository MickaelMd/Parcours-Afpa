<?php 

session_start(); 

if (isset($_SESSION["login"])) {
    // Connexion à la base de données
    try {
        $mysqlClient = new PDO(
            'mysql:host=127.0.0.1;dbname=The_District;charset=utf8',
            'root',
            'root'
        );
    } catch (Exception $e) {
        die('Erreur : ' . $e->getMessage());
    }

    // Vérifier si l'utilisateur existe encore dans la base de données
    $req = $mysqlClient->prepare('SELECT id FROM users WHERE login = :login');
    $req->execute(['login' => $_SESSION["login"]]);

    $userExists = $req->fetch();

    if (!$userExists) {
        // Si l'utilisateur n'existe plus, détruire la session
        unset($_SESSION["login"]);
        unset($_SESSION["admin"]);

        if (ini_get("session.use_cookies")) {
            setcookie(session_name(), '', time() - 42000);
        }

        session_destroy();
    }
}


echo "Session ID : " . session_id() . ' ';

if (isset($_SESSION["login"])) {
    echo 'Login : ' . $_SESSION["login"] . ' ';
}

if (isset($_SESSION["admin"])) {
    echo 'Admin : ' . $_SESSION["admin"];
}

?>