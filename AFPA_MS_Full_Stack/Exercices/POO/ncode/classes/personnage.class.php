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

class Personnage {
    private $_nom;
    private $_prenom;
    private $_age;
    private $_sexe;

    public function setPerso($nom, $prenom, $age, $sexe) {
        $this->_nom = $nom;
        $this->_prenom = $prenom;
        $this->_age = (int)$age;
        $this->_sexe = $sexe;
    }

    // public function setNom($nom) {
    //     $this->_nom = $nom;
    // }

    // public function setPrenom($prenom) {
    //     $this->_prenom = $prenom;
    // }

    // public function SetAge($age) {
    //     $this->_age = (int)$age;
    // }

    // public function SetSexe($sexe) {
    //     $this->_sexe = $sexe;
        
    // }

    public function __toString() {
        return $this->_nom . " " . $this->_prenom . " " . $this->_age . "  " . $this->_sexe;
    }
}