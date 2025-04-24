<?php
if (basename($_SERVER['SCRIPT_NAME']) == 'index.php') {
    $title_site = 'Velvet Records : Accueil'; 
    $active_link_index = 'active';
 } 
 if (basename($_SERVER['SCRIPT_NAME']) == 'details.php') {
    $title_site = 'Velvet Records : Details'; 
    $add_script = '<script src="assets/js/script_edit.js" defer></script>';
    $active_link_details = 'active';
 } 
 if (basename($_SERVER['SCRIPT_NAME']) == 'add_form.php') {
    $title_site = 'Velvet Records : Ajouter'; 
    $active_link_add = 'active';
    $add_script = '<script src="assets/js/script_add.js" defer></script>';

 } 
 ?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&family=Rubik:ital,wght@0,300..900;1,300..900&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
    <script src="assets/js/script.js" defer></script>
    <?php 
    if (isset($add_script)) {
        echo $add_script;
    }  ?>
    <title><?php echo $title_site ?></title>
</head>

<nav class="navbar navbar-expand-lg navbar-dark  fixed-top font_title" aria-label="Twelfth navbar example">
    <div class="container-fluid">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarsExample10"
            aria-controls="navbarsExample10" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse justify-content-md-center" id="navbarsExample10">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link <?php 
                    if (isset($active_link_index)) {
                        echo $active_link_index;
                    }  ?>
    " aria-current="page" href="index.php">Accueil</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php 
                    if (isset($active_link_details)) {
                        echo $active_link_details;
                    }  ?>" href="details.php?disc_id=1">Details</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link <?php 
                    if (isset($active_link_add)) {
                        echo $active_link_add;
                    }  ?>" href="add_form.php">Ajouter</a>
                </li>
            </ul>
        </div>
    </div>
</nav>


<body>