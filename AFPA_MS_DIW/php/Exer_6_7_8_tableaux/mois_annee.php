<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php

// 1. Mois de l'année non bissextile
// Créez un tableau associant à chaque mois de l’année le nombre de jours du mois.

// Utilisez le nom des mois comme clés de votre tableau associatif.

// Affichez votre tableau (dans un tableau HTML) pour faire apparaitre sur chaque ligne le nom du mois et le nombre de jours du mois.

// Triez ensuite votre tableau en utilisant comme critère le nombre de jours, puis affichez le résultat.

$tableau = array(
    "Janvier" => "31",
    "Février" => "28",
    "Mars" => "31",
    "Avril" => "30",
    "Mai" => "31",
    "Juin" => "30",
    "Juillet" => "31",
    "Aout" => "31",
    "Septembre" => "30",
    "Octobre" => "31",
    "Novembre" => "30",
    "Décembre" => "31"
);


echo "<table border='1'>";

foreach ($tableau as $mois => $jours) {
    echo "<tr><td>$mois</td><td>$jours</td></tr>";
}
echo "</table> </br>";


asort($tableau);

echo "<table border='1'>";


foreach ($tableau as $mois => $jours) {
    echo "<tr><td>$mois</td><td>$jours</td></tr>";
}
echo "</table>";
?>

</body>
</html>