<?php

session_start();
date_default_timezone_set('Europe/Paris');

require_once __DIR__.'/../../vendor/autoload.php';

use Dotenv\Dotenv;

try {
    $dotenv = Dotenv::createImmutable(__DIR__.'/../../../../'); // Chemin vers le .env en dehors de du projet <---
    // $dotenv = Dotenv::createImmutable(__DIR__.'/../../'); // .env dans The_District <---
    $dotenv->load();

    $ip_link = $_ENV['URL_LINK_TD'];

    $dsn = 'mysql:host='.$_ENV['DB_HOST'].';dbname='.$_ENV['DB_NAME_TD'].';charset='.$_ENV['DB_CHARSET'];
    $username = $_ENV['DB_USER'];
    $password = $_ENV['DB_PASSWORD'];

    $mysqlClient = new PDO($dsn, $username, $password);
} catch (Exception $e) {
    echo '<h1>Erreur : Configurer le fichier connect.php dans /assets/php et le .env, et utilisez MariaDB.</h1>';
    exit('Erreur : '.$e->getMessage());
}

if (isset($_SESSION['email'])) {
    $req = $mysqlClient->prepare(query: 'SELECT id FROM clients WHERE email = :email');
    $req->execute(params: ['email' => $_SESSION['email']]);

    $userExists = $req->fetch();

    if (!$userExists) {
        unset($_SESSION['email']);
        unset($_SESSION['nom']);
        unset($_SESSION['prenom']);
        unset($_SESSION['telephone']);
        unset($_SESSION['adresse']);
        unset($_SESSION['admin']);
        unset($_SESSION['role']);
        unset($_SESSION['lostmail']);
        unset($_SESSION['nom_client']);
        unset($_SESSION['uuid']);
        unset($_SESSION['csrf']);
        // unset($_SESSION['shopping_list_count']);

        if (ini_get(option: 'session.use_cookies')) {
            setcookie(session_name(), '', time() - 42000);
        }

        session_destroy();
    }
}

// ------ index.php, categorie.php, plats.php, header.php <=

function index_categorie_list($limit)
{
    global $mysqlClient;
    $sqlQuery = "SELECT * FROM `categorie` WHERE active = 'Yes' ORDER BY libelle LIMIT $limit";
    $categorieStatement = $mysqlClient->prepare($sqlQuery);
    $categorieStatement->execute();
    $categorie = $categorieStatement->fetchAll();

    return $categorie;
}

function plat_index_list($limit)
{
    global $mysqlClient;
    $sqlQueryy = "SELECT * FROM `plat` WHERE active = 'Yes' ORDER BY libelle LIMIT $limit";
    $platStatement = $mysqlClient->prepare($sqlQueryy);
    $platStatement->execute();
    $platindex = $platStatement->fetchAll();

    return $platindex;
}

// ------ foodlist.php <=

function foodlist($id)
{
    global $mysqlClient;
    $req = $mysqlClient->prepare('SELECT id, libelle, active FROM categorie WHERE id = :id');
    $req->execute([
        'id' => (int) $id,
    ]);
    $resultat = $req->fetch();

    return $resultat;
}

function foodlistpl($id)
{
    global $mysqlClient;
    $sqlQuery = "SELECT * FROM `plat` WHERE active = 'Yes' AND id_categorie = :id_categorie ORDER BY libelle";
    $platLStatement = $mysqlClient->prepare($sqlQuery);
    $platLStatement->execute([
        'id_categorie' => (int) $id,
    ]);

    return $platLStatement;
}

function btn_left($id)
{
    global $mysqlClient;
    $req = $mysqlClient->prepare(query: 'SELECT id, libelle, active FROM categorie WHERE id = :id');
    $req->execute(params: [
        'id' => $id - 1]);

    $resultatL = $req->fetch();

    return $resultatL;
}

function btn_right($id)
{
    global $mysqlClient;
    $req = $mysqlClient->prepare(query: 'SELECT id, libelle, active FROM categorie WHERE id = :id');
    $req->execute(params: [
        'id' => $id + 1]);

    $resultatR = $req->fetch();

    return $resultatR;
}

// ------ platunique.php <=

function pl_unique_verif($id)
{
    global $mysqlClient;
    $req = $mysqlClient->prepare('SELECT id, libelle, active FROM plat WHERE id = :id');
    $req->execute(['id' => (int) $id]);

    $resultat = $req->fetch();

    return $resultat;
}

function pl_list($id)
{
    global $mysqlClient;
    $sqlQuery = 'SELECT * FROM plat WHERE id = :id ORDER BY libelle';
    $platLStatement = $mysqlClient->prepare($sqlQuery);
    $platLStatement->execute(['id' => (int) $id]);
    $platL = $platLStatement->fetchAll(PDO::FETCH_ASSOC);

    return $platL;
}

// ------ log_sign.php <=

// - > login

function connect_result($login_login)
{
    global $mysqlClient;
    $req = $mysqlClient->prepare(query: 'SELECT id, nom, prenom, email, telephone, adresse, pass, active, uuid, nom_client, admin FROM clients WHERE email = :email');
    $req->execute(params: [
        'email' => $login_login]);

    $resultat = $req->fetch();

    return $resultat;
}

function connect_resetcode($login_login)
{
    global $mysqlClient;

    $updateQuery = 'UPDATE clients SET resetcode = 0 WHERE email = :email';
    $updateStatement = $mysqlClient->prepare($updateQuery);
    $updateStatement->execute(['email' => $login_login]);
}

// - > sign

function sign_email($sign_email)
{
    global $mysqlClient;
    $stmt = $mysqlClient->prepare(query: 'SELECT * FROM clients WHERE email=?');
    $stmt->execute(params: [$sign_email]);
    $user = $stmt->fetch();

    return $user;
}

function sign_insert($nom_client, $sign_nom, $sign_prenom, $sign_email, $sign_telephone, $sign_adresse, $mdp_hash)
{
    global $mysqlClient;
    $sqlQuery = 'INSERT INTO clients(nom_client, nom, prenom, email, telephone, adresse, pass) 
                 VALUES (:nom_client, :nom, :prenom, :email, :telephone, :adresse, :pass)';
    $insertmdp = $mysqlClient->prepare($sqlQuery);
    $insertmdp->execute([
        'nom' => $sign_nom,
        'prenom' => $sign_prenom,
        'email' => $sign_email,
        'telephone' => $sign_telephone,
        'adresse' => $sign_adresse,
        'pass' => $mdp_hash,
        'nom_client' => $nom_client,
    ]);
    $req = $mysqlClient->prepare('SELECT id, nom, prenom, email, telephone, adresse, pass, active, uuid, admin 
                                  FROM clients 
                                  WHERE email = :email');

    $req->execute([
        'email' => $sign_email,
    ]);
    $resultat = $req->fetch();

    return $resultat;
}

// ------ pwdlost.php <=

function pwdlostfind($lostemail)
{
    global $mysqlClient;
    $req = $mysqlClient->prepare(query: 'SELECT id, nom, prenom, email, telephone, adresse, pass, active, admin FROM clients WHERE email = :email');
    $req->execute(params: [
        'email' => $lostemail]);

    $resultat = $req->fetch();

    return $resultat;
}

function setresetcode($resetcode, $lostemail)
{
    global $mysqlClient;

    $updateQuery = 'UPDATE `clients` SET resetcode = :resetcode WHERE email = :email';
    $updateStatement = $mysqlClient->prepare($updateQuery);
    $updateStatement->execute([
        'resetcode' => $resetcode,
        'email' => $lostemail,
    ]);
}

// ------ resetpass.php <=

function rp_find($lostemail)
{
    global $mysqlClient;
    $req = $mysqlClient->prepare('SELECT id, nom, prenom, email, telephone, adresse, pass, active, resetcode, admin FROM clients WHERE email = :email');
    $req->execute(['email' => $lostemail]);
    $resultat = $req->fetch();

    return $resultat;
}

function rp_check($lostmail)
{
    global $mysqlClient;
    $checkCodeQuery = 'SELECT resetcode FROM clients WHERE email = :email';
    $checkCodeStatement = $mysqlClient->prepare($checkCodeQuery);
    $checkCodeStatement->execute(['email' => $lostmail]);
    $codeResult = $checkCodeStatement->fetch();

    return $codeResult;
}

function rp_setnewpass($reset_pass, $mdp_hash, $lostmail, $reset_code)
{
    global $mysqlClient;
    $mdp_hash = password_hash($reset_pass, PASSWORD_DEFAULT);
    $updateQuery = 'UPDATE clients SET pass = :pass, resetcode = 0 WHERE email = :email AND resetcode = :resetcode';
    $updateStatement = $mysqlClient->prepare($updateQuery);
    $updateStatement->execute([
        'pass' => $mdp_hash,
        'email' => $lostmail,
        'resetcode' => $reset_code,
    ]);
}

// ------ admin.php <=

// - commande >

function admin_command()
{
    global $mysqlClient;
    $sqlQuery = 'SELECT * FROM `commande` WHERE active > 0 ORDER BY id';
    $commandeStatement = $mysqlClient->prepare($sqlQuery);
    $commandeStatement->execute();
    $commande = $commandeStatement->fetchAll();

    return $commande;
}
function admin_update_command($archived, $etat_commande, $id_commande)
{
    global $mysqlClient;
    $updateQuery = 'UPDATE commande SET active = :archived, etat = :etat WHERE id = :id';
    $updateStatement = $mysqlClient->prepare($updateQuery);
    $updateStatement->execute([
        'archived' => $archived,
        'etat' => $etat_commande,
        'id' => $id_commande,
    ]);
}

// - categorie >

function admin_list_categorie()
{
    global $mysqlClient;
    $sqlQuery = 'SELECT * FROM `categorie` WHERE SuperActive > 0 ORDER BY libelle';
    $categorieStatement = $mysqlClient->prepare($sqlQuery);
    $categorieStatement->execute();
    $categorie = $categorieStatement->fetchAll();

    return $categorie;
}

function admin_update_categorie($activeStatus, $superActiveStatus, $showcat)
{
    global $mysqlClient;
    $updateQuery = 'UPDATE `categorie` SET active = :active, SuperActive = :superactive WHERE id = :id';
    $updateStatement = $mysqlClient->prepare($updateQuery);
    $updateStatement->execute([
        'active' => $activeStatus,
        'superactive' => $superActiveStatus,
        'id' => $showcat['id'],
    ]);
}

// - plats >

function admin_plat_l()
{
    global $mysqlClient;
    $sqlQuery = 'SELECT * FROM `plat` ORDER BY libelle';
    $platLStatement = $mysqlClient->prepare($sqlQuery);
    $platLStatement->execute();
    $platL = $platLStatement->fetchAll();

    return $platL;
}

function admin_active_plat($activeStatus, $platId)
{
    global $mysqlClient;
    $updateQuery = 'UPDATE `plat` SET `active` = :active WHERE `id` = :id';
    $updateStatement = $mysqlClient->prepare($updateQuery);

    $updateStatement->execute([
        ':active' => $activeStatus,
        ':id' => $platId, ]);
}

// ------ assets/php/insertcat.php <=

function insert_cat()
{
    global $mysqlClient;
    $sqlQuery = 'INSERT INTO categorie(libelle, image, active) VALUES (:libelle, :image, :active)';
    $insertRecipe = $mysqlClient->prepare($sqlQuery);

    return $insertRecipe;
}