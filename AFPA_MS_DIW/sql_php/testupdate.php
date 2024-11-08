<?php

try {
    $mysqlClient = new PDO(
        'mysql:host=127.0.0.1;dbname=The_District;charset=utf8',
        'root',
        'root'
        // [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION],
    );
} catch (Exception $e) {
    die('Erreur'. $e->getMessage());
}



$sqlQuery = "SELECT * FROM `categorie` ";
$categorieStatement = $mysqlClient->prepare($sqlQuery);
$categorieStatement->execute();
$categorie = $categorieStatement->fetchAll();



foreach ($categorie as $showcat) { 
   
    

    // $value = isset($_POST[$showcat['libelle']]) ? $_POST[$showcat['libelle']] : '';


$value = $_POST[$showcat['libelle']];

echo $value;
   
    if ($value == 'on') {
        $activeStatus = 'Yes';
        
    } 
    
    

    else {
        $activeStatus = 'No';
    };




    $updateQuery = "UPDATE `categorie` SET active = :active WHERE libelle = :libelle";
    $updateStatement = $mysqlClient->prepare($updateQuery);
    $updateStatement->execute([
        'active' => $activeStatus,
        'libelle' => $showcat['libelle']
    ]);
}

