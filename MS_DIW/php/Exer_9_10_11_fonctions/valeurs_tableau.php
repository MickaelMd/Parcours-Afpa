<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

<?php 

// Ecrivez une fonction qui calcul la somme des valeurs d'un tableau
// La fonction doit prendre un paramètre de type tableau

//  $tab = array(4, 3, 8, 2);
//  $resultat = somme($tab);
// $resultat doit contenir 17


function calcul ($tab) {

    
    global $resultat;
    $resultat = array_sum($tab);
    
};

calcul($tab =  array(4, 3, 8, 2));

echo $resultat;
?>

</body>
</html>

