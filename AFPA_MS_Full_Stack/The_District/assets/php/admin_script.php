<?php 


// ------------------ Update status command --------------

if (isset($_POST['submit_update'])) {
    foreach ($commande as $commandes) {
        $id_commande = $commandes['com_id'];
        $archived = isset($_POST['delete_ids_'.$id_commande]) && $_POST['delete_ids_'.$id_commande] === '1' ? 0 : 1;
        $etat_commande = $_POST['etat'][$id_commande] ?? $commandes['com_etat'];

        admin_update_command($archived, $etat_commande, $id_commande);
    }

    echo "<meta http-equiv='refresh' content='0'>";
}

// ----------------- Update active / Delete Categorye ------------

if (isset($_POST['submit_update_categorie'])) {
    foreach ($categorie as $showcat) {
        $valueKey = 'valuecat_'.$showcat['cat_id'];
        $valueDeleteKey = 'valuecatDELETE_'.$showcat['cat_id'];

        $value = isset($_POST[$valueKey]) ? $_POST[$valueKey] : '0';
        $valueDelete = isset($_POST[$valueDeleteKey]) ? $_POST[$valueDeleteKey] : '0';

        $activeStatus = ($value === '1') ? 'Yes' : 'No';
        $superActiveStatus = ($valueDelete === '1') ? '0' : $showcat['cat_sa'];

        admin_update_categorie($activeStatus, $superActiveStatus, $showcat);
    }

    echo "<meta http-equiv='refresh' content='0'>";
}

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

// ----

if (isset($_POST['cat_select']) && filter_var($_POST['cat_select'], FILTER_VALIDATE_INT) !== false) {
   
    $select_id = $_POST['cat_select'];

  admin_active_plat_price($select_id);

  echo "<meta http-equiv='refresh' content='0'>";

}

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