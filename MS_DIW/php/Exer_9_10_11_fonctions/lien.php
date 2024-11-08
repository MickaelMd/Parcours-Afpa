<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

<?php 

// Ecrivez une fonction qui permette de générer un lien.
// La fonction doit prendre deux paramètres, le lien et le titre

//  lien("https://www.reddit.com/", "Reddit Hug");
// Appelée de cette façon, la fonction doit générer

// <a href="https://www.reddit.com/">Reddit Hug</a>

function lien ($lien, $titre) {

    echo "<a href=$lien > $titre </a>" ;

};


lien("https://www.reddit.com/", "Reddit Hug");



?>

</body>
</html>

