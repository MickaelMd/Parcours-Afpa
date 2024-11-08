<?php require_once __DIR__.'/../assets/php/connect.php';
if (!isset($_SESSION['email']) || $_SESSION['admin'] < 1) {
    echo '<br>Page refusée !';
    header('Location: ../index.php');
    exit;
}
require_once __DIR__.'/../assets/php/head.php'; ?>

<body>
    <div class="container">
        <?php require_once __DIR__.'/../assets/php/header.php'; ?>

        <section id="section_commande_list" class="mt-5">
            <h2 class="text-center">Liste des commandes</h2>
            <div class="container mt-5">


                <form class="mt-3" method="POST" id="commande_list">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="">id</th>
                                <th scope="">id plat</th>
                                <th scope="">Quantité</th>
                                <th scope="">Total</th>
                                <th scope="">Date de commande</th>
                                <th scope="">Etat</th>
                                <th scope="">Nom du client</th>
                                <th scope="">Téléphone</th>
                                <th scope="">Email</th>
                                <th scope="">Adresse</th>
                                <th scope="">Archiver</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php

            $commande = admin_command();
foreach ($commande as $commandes) {
    $id_commande = htmlspecialchars($commandes['id']);
    $etat_commande = htmlspecialchars($commandes['etat']);

    echo '<input type="hidden" name="delete_ids_'.$id_commande.'" value="0">';
    echo '<tr> 
                                        <td>'.$id_commande.'</td>
                                        <td>'.htmlspecialchars($commandes['id_plat']).'</td>
                                        <td>'.htmlspecialchars($commandes['quantite']).'</td>
                                        <td>'.htmlspecialchars($commandes['total']).'</td>
                                        <td>'.htmlspecialchars($commandes['date_commande']).'</td>
                                        <td>
                                        <select name="etat['.$id_commande.']" class="form-select">
                                            <option value="Livrée"'.($etat_commande === 'Livrée' ? ' selected' : '').'>Livrée</option>
                                            <option value="En cours de livraison"'.($etat_commande === 'En cours de livraison' ? ' selected' : '').'>En cours de livraison</option>
                                            <option value="En préparation"'.($etat_commande === 'En préparation' ? ' selected' : '').'>En préparation</option>
                                            <option value="Annulée"'.($etat_commande === 'Annulée' ? ' selected' : '').'>Annulée</option>
                                        </select>
                                        </td>
                                        <td>'.htmlspecialchars($commandes['nom_client']).'</td>
                                        <td>'.htmlspecialchars($commandes['telephone_client']).'</td>
                                        <td>'.htmlspecialchars($commandes['email_client']).'</td>
                                        <td>'.htmlspecialchars($commandes['adresse_client']).'</td>'.
            '<td><input type="checkbox" class="form-check-input" name="delete_ids_'.$id_commande.'" value="1"'.($commandes['active'] === 0 ? ' checked' : '').'></td>
                                    </tr>';
}
?>
                        </tbody>
                    </table>
                    <div class="d-grid gap-2">
                        <button class="btn btn-primary" type="submit" name="submit_update">Valider les
                            changements</button>
                    </div>
                </form>

                <?php

// ------------------ Update status command --------------

                if (isset($_POST['submit_update'])) {
                    foreach ($commande as $commandes) {
                        $id_commande = $commandes['id'];
                        $archived = isset($_POST['delete_ids_'.$id_commande]) && $_POST['delete_ids_'.$id_commande] === '1' ? 0 : 1;
                        $etat_commande = $_POST['etat'][$id_commande] ?? $commandes['etat'];

                        admin_update_command($archived, $etat_commande, $id_commande);
                    }

                    echo "<meta http-equiv='refresh' content='0'>";
                }
?>
        </section>

        <section id="section_cat_list" class="mt-5">
            <h2 class="text-center mt-5">Liste des catégories</h2>
            <form class="mt-5" method="POST" id="cat_list">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="">Image</th>
                            <th scope="">ID</th>
                            <th scope="">Libelle</th>
                            <th scope="">Nombre de plat</th>
                            <th scope="">Active</th>
                            <th scope="" class="text-danger">Supprimer</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php

$categorie = admin_list_categorie();

foreach ($categorie as $categories) {
    $checkcat = ($categories['active'] === 'Yes') ? 'checked="checked"' : '';
    $checkSuperActive = ($categories['SuperActive'] === '1') ? 'checked="checked"' : '';
    $id_categories = htmlspecialchars($categories['id']);

    echo '<input type="hidden" name="valuecat_'.$id_categories.'" value="0">';
    echo '<input type="hidden" name="valuecatDELETE_'.$id_categories.'" value="0">';
    echo '<tr> 
                                <td><img src="'.htmlspecialchars($ip_link.'/assets/img/category/'.$categories['image']).'" class="img_cat_list"></td>
                                <td>'.htmlspecialchars($categories['id']).'</td>
                                <td>'.htmlspecialchars($categories['libelle']).'</td>
                                <td>11 (test)</td>
                                <td><input type="checkbox" class="form-check-input" name="valuecat_'.$id_categories.'" value="1" '.$checkcat.'></td>
                                <td><input type="checkbox" class="form-check-input" name="valuecatDELETE_'.$id_categories.'" value="1" '.$checkSuperActive.'></td>'.
        '</tr>';
}
?>
                    </tbody>
                </table>
                <div class="d-grid gap-2">
                    <button class="btn btn-primary" type="submit" name="submit_update_categorie">Valider les
                        changements</button>
                </div>
            </form>
        </section>

        <?php

// ----------------- Update active / Delete Categorye ------------

    if (isset($_POST['submit_update_categorie'])) {
        foreach ($categorie as $showcat) {
            $valueKey = 'valuecat_'.$showcat['id'];
            $valueDeleteKey = 'valuecatDELETE_'.$showcat['id'];

            $value = isset($_POST[$valueKey]) ? $_POST[$valueKey] : '0';
            $valueDelete = isset($_POST[$valueDeleteKey]) ? $_POST[$valueDeleteKey] : '0';

            $activeStatus = ($value === '1') ? 'Yes' : 'No';
            $superActiveStatus = ($valueDelete === '1') ? '0' : $showcat['SuperActive'];

            admin_update_categorie($activeStatus, $superActiveStatus, $showcat);
        }

        echo "<meta http-equiv='refresh' content='0'>";
    }
?>

        <section id="add_cat" class="mt-5">

            <h2 class="text-center">Ajouter une categorie</h2>

            <form action="../assets/php/insertcat.php" method="POST" id="add_cat_form" enctype="multipart/form-data">

                <div class="form-floating mb-3 mt-5">
                    <input type="text" class="form-control" id="cat_add_name" name="cat_add_name"
                        placeholder="Nom de la catégorie">
                    <label for="cat_add_name">Nom de la catégorie (Libelle)</label>
                    <span id="error-cat_add_name" class="text-danger"></span>
                </div>
                <div class="mb-3">
                    <label for="formFile" class="form-label">Choisir une image</label>
                    <input class="form-control" type="file" id="cat_add_img" name="cat_add_img" required>
                </div>
                <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" role="switch" id="cat_add_active"
                        name="cat_add_active" checked>
                    <label class="form-check-label" for="cat_add_active">Activé la catégorie</label>
                </div>
                <div class="d-grid gap-2">
                    <button class="btn btn-primary mt-3" type="submit" name="submit_add_categorie">Ajouter la
                        nouvelle catégorie</button>
                </div>
            </form>

        </section>

        <section id="plat_by_cat" class="mt-5">

            <h2 class="mt-3 text-center">Plats par catégorie</h2>

            <select id="categorySelect" class="form-select mt-5" aria-label="Default select example">
                <?php
    foreach ($categorie as $categories) {
        echo '<option class="text-center" value="'.$categories['id'].'">'.$categories['libelle'].'</option>';
    }
?>
            </select>
            <form action="" name="form_enable_plat" method="POST">
                <table class="table mt-3" id="platsTable">
                    <thead>
                        <tr>
                            <th scope="">Image</th>
                            <th scope="">ID</th>
                            <th scope="">Libelle</th>
                            <th scope="">Déscription</th>
                            <th scope="">Prix</th>
                            <th scope="">ID catégorie</th>
                            <th scope="">Active</th>
                        </tr>
                    </thead>
                    <tbody id="platsBody">

                        <?php
// --------------------- Add Categorye -------------------

$platL = admin_plat_l();

foreach ($platL as $platLs) {
    echo '<tr data-category="'.htmlspecialchars($platLs['id_categorie']).'">  
                <td><img src="'.htmlspecialchars($ip_link.'/assets/img/food/'.$platLs['image']).'" class="img_cat_list"></td>'.
        '<td>'.htmlspecialchars($platLs['id']).'</td>'.
        '<td>'.htmlspecialchars($platLs['libelle']).'</td>'.

        '<td>'.htmlspecialchars($platLs['description']).'</td>'.
        '<td>'.htmlspecialchars($platLs['prix']).'€</td>'.
        '<td>'.htmlspecialchars($platLs['id_categorie']).'</td>'.
        // '<td>' . htmlspecialchars($platLs['active']) . '</td>' .
           '<td><input type="checkbox" class="form-check-input" name="disable_'.$platLs['id'].'" value="1"'.($platLs['active'] === 'Yes' ? ' checked' : '').'></td>'.
    '</tr>';
}
?>
                    </tbody>
                </table>
                <button class="btn btn-primary mt-3 w-100" type="submit" name="submit_update_plat">Valider
                    leschangements</button>
            </form>
        </section>

        <?php

// --------------- Update active plat --------------

if (isset($_POST['submit_update_plat'])) {
    foreach ($platL as $platLs) {
        $platId = $platLs['id'];

        if (isset($_POST['disable_'.$platId])) {
            $activeStatus = 'Yes';
        } else {
            $activeStatus = 'No';
        }

        admin_active_plat($activeStatus, $platId);
    }
    echo "<meta http-equiv='refresh' content='0'>";
}
?>
        <section id="update_plat_section">
            <h2 class="mt-5 text-center">Modifier / Ajouter un plat</h2>

            <form action="" method="POST" enctype="multipart/form-data">
                <select id="platSelect" class="form-select mt-5" name="update_plat_select">
                    <option class="text-center" value="add">Ajouter un plat</option>
                    <?php
    foreach ($platL as $platLs) {
        echo '<option class="text-center" value="'.htmlspecialchars($platLs['id']).'">'.htmlspecialchars($platLs['libelle']).'</option>';
    }
?>
                </select>

                <div class="form-floating mb-3 mt-3">
                    <input type="text" class="form-control" id="update_plat_libelle" name="update_plat_libelle"
                        placeholder="Nouveau libelle">
                    <label for="update_plat_libelle">Libellé</label>
                    <span id="error-update_plat_libelle" class="text-danger"></span>
                </div>

                <div class="form-floating mb-3">
                    <textarea class="form-control" placeholder="Description" name="update_plat_desc"
                        id="update_plat_desc" style="height: 100px"></textarea>
                    <label for="update_plat_desc">Description</label>
                    <span id="error-update_plat_desc" class="text-danger"></span>
                </div>

                <div class="mb-3">
                    <label for="update_plat_img" class="form-label">Choisir une image</label>
                    <input class="form-control" type="file" id="update_plat_img" name="update_plat_img">
                </div>

                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="update_plat_prix" name="update_plat_prix"
                        placeholder="Prix">
                    <label for="update_plat_prix">Prix (sans € et avec un point pour les centimes, ex: 8.50)</label>
                    <span id="error-update_plat_prix" class="text-danger"></span>
                </div>

                <select id="categorySelect" class="form-select mt-0" name="update_plat_cat">
                    <option class="text-center" value="" selected>Choisir la catégorie</option>
                    <?php
foreach ($categorie as $categories) {
    echo '<option class="text-center" value="'.htmlspecialchars($categories['id']).'">'.htmlspecialchars($categories['libelle']).'</option>';
}
?>
                </select>

                <div class="d-grid gap-2">
                    <button class="btn btn-primary mt-3" type="submit" name="submit_add_categorie">
                        <?php echo isset($_POST['update_plat_select']) && $_POST['update_plat_select'] == 'add' ? 'Modifier / Ajouter le plat' : 'Ajouter / Modifier le plat'; ?>
                    </button>
                </div>
            </form>

            <?php

// ------------------- Update / add Food --------------

    if (isset($_POST['submit_add_categorie'])) {
        $up_id_plat = $_POST['update_plat_select'];
        $up_id_categorie = $_POST['update_plat_cat'];

        if ($up_id_plat === 'add') {
            $insertQuery = 'INSERT INTO `plat` (libelle, description, prix, id_categorie, image) VALUES (:libelle, :description, :prix, :id_categorie, :image)';
            $params = [];

            $params['libelle'] = $_POST['update_plat_libelle'];
            $params['description'] = $_POST['update_plat_desc'];
            $params['prix'] = $_POST['update_plat_prix'];
            $params['id_categorie'] = $up_id_categorie;

            if (isset($_FILES['update_plat_img']) && $_FILES['update_plat_img']['error'] === 0) {
                $fileInfo = pathinfo($_FILES['update_plat_img']['name']);
                $extension = strtolower($fileInfo['extension']);
                $allowedExtensions = ['jpg', 'jpeg', 'gif', 'png'];

                if (in_array($extension, $allowedExtensions)) {
                    $path = __DIR__.'/../assets/img/food/';
                    if (!is_dir($path)) {
                        mkdir($path, 0777, true);
                    }

                    $image_name = time().rand().'.'.$extension;
                    move_uploaded_file($_FILES['update_plat_img']['tmp_name'], $path.$image_name);

                    $params['image'] = $image_name;
                }
            }

            $insertStatement = $mysqlClient->prepare($insertQuery);
            $insertStatement->execute($params);

            echo "<meta http-equiv='refresh' content='0'>";
        } else {
            $updateQuery = 'UPDATE `plat` SET ';
            $params = [];

            if (!empty($_POST['update_plat_libelle'])) {
                $updateQuery .= 'libelle = :libelle, ';
                $params['libelle'] = $_POST['update_plat_libelle'];
            }

            if (!empty($_POST['update_plat_desc'])) {
                $updateQuery .= 'description = :description, ';
                $params['description'] = $_POST['update_plat_desc'];
            }

            if (!empty($_POST['update_plat_prix'])) {
                $updateQuery .= 'prix = :prix, ';
                $params['prix'] = $_POST['update_plat_prix'];
            }

            if (!empty($up_id_categorie)) {
                $updateQuery .= 'id_categorie = :id_categorie, ';
                $params['id_categorie'] = $up_id_categorie;
            }

            if (isset($_FILES['update_plat_img']) && $_FILES['update_plat_img']['error'] === 0) {
                $fileInfo = pathinfo($_FILES['update_plat_img']['name']);
                $extension = strtolower($fileInfo['extension']);
                $allowedExtensions = ['jpg', 'jpeg', 'gif', 'png'];

                if (in_array($extension, $allowedExtensions)) {
                    $path = __DIR__.'/../assets/img/food/';
                    if (!is_dir($path)) {
                        mkdir($path, 0777, true);
                    }

                    $image_name = time().rand().'.'.$extension;
                    move_uploaded_file($_FILES['update_plat_img']['tmp_name'], $path.$image_name);

                    $updateQuery .= 'image = :image, ';
                    $params['image'] = $image_name;
                }
            }

            $updateQuery = rtrim($updateQuery, ', ').' WHERE id = :id';
            $params['id'] = $up_id_plat;

            $updateStatement = $mysqlClient->prepare($updateQuery);
            $updateStatement->execute($params);

            echo "<meta http-equiv='refresh' content='0'>";
        }
    }
?>
        </section>

    </div>
    <?php require_once __DIR__.'/../assets/php/footer.php'; ?>

</body>

</html>