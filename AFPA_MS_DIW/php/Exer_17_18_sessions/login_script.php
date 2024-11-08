<!-- --------------------------------------------------
--- Plus complet dans le dossier sql_php/login ---
-------------------------------------------------- -->

<?php
session_start();

if (!isset($GLOBALS['users'])) {
    $GLOBALS['users'] = [];
}


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    $login = trim($_POST['login']);
    $password = trim($_POST['password']);

    
    if (empty($login) || empty($password)) {
        echo "Le champ login ou mot de passe est vide. <a href='login_form.php'>Réessayez</a>.";
        exit;
    }

    
    if (isset($GLOBALS['users'][$login])) {
        $user = $GLOBALS['users'][$login];
        if (password_verify($password, $user['password'])) {
            $_SESSION['auth'] = 'ok';
            $_SESSION['user_login'] = $login;
            header('Location: test.php');
            exit;
        }
    }

    
    session_destroy();
    echo "Identifiants incorrects. <a href='login_form.php'>Réessayez</a>.";
    exit;
} else {
    echo "Accès non autorisé.";
    exit;
}

