<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

<?php 

// Créer une fonction qui vérifie le niveau de complexité d'un mot de passe
// Elle doit prendra un paramètre de type chaîne de caractères. Elle retournera une valeur booléenne qui vaut true si le paramètre (le mot de passe) respecte les règles suivantes :

// Faire au moins 8 caractères de long
// Avoir au moins 1 chiffre
// Avoir au moins une majuscule et une minuscule
// $resultat = complex_password("TopSecret42");
// $resultat doit contenir true.

function verif($mdp) {

    $text_mdp = "</br> Le mot de passe doit";
    global $resultat;

    
    if (strlen($mdp) < 8) {
        echo "$text_mdp faire au moins 8 caractères de long";
       
    }

   
    if (!preg_match('/[0-9]/', $mdp)) {
        echo "$text_mdp avoir au moins 1 chiffre";
       
    }

    
    if (!preg_match('/[a-z]/', $mdp) || !preg_match('/[A-Z]/', $mdp)) {
        echo "$text_mdp avoir au moins une majuscule et une minuscule";
      
    }

    else {
        echo "Le mot de passe est bon !";
        $resultat = true;
        
    }
}


verif("TopSecret42");

if ($resultat === true) {

    echo "</br> Variable résultat : $resultat";
}

?>

</body>
</html>