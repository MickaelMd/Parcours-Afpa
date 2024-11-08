<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

<?php


// Téléchargez ce fichier (https://ncode.amorce.org/ressources/Pool/NEW_MS_FULL_STACK/WEB_PHP/liens.txt), il contient une liste de sites indispensables à la compréhension du monde moderne.

// Écrire un programme qui lit ce fichier et qui construit une page web contenant une liste de liens hypertextes.

// Utilisez la fonction file() qui permet de lire directement un fichier et renvoie son contenu sous forme de tableau.


$lien = file("lien.txt");

 echo  '<table>';
 
$ii = 0;
for ($i = 0; $i < count($lien); $i++) {
    
    echo 
    
     " <tr><th> <a href=>$lien[$ii]</a>  </th></tr>" ;

    $ii ++;
};

echo " </table>";

?>


<style>

table{
  border-collapse:collapse;
  overflow-x: auto;

}

th{
  border: 1px solid black;
  padding: 10px;
}
</style>

</body>
</html>

