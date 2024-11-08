<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>

<?php


// Un site partenaire met à votre disposition une liste des nouveaux utilisateurs inscrits.

// Cette liste est disponible à cette adresse https://ncode.amorce.org/customers.csv.

// Il s'agit d'un fichier CSV où chaque ligne représente un nouvel utilisateur. Les différents champs sont Surname, Firstname, Email, Phone, City, State, ils sont séparés par une virgule ,.

// Utilisez la fonction file() pour récupérer le contenu de ce fichier.

// Découpez chaque ligne en utilisant une des fonctions suivantes: explode() ou preg_split()

// Affichez le résultat dans un tableau HTML (avec Bootstrap si possible) en prenant bien soin de nommer les colonnes du tableau.

$fichier =  file("https://ncode.amorce.org/customers.csv");



echo '<table class="table">' . '<thead>
    <tr>
      <th scope="col">Prénom</th>
      <th scope="col">Nom</th>
      <th scope="col">Email</th>
      <th scope="col">Téléphone</th>
      <th scope="col">Ville</th>
      <th scope="col">Etat</th>
    </tr>
  </thead>
  <tbody>';


$ii = 0;
for ($i = 0; $i < count($fichier); $i++) {
    
    $personne = preg_split("/,/", $fichier[ $ii ]);

    echo '  <tr>
      <td>' . $personne[0] . '</td>
      <td>' . $personne[1] . '</td>
      <td>' . $personne[2] . '</td>
      <td>' . $personne[3] . '</td>
      <td>' . $personne[4] . '</td>
      <td>' . $personne[5] . '</td>
    </tr>';

    $ii++;
}

echo '</tbody></table>';

?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>

