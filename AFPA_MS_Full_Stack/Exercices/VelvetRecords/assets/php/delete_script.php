<?php require_once __DIR__.'/connect.php'; 

$ids = $_GET['id'];

if (!is_numeric($ids) || (int) $ids <= 0) {
    echo '<h1>Erreur : ID invalide.</h1>';
    exit;
}

$prt = details_disc($ids);

if (!$prt) {
    echo "Le disc n'existe pas.";
    exit;
} 
try {
    delete_disc($ids);
} catch (Exception $e) {
    echo 'Une erreur s\'est produite';
}


header("Location: /Exercices/VelvetRecords/");