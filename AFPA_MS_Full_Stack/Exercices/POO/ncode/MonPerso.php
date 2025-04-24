<?php

// --------------------------------------------------------

// Exercice 1 : création d'un personnage


// 1 - Dans un dossier nommé POO, créez un dossier classes/ dans lequel vous créez un fichier Personnage.class.php.

// 2 - Créez une classe Personnage qui comprend les attributs suivants:

// nom
// prenom
// age
// sexe
// Votre classe doit encpsuler les attributs à l'aide de propriétés privées et utiliser des accesseurs pour permettre l'accès aux attributs.

// 3 - Créez un deuxième fichier MonPerso.php permettant de vérifier le bon fonctionnement de votre classe, en vous inspirant du code ci-dessous :

//     $p = new Personnage();
//     $p->setNom("Lebowski");
//     $p->setPrenom("Jeff");

//     echo ($p);


// --------------------------------------------------------

require_once __DIR__.'/classes/personnage.class.php';

// $p = new Personnage();
// $p->setNom("Lebowski");
// $p->setPrenom("Jeff");
// $p->SetAge(100);
// $p->SetSexe("H");

$p = new Personnage();
$p->setPerso("Lebowski", "Jeff", 100, "H");

echo $p;