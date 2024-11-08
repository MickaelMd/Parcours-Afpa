<!-- --------------------------------------------------
--- Plus complet dans le dossier sql_php/login ---
-------------------------------------------------- -->

<?php

if (!isset($GLOBALS['users'])) {
    $GLOBALS['users'] = [];
}


$nom = trim($_POST['sign_nom']);
$prenom = trim($_POST['sign_prenom']);
$email = trim($_POST['sign_email']);
$login = trim($_POST['sign_login']);
$plain_password = trim($_POST['sign_password']);

if (empty($nom) || empty($prenom) || empty($email) || empty($login) || empty($plain_password)) {
    echo "Tous les champs doivent être remplis.";
    exit;
}


$hashed_password = password_hash($plain_password, PASSWORD_BCRYPT);


$GLOBALS['users'][$login] = [
    'nom' => $nom,
    'prenom' => $prenom,
    'email' => $email,
    'password' => $hashed_password
];

echo "Inscription réussie. <a href='login_form.php'>Connectez-vous ici</a>.";
?>
