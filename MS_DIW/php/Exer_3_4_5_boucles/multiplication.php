<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

<?php 


// Ecrire un script qui affiche la table de multiplication pour les nombres de 1 à 9 dans un tableau HTML.

    echo $table = '<table border="1">';
    
    for ($i=1; $i <= 9; $i++) {

        echo  '<tr>';

        for ($ii=1; $ii <= 9 ; $ii++) {
           echo  '<td>'.$i*$ii.'</td>';
        }
       echo  '</tr>';
       
    }

    echo  '</table>';
    

?>



</body>
</html>
