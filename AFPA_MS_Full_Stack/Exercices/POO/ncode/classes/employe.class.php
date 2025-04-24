<?php 

// -------------------------------------------------

// Exercice 2 : gestion des employés


// La société Jarditou, d'envergure nationale, souhaite se doter d'un S.I.R.H. pour gérer ses employés dans les différents magasins à travers la France.

// 1 - Ecrire une classe Employe avec les informations (propriétés) suivantes :

// Nom
// Prénom
// Date d'embauche dans l'entreprise
// Fonction (Poste) dans l'entreprise
// Salaire en K euros brut annuel
// Service dans lequel se situe l'employé (Comptabilité, Commercial...)


// 2 - Dans la classe Employe, écrire une méthode permettant de savoir depuis combien d'années l'employé est dans l'entreprise.



// 3 - Chaque année, l'employé reçoit une prime calculée sur le salaire annuel (5% du brut) et sur l'ancienneté (2% du brut pour chaque année d'ancienneté). Cette prime est versée au 30/11 de chaque année. Dans la classe Employe, écrire le(s) méthode(s) permettant de déduire le montant de cette prime et de donner l'ordre de transfert à la banque le jour du versement.

// L'ordre de transfert à la banque sera juste un message écrit spécifiant que l'ordre de transfert a été envoyé à la banque avec mention du montant.

// Afin de tester les éléments ci-dessus, créer au minimum 5 objets Employe avec des informations sensiblement différentes. Ecrire dans le programme principal l'affichage du montant des primes de chaque employé.

// La date du versement de la prime doit également être vérifiée. Pour tester, fixer cette date à la date du jour, faire les conditions nécessaires dans le code et tester en changeant de date afin de voir si le message voulu s'affiche.


// 4 - L'entreprise est constituée de magasins implantés sur tout le territoire français.
// Un employé fait partie d'un (et un seul) magasin. Un magasin dispose d'un nom, d'une adresse, d'un code postal, d'une ville. Ecrire une nouvelle classe Magasins qui contient tous ces éléments et modifier la classe Employe afin que celui-ci soit rattaché à un magasin.


// 5 - En ce qui concerne les repas, les magasins ne disposent pas toutes d'un restaurant d'entreprise. Les employés se trouvant dans les magasins qui n'ont pas de restaurant d'entreprise bénéficient en contrepartie de tickets restaurants. Chaque magasin dispose donc de son propre mode de restauration.

// Modifier la classe Magasin pour gérer ce mode de restauration.

// Afficher chaque mode de restauration de chaque employé selon le magasin dans lequel il est affecté.


// 6 - L'entreprise souhaite intégrer dans ce système informatique les activités du comité d'entreprise. Des chèques-vacances sont distribués aux employés à condition que ceux-ci aient une ancienneté d'au moins un an.

// Modifier la classe Employe afin de savoir si celui-ci peut disposer de chèques-vacances ou non.



// 7 - Chaque année, des chèques Noël sont distribués aux enfants des employés. Le montant du chèque Noël dépend de l'âge des enfants :

// 20 € pour les enfants de 0 à 10 ans,
// 30 € pour les enfants de 11 à 15 ans,
// 50 € pour les enfants de 16 à 18 ans.
// Modifier le programme afin de gérer l'attribution des chèques Noël aux enfants des salariés.

// Afficher si l'employé a le droit d'avoir des chèques Noël (Oui/Non). Pour ce faire, établir les conditions nécessaires dans le programme.

// Si la réponse est Oui, afficher combien de chèques de chaque montant sera distribué à l'employé.

// Si aucun chèque n'est distribué pour une tranche d'âge, ne pas afficher.

// -------------------------------------------------

class Magasin {

    private $_nom;
    private $_adresse;
    private $_cpostal;
    private $_ville;
    private $_restaurant;


    public function __construct($nom, $adresse, $codepostal, $ville, $restaurant) {

        $this->_nom = $nom;
        $this->_adresse = $adresse;
        $this->_cpostal = $codepostal;
        $this->_ville = $ville;
        $this->_restaurant = $restaurant;

    }

    public function restaurant() {
        return $this->_restaurant;
    }
  
};

class Employe extends Magasin{

   private $_nom;
   private $_prenom;
   private $_dateEmb;
   private $_fonction;
   private $_salaire;
   private $_service;
   private $_enfant;
   private $_magasin;

   public function setMagasin(Magasin $magasin) {
    $this->_magasin = $magasin;
}

public function restaurant() {
    return $this->_magasin->restaurant() ? "Ticket restaurant : Oui" : "Ticket restaurant : Non";
}


   public function __construct($nom, $prenom, $dateEmb, $salaire, $fonction, $service, $enfant) {
    
    $this->_nom = $nom;
    $this->_prenom = $prenom;
    $this->_dateEmb = $dateEmb;
    $this->_salaire = $salaire;
    $this->_fonction = $fonction;
    $this->_service = $service;
    $this->_enfant = $enfant;

   }

   public function InfoEmploye() {
    $nom = $this->_nom;
    $prenom = $this->_prenom;
    $dateEmb = $this->_dateEmb;
    $salaire = $this->_salaire;
    $fonction = $this->_fonction;
    $service = $this->_service;


    return "Nom : " . $nom . "</br> Prénom : " . $prenom . "</br> Date d'embauche : " . $dateEmb .
    "</br> Salaire : " . $salaire . "k </br> Fonction : " . $fonction . "</br> Service : " . $service;
   }


   public function DateEmb() {
    
    $dateEmb = DateTime::createFromFormat('d-m-Y', $this->_dateEmb);
    $currentDate = new DateTime();
    $diff = $currentDate->diff($dateEmb); 
    
    return "Employé depuis : " . $diff->d . " jours " . $diff->m . " mois " . $diff->y . " années </br>";

   }

   public function calculerPrime() {
    $dateEmb = DateTime::createFromFormat('d-m-Y', $this->_dateEmb);
    $currentDate = new DateTime();

    $diff = $currentDate->diff($dateEmb); 
    $diffY = $diff->y;

    $prime = ($this->_salaire * 0.05) + (2 * $diffY);

    if (date("d-m") == "30-11") { 
        return 'Prime : ' . $prime . 'k' . " - Versement aujourd'hui ! " ;
    } 
    else {
        return 'Prime : ' . $prime . 'k' ;
    }

}

public function chequeVac() {
    $dateEmb = DateTime::createFromFormat('d-m-Y', $this->_dateEmb);
    $currentDate = new DateTime();

    $diff = $currentDate->diff($dateEmb); 
    $diffY = $diff->y;

    return ($diffY >= 1) ? "Chèques-vacances : autorisé" : "Chèques-vacances : refusé";

}

public function chequeNoel() {

    $montant = 0;

$enfant = $this->_enfant;

if (count(array_filter($enfant, 'is_int')) !== count($enfant)) {
    return 'Le tableau des enfants doit contenir uniquement des entiers';
} 

if (count($enfant) == 0) {
    return 'Pas de chéque noel';
} else {
    foreach ($enfant as $a) {
        if ($a >= 0 && $a <= 10) {
            $montant = $montant + 20;
            $enf10 = isset($enf10) + 1;
        }
        if ($a >= 11 && $a <= 15) {
            $montant = $montant + 30;
            $enf15 = isset($enf15) + 1;
        }
        if ($a >= 16 && $a <= 18) {
            $montant = $montant + 50;
            $enf16 = isset($enf16) + 1;
        }
}
 }
 
 if ($montant <= 0) {
return 'Pas d\'enfant en age d\'avoir un chéque noel !';
 }

$phrase = "";
 if (isset($enf10) >= 1) {
    $e10 = $enf10 * 20;
    $phrase = $phrase . "Pour vos " . $enf10 . " enfants de 0 à 10 ans : " . $e10 .  "€" . "</br>";
 }
 if (isset($enf15) >= 1) {
    $e15 = $enf15 * 30;
    $phrase = $phrase . "Pour vos " . $enf15 . " enfants de 11 à 15 ans : " . $e15 .  "€" . "</br>";
}
if (isset($enf16) >=1) {
    $e16 = $enf16 * 50;
    $phrase = $phrase . "Pour vos ". $enf16 ." enfants de 16 à 18 ans : " . $e16 .  "€" . "</br>";
}

return 'Le montant total des chéques noel est de ' . $montant . '€ </br>' . $phrase ;
    
}
const test = 1;
};

// ------------------------------------------

$employe = new Employe("Smith", "Jhon", "10-12-2021", 32, "Fonction", "Service", [11,15,10,16,14,0]);
$magasin = new Magasin("Nom", "Adresse", "Codepostal", "Ville", true);

$employe->setMagasin($magasin);

echo $employe->InfoEmploye() . "<hr>";
echo $employe->DateEmb();
echo $employe->calculerPrime() . '</br>';
echo $employe->restaurant() . "</br>"; 
echo $employe->chequeVac() . "<hr>";
echo $employe->chequeNoel();