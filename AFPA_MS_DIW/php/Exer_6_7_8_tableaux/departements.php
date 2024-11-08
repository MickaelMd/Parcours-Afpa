<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

<?php 

$departements = array(
    "Hauts-de-france" => array("Aisne", "Nord", "Oise", "Pas-de-Calais", "Somme"),
    "Bretagne" => array("Côtes d'Armor", "Finistère", "Ille-et-Vilaine", "Morbihan"),
    "Grand-Est" => array("Ardennes", "Aube", "Marne", "Haute-Marne", "Meurthe-et-Moselle", "Meuse", "Moselle", "Bas-Rhin", "Haut-Rhin", "Vosges"),
    "Normandie" => array("Calvados", "Eure", "Manche", "Orne", "Seine-Maritime")
);


// A partir du tableau ci-dessus:

// Affichez la liste des régions (par ordre alphabétique) suivie du nom des départements

// Affichez la liste des régions suivie du nombre de départements


ksort($departements);

foreach ($departements as $region => $departments) {
   
    echo "<strong>$region</strong> : " . implode(", ", $departments) . "<strong> - Nombre de département : " . count($departments) . " </strong> <br/>";

}

?>

</body>
</html>

