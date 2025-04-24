<?php require_once __DIR__.'/assets/php/connect.php'; ?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/style.css">
    <title>Manipulation</title>
</head>

<body>

    <h4>Ajouter trois employés dans la base de données avec les données de votre choix.</h4>

    <p class="sql">INSERT INTO employe (nom, prenom, dateemb, nosup, titre, nodep, salaire, tauxcom)
        VALUES ("jean", "jean", "2024-10-17 00:00:00", 1, "président", 45, 100000, 100);</p>

    <p class="sql">INSERT INTO employe (nom, prenom, dateemb, nosup, titre, nodep, salaire, tauxcom) <br>
        VALUES <br>
        ("jean", "jean", "2024-10-17 00:00:00", 1, "président", 45, 100000, 100), <br>
        ("jeandeux", "jean", "2024-10-17 00:00:00", 2, "chef entrepot", 30, 90000, 50), <br>
        ("jeantrois", "jean", "2024-10-17 00:00:00", 3, "représentant", 10, 80000, 25); <br>
    </p>

    <form action="" method="post">
        <div class="row">
            <div class="mb-3">
                <label for="nom_insert" class="form-label">Nom</label>
                <input type="text" name="nom_insert">
            </div>
            <div class="mb-3">
                <label for="prenom_insert" class="form-label">Prénom</label>
                <input type="text" name="prenom_insert">
            </div>
            <div class="mb-3">
                <label for="dateemb_insert" class="form-label">Date d'embauche</label>
                <input type="text" name="dateemb_insert">
            </div>
            <div class="mb-3">
                <label for="nosup_insert" class="form-label">Numéro supérieur</label>
                <input type="text" name="nosup_insert">
            </div>
            <div class="mb-3">
                <label for="titre_insert" class="form-label">Titre</label>
                <input type="text" name="titre_insert">
            </div>
            <div class="mb-3">
                <label for="salaire_insert" class="form-label">Salaire</label>
                <input type="text" name="salaire_insert">
            </div>
            <div class="mb-3">
                <label for="nodep_insert" class="form-label">Numéro département</label>
                <input type="text" name="nodep_insert">
            </div>
            <div class="mb-3">
                <label for="tauxcom_insert" class="form-label">Taux de com</label>
                <input type="text" name="tauxcom_insert">
            </div>
            <div class="d-flex justify-content-center">
                <button type="submit" class="btn btn-primary w-50 mt-3" name="submit_insert">Submit</button>
            </div>
        </div>
    </form>
    <?php 


if (isset($_POST['submit_insert'])) {
   
    $sqlQuery = 'INSERT INTO employe (nom, prenom, dateemb, nosup, titre, nodep, salaire, tauxcom)
                 VALUES (:nom, :prenom, :dateemb, :nosup, :titre, :nodep, :salaire, :tauxcom);';
    $insert = $mysqlClient->prepare($sqlQuery);
    $insert->execute([
        'nom' => $_POST['nom_insert'],
        'prenom' => $_POST['prenom_insert'],
        'dateemb' => $_POST['dateemb_insert'],
        'nosup' => $_POST['nosup_insert'],
        'titre' => $_POST['titre_insert'],
        'nodep' => $_POST['nodep_insert'],
        'salaire' => $_POST['salaire_insert'],
        'tauxcom' => $_POST['tauxcom_insert']
    ]);
   
}
?>


    <hr>
    <h4>Ajouter un département</h4>
    <p class="sql"> INSERT INTO dept (nodept, nom, noregion) VALUES (51, "NewDept", 80); </p>

    <form action="" method="post">
        <div class="row">
            <div class="mb-3">
                <label for="nom_insert" class="form-label">Numéro département</label>
                <input type="number" name="nodept_insert">
            </div>
            <div class="mb-3">
                <label for="prenom_insert" class="form-label">Nom</label>
                <input type="text" name="nom_insert">
            </div>
            <div class="mb-3">
                <label for="dateemb_insert" class="form-label">Numéro de région</label>
                <input type="number" name="noregion_insert">
            </div>
            <div class="d-flex justify-content-center">
                <button type="submit" class="btn btn-primary w-50 mt-3" name="submit_insert_dept">Submit</button>
            </div>
        </div>
    </form>

    <?php 


if (isset($_POST['submit_insert_dept'])) {
   
    $sqlQuery = 'INSERT INTO dept (nodept, nom, noregion)
                 VALUES (:nodept, :nom, :noregion);';
    $insert = $mysqlClient->prepare($sqlQuery);
    $insert->execute([
        'nodept' => $_POST['nodept_insert'],
        'nom' => $_POST['nom_insert'],
        'noregion' => $_POST['noregion_insert']
    
    ]);
   
}
?>
    <hr>

    <h4>Augmenter de 10% le salaire de l'employe 17</h4>

    <p class="sql">UPDATE employe SET salaire = salaire * 1.1 WHERE noemp = 17;</p>

    <hr>
    <h4>Changer le nom du département 45 en 'Logistique'</h4>

    <p class="sql">UPDATE dept SET nom = "Logistique" WHERE nodept = 45;</p>

    <hr>
    <h4>Supprimer le dernier des employés que vous avez insérés précédemment.</h4>

    <p class="sql">DELETE from employe ORDER BY noemp DESC LIMIT 1;
    </p>

</body>

</html>