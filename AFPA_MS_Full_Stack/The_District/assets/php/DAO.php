<?php 


// ------ index.php, categorie.php, plats.php, header.php <=

function index_categorie_list(int $limit)
{
    global $mysqlClient;
    $sqlQuery = "SELECT * FROM `categorie` WHERE active = 'Yes' ORDER BY libelle LIMIT $limit";
    $categorieStatement = $mysqlClient->prepare($sqlQuery);
    $categorieStatement->execute();
    $categorie = $categorieStatement->fetchAll();

    return $categorie;
}

// --

function plat_index_list_by_com(int $limit)
{
    global $mysqlClient;

    $sqlQueryy = "SELECT plat.*, COUNT(commande.id_plat) AS total_commandes
                FROM plat
                LEFT JOIN commande ON commande.id_plat = plat.id
                WHERE plat.active = 'Yes'
                GROUP BY plat.id
                ORDER BY total_commandes DESC
                LIMIT :limit
    ";

    $platStatement = $mysqlClient->prepare($sqlQueryy);
    $platStatement->bindValue(':limit', $limit, PDO::PARAM_INT);
    $platStatement->execute();
    $platindex = $platStatement->fetchAll();

    return $platindex;
}

// --

function plat_index_list(int $limit)
{
    global $mysqlClient;
    $sqlQueryy = "SELECT * FROM `plat` WHERE active = 'Yes' ORDER BY libelle LIMIT $limit";
    $platStatement = $mysqlClient->prepare($sqlQueryy);
    $platStatement->execute();
    $platindex = $platStatement->fetchAll();

    return $platindex;
}

// ------ foodlist.php <=

function foodlist(int $id)
{
    global $mysqlClient;
    $req = $mysqlClient->prepare('SELECT id, libelle, active FROM categorie WHERE id = :id');
    $req->execute([
        'id' => (int) $id,
    ]);
    $resultat = $req->fetch();

    return $resultat;
}

function foodlistpl(int $id)
{
    global $mysqlClient;
    $sqlQuery = "SELECT * FROM `plat` WHERE active = 'Yes' AND id_categorie = :id_categorie ORDER BY libelle";
    $platLStatement = $mysqlClient->prepare($sqlQuery);
    $platLStatement->execute([
        'id_categorie' => (int) $id,
    ]);

    return $platLStatement;
}

function btn_left(int $id)
{
    global $mysqlClient;
    $req = $mysqlClient->prepare('SELECT id, libelle FROM categorie WHERE id < :id AND active = "Yes" ORDER BY id DESC LIMIT 1');
    $req->execute(['id' =>$id]);

    return $req->fetch();
}

function btn_right(int $id)
{
    global $mysqlClient;
    $req = $mysqlClient->prepare('SELECT id, libelle FROM categorie WHERE id > :id AND active = "Yes" ORDER BY id ASC LIMIT 1');
    $req->execute(['id' => $id]);

    return $req->fetch();
}

// ------ platunique.php <=

function pl_unique_verif(int $id)
{
    global $mysqlClient;
    $req = $mysqlClient->prepare('SELECT id, libelle, active FROM plat WHERE id = :id');
    $req->execute(['id' => (int) $id]);

    $resultat = $req->fetch();

    return $resultat;
}

function pl_list(int $id)
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
    $sqlQuery = 'SELECT * , commande.id AS com_id, plat.libelle AS plat_libelle, commande.etat AS com_etat FROM `commande` JOIN plat ON commande.id_plat = plat.id WHERE commande.active > 0 ORDER BY commande.id';
    $commandeStatement = $mysqlClient->prepare($sqlQuery);
    $commandeStatement->execute();
    $commande = $commandeStatement->fetchAll(PDO::FETCH_ASSOC);
    
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
    $sqlQuery = 'SELECT 
            categorie.image AS cat_img, 
            categorie.active AS cat_active, 
            categorie.id AS cat_id, 
            categorie.libelle AS cat_libelle, 
            categorie.SuperActive AS cat_sa, 
            COUNT(DISTINCT plat.id) AS active_plat_count 
        FROM 
            `categorie` 
        LEFT JOIN 
            plat ON categorie.id = plat.id_categorie AND plat.active = "Yes" 
        WHERE 
            categorie.SuperActive > 0 
        GROUP BY 
            categorie.id 
        ORDER BY 
            categorie.libelle';
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
        'id' => $showcat['cat_id'],
    ]);
}

// - plats >

function admin_plat_l()
{
    global $mysqlClient;
    $sqlQuery = 'SELECT *, plat.image, categorie.libelle AS cat_lib, plat.libelle AS plat_libelle, plat.id AS plat_id, plat.active AS plat_active FROM `plat` JOIN categorie ON plat.id_categorie = categorie.id   ORDER BY plat.libelle';
    $platLStatement = $mysqlClient->prepare($sqlQuery);
    $platLStatement->execute();
    $platL = $platLStatement->fetchAll();

    return $platL;
    
}

function admin_plat_edit_add_select()
{
    global $mysqlClient;
    $sqlQuery = 'SELECT * FROM `plat` ORDER BY libelle';
    $platLStatement = $mysqlClient->prepare($sqlQuery);
    $platLStatement->execute();
    $platL = $platLStatement->fetchAll();

    return $platL;
    
}

function admin_list_categorie_select()
{
    global $mysqlClient;
    $sqlQuery = 'SELECT * FROM `categorie` WHERE SuperActive > 0 ORDER BY libelle';
    $categorieStatement = $mysqlClient->prepare($sqlQuery);
    $categorieStatement->execute();
    $categorie = $categorieStatement->fetchAll();

    return $categorie;
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

function admin_active_plat_price(int $id)
{
    global $mysqlClient;

    $updateQuery = 'UPDATE plat
                    JOIN categorie ON categorie.id = plat.id_categorie
                    SET plat.prix = ROUND(plat.prix * 1.10, 2)
                    WHERE categorie.id = :category_id
    ';
    $updateStatement = $mysqlClient->prepare($updateQuery);

    $updateStatement->execute([
        ':category_id' => $id,
    ]);
}


// ------ assets/php/insertcat.php <=

function insert_cat()
{
    global $mysqlClient;
    $sqlQuery = 'INSERT INTO categorie(libelle, image, active) VALUES (:libelle, :image, :active)';
    $insertRecipe = $mysqlClient->prepare($sqlQuery);

    return $insertRecipe;
}

// ------ profil.php <=

function delete_profil($id_profil){

    global $mysqlClient; 

    $sqlQuery = "DELETE FROM clients WHERE uuid = :uuid";
    $Statement = $mysqlClient->prepare($sqlQuery);
    $Statement->bindParam(':uuid', $id_profil, PDO::PARAM_STR);
    $Statement->execute();

}

// ------ commande.php <=

function commande_list_plat(array $where)
{
    global $mysqlClient;

    if (empty($where)) {
        return []; 
    }
    $placeholders = implode(',', array_fill(0, count($where), '?'));
    $sqlQueryy = "SELECT * FROM `plat` WHERE id IN ($placeholders) ORDER BY libelle";
    $platStatement = $mysqlClient->prepare($sqlQueryy);
    $platStatement->execute(array_map('intval', $where));
    return $platStatement->fetchAll(PDO::FETCH_ASSOC); 
}

function platExists($id) {
    global $mysqlClient; 
    $stmt = $mysqlClient->prepare("SELECT COUNT(*) FROM plat WHERE id = :id"); 
    $stmt->execute(['id' => $id]);
    return $stmt->fetchColumn() > 0; 
}