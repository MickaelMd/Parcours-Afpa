<!-- --------------------------------------------------
--- Plus complet dans le dossier sql_php/login ---
-------------------------------------------------- -->


<?php
session_start();

if (!isset($_SESSION['auth']) || $_SESSION['auth'] !== 'ok') {
    header('Location: login_form.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <p>Vous êtes connecté.</p>
</body>
</html>
