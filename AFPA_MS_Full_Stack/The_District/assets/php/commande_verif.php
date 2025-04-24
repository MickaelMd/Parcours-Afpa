<?php

$_SESSION['commande_list'] = array_filter($_SESSION['commande_list'], 'is_int');
$int = true;

foreach ($_SESSION['commande_list'] as $element) {
    if (!is_int($element)) {
        $int = false;
        break;
    }
}

if ($int == false) {
    echo '<h1 class="text-center text-danger mt-5"> Une erreur c\'est produite lors de votre commande. </br> Veuillez reessayer. </h1>';
    
    exit;
}

$commande_list = commande_list_plat($_SESSION['commande_list']);
$quantites = array_count_values($_SESSION['commande_list']);