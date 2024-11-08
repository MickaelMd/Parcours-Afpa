<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

<?php 

// Utilisez l'objet DateTime, sauf mention contraire.

// Trouvez le numéro de semaine de la date suivante : 14/07/2019.

// Combien reste-t-il de jours avant la fin de votre formation.

// Comment déterminer si une année est bissextile ?

// Montrez que la date du 32/17/2019 est erronée.

// Affichez l'heure courante sous cette forme : 11h25.

// Ajoutez 1 mois à la date courante.

// Que s'est-il passé le 1000200000

date_default_timezone_set("Europe/Paris");
$today_timestamp = time();
$today = date("d/m/Y");

// -----------

$semaine = "2019-07-14";
$format=strtotime ($semaine);
echo "<p>Numéro de semaine de la date suivante : 14/07/2019 :" . date(' W' , $format) . "</p>";

echo "<hr></br>";

// -----------

$fin_form = strtotime('2024-10-11');
$difference = $today_timestamp - $fin_form;
echo "Il reste " . floor($difference / 86400) . " Jour de formation.";

echo "</br></br><hr>";

// -----------


function est_bissextile($annee)
{
    if ( date("m-d", strtotime("$annee-02-29")) == "02-29")
    {
        echo "<p>$annee est bissextile.</p>";
    } 
    else {
        echo "<p>$annee est pas bissextile.</p>";
    };
}

est_bissextile(2024);
est_bissextile(2025);

echo "<hr>";

// -----------

echo "</br>";

$date_erronee = "32/17/2019";

if (checkdate(17, 32, 2019) === true) {
echo "La date $date_erronee est valide";
}
else {
    echo "La date $date_erronee est invalide";
};

echo "</br></br> <hr> </br>";

// -----------

$heure_actuelle = date("H \h\ i");

echo "Heure actuelle : $heure_actuelle";


echo "</br></br> <hr> </br>";

// -----------

$date = new DateTime();

$date->modify('+1 month');

echo "Dans un mois on sera le " . $date->format('d/m/Y');

echo "</br></br> <hr> </br>";

// -----------

$timestamp = 1000200000;


echo "Le " . date('d/m/Y', $timestamp) . " Correspond aux Attentats du 11 septembre 2001.";


?>

</body>
</html>

