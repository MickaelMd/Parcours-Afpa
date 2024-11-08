<?php

require_once __DIR__.'/../connect.php';

date_default_timezone_set('Europe/Paris');

$name = $_SESSION['nom'] ?? $_POST['nom'];
$prenom = $_SESSION['prenom'] ?? $_POST['prenom'];
$email = $_SESSION['email'] ?? $_POST['email'];
$telephone = $_SESSION['telephone'] ?? $_POST['telephone'];

if (!preg_match(pattern: "/^[a-zA-ZÀ-ÿ][a-zà-ÿ' -]*$/", subject: $_POST['nom'])) {
    echo 'Le nom est obligatoire et doit comporter uniquement des lettres.</br></br>';

    return;
}
if (!preg_match(pattern: "/^[a-zA-ZÀ-ÿ][a-zà-ÿ' -]*$/", subject: $_POST['prenom'])) {
    echo 'Le prénom est obligatoire et doit comporter uniquement des lettres. </br></br>';

    return;
}
if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
    echo 'Veuillez entrer un email valide. </br></br>';

    return;
}
if (!preg_match(pattern: "/^(\+?\d{1,3}\s?)?([1-9](\s?\d\s?){8}|\d{10,14})$/", subject: $_POST['telephone'])) {
    echo 'Le téléphone doit comporter uniquement des chiffres. (Le signe + est autorisé.)</br></br>';

    return;
}

$str = ' Nom : '.$name.'
 Prenom : '.$prenom.' 
 Email : '.$email.' 
 Telephone : '.$telephone.' 
 Demande : '.$_POST['demande'].PHP_EOL;
file_put_contents(date('Y-m-d-H-i-s').'.txt', $str, FILE_APPEND);

header('Location: '.$_SERVER['HTTP_REFERER']);
