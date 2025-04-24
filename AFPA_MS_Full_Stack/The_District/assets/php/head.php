<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="shortcut icon" href="<?php echo $ip_link; ?>/assets/img/the_district_brand/favicon.png"
        type="image/x-icon" />
    <meta name="description" content="Site du restaurant The District" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <meta http-equiv="Content-Security-Policy" content="
    default-src 'self'; 
    script-src 'self' 'unsafe-inline' 'unsafe-eval' https://cdnjs.cloudflare.com https://maps.googleapis.com https://unpkg.com https://stackpath.bootstrapcdn.com https://cdn.jsdelivr.net;
    style-src 'self' 'unsafe-inline' https://cdnjs.cloudflare.com https://fonts.googleapis.com https://unpkg.com https://stackpath.bootstrapcdn.com https://cdn.jsdelivr.net;
    img-src 'self' data: https://maps.gstatic.com https://maps.googleapis.com https://unpkg.com https://*.tile.openstreetmap.org;
    font-src 'self' https://fonts.gstatic.com;
    connect-src 'self' https://maps.googleapis.com https://unpkg.com;
    child-src 'self' blob:;">

    <link
        href="https://fonts.googleapis.com/css2?family=Bree+Serif&family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap"
        rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous" />
    <?php
    if (basename($_SERVER['SCRIPT_NAME']) == 'index.php') {
        echo '<link rel="stylesheet" href="assets/css/style.css">

                <script src="assets/js/script.js" defer></script>
                <title>The District : Accueil</title>';
    } else {
        echo '<link rel="stylesheet" href="../assets/css/style.css" />'
            .
            '<script src="../assets/js/script.js" defer></script>';
    }

    if (basename($_SERVER['SCRIPT_NAME']) == 'categorie.php') {
        echo ' <title>The District : Catégories</title>';
    }
    if (basename($_SERVER['SCRIPT_NAME']) == 'admin.php') {
        echo '<link rel="stylesheet" href="../assets/css/admin.css">
            <script src="../assets/js/admin.js" defer></script>
         <title>The District : Administration</title>';
    }
    if (basename($_SERVER['SCRIPT_NAME']) == 'contact.php') {
        echo '<link rel="stylesheet" href="https://unpkg.com/leaflet@1.6.0/dist/leaflet.css" />
            <link rel="stylesheet" href="../assets/css/contact.css" />
            <script src="../assets/js/contact.js" defer  ></script>
            <script src="../assets/js/maps.js" defer></script>
            <title>The District : Contact</title>';
    }
    if (basename($_SERVER['SCRIPT_NAME']) == 'foodlist.php') {
        echo ' <link rel="stylesheet" href="../assets/css/cat_plat.css" />
                <title>The District : Catégorie '.$name.'</title>';
    }
    if (basename($_SERVER['SCRIPT_NAME']) == 'log_sign.php') {
        echo ' <link rel="stylesheet" href="../assets/css/login.css" />
            <script src="../assets/js/login.js" defer></script>
            <title>The District : Connexion / Inscription</title>';
    }
    if (basename($_SERVER['SCRIPT_NAME']) == 'plats.php') {
        echo ' <link rel="stylesheet" href="../assets/css/cat_plat.css" />
                <title>The District : Liste des plats</title>';
    }
    if (basename($_SERVER['SCRIPT_NAME']) == 'platunique.php') {
        echo ' <link rel="stylesheet" href="../assets/css/cat_plat.css" />

                <title>The District : '.$name.'</title>';
    }
    if (basename($_SERVER['SCRIPT_NAME']) == 'profil.php') {
        echo ' <link rel="stylesheet" href="../assets/css/profil.css">
                <script src="../assets/js/profil.js" defer></script>
                <title>The District : Profil</title> ';
    }
    if (basename($_SERVER['SCRIPT_NAME']) == 'pwdlost.php') {
        echo ' <script src="../assets/js/login.js" defer></script>
                <title>The District : Récupération de mot de passe</title>';
    }
    if (basename($_SERVER['SCRIPT_NAME']) == 'resetpass.php') {
        echo ' <script src="../assets/js/resetpass.js" defer></script>
        <link rel="stylesheet" href="../assets/css/login.css" />
        <title>The District : Récupération de mot de passe</title>';
    }
    if (basename($_SERVER['SCRIPT_NAME']) == 'rgpd.php') {
        echo '
        <title>The District : Politique de confidentialité</title>';
    }
    if (basename($_SERVER['SCRIPT_NAME']) == 'mentionslegales.php') {
        echo '
        <title>The District : Mentions légales</title>';
    }
    if (basename($_SERVER['SCRIPT_NAME']) == 'cgv.php') {
        echo '
        <title>The District : Conditions générales de vente</title>';
    }
    if (basename($_SERVER['SCRIPT_NAME']) == 'commande.php') {
        echo '
        <title>The District : Commande</title>';
    }
    if (basename($_SERVER['SCRIPT_NAME']) == 'commande_final.php') {
        echo '
        <script src="../assets/js/commande_final.js" defer></script>
        <title>The District : Commande Final</title>';
    }

    ?>

</head>

<?php 

function generateCsrfToken() {
    return bin2hex(random_bytes(32));
}

if (empty($_SESSION['csrf'])) {
    $_SESSION['csrf'] = generateCsrfToken();
} 

?>