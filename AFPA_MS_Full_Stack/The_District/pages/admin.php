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
                                <th scope="">Plat</th>
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
    $id_commande = htmlspecialchars($commandes['com_id']);
    $etat_commande = htmlspecialchars($commandes['com_etat']);

    echo '<input type="hidden" name="delete_ids_'.$id_commande.'" value="0">';
    echo '<tr> 
                                        <td>'.$id_commande.'</td>
                                        <td>'.htmlspecialchars($commandes['plat_libelle']).'</td>
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
                    $checkcat = ($categories['cat_active'] === 'Yes') ? 'checked="checked"' : '';
                    $checkSuperActive = ($categories['cat_sa'] === '1') ? 'checked="checked"' : '';
                    $id_categories = htmlspecialchars($categories['cat_id']);

                    echo '<input type="hidden" name="valuecat_'.$id_categories.'" value="0">';
                    echo '<input type="hidden" name="valuecatDELETE_'.$id_categories.'" value="0">';
                    echo '<tr> 
                        <td><img src="'.htmlspecialchars($ip_link.'/assets/img/category/'.$categories['cat_img']).'" class="img_cat_list"></td>
                        <td>'.htmlspecialchars($categories['cat_id']).'</td>
                        <td>'.htmlspecialchars($categories['cat_libelle']).'</td>
                        <td>' . htmlspecialchars($categories['active_plat_count']) . '</td>
                        <td><input type="checkbox" class="form-check-input" name="valuecat_'.$id_categories.'" value="1" '.$checkcat.'></td>
                        <td><input type="checkbox" class="form-check-input" name="valuecatDELETE_'.$id_categories.'" value="1" '.$checkSuperActive.'></td>
                    </tr>';
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
            <form action="" name="form_enable_plat" method="POST">
                <select id="categorySelect" class="form-select mt-5" aria-label="Default select example"
                    name="cat_select">
                    <option value="" disabled selected class="text-center">Choisissez une catégorie</option>
                    <?php
    foreach ($categorie as $categories) {
        echo '<option class="text-center" value="' . $categories['cat_id'] . '">' . $categories['cat_libelle'] . '</option>';
    }
    ?>
                </select>
                <table class="table mt-3" id="platsTable">
                    <thead>
                        <tr>
                            <th scope="">Image</th>
                            <th scope="">ID</th>
                            <th scope="">Libelle</th>
                            <th scope="">Déscription</th>
                            <th scope="">Prix</th>
                            <th scope="">Catégorie</th>
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
        '<td>'.htmlspecialchars($platLs['plat_id']).'</td>'.
        '<td>'.htmlspecialchars($platLs['plat_libelle']).'</td>'.

        '<td>'.htmlspecialchars($platLs['description']).'</td>'.
        '<td>'.htmlspecialchars($platLs['prix']).'€</td>'.
        '<td>'.htmlspecialchars($platLs['cat_lib']).'</td>'.
        // '<td>' . htmlspecialchars($platLs['active']) . '</td>' .
           '<td><input type="checkbox" class="form-check-input" name="disable_'.$platLs['plat_id'].'" value="1"'.($platLs['plat_active'] === 'Yes' ? ' checked' : '').'></td>'.
    '</tr>';
}
?>
                    </tbody>
                </table>
                <button class="btn btn-primary mt-3 w-100" type="submit" name="submit_update_plat">Valider
                    leschangements</button>
                <button class="btn btn-info mt-3 w-100" id="btn_aug_price" type="submit" name="submit_update_plat_price"
                    disabled>Augmenter les prix
                    de la catégorie de 10%</button>
            </form>
        </section>

        <section id="update_plat_section">
            <h2 class="mt-5 text-center">Modifier / Ajouter un plat</h2>

            <form action="" method="POST" enctype="multipart/form-data">
                <select id="platSelect" class="form-select mt-5" name="update_plat_select">
                    <option class="text-center" value="add">Ajouter un plat</option>
                    <?php

$selectplat_list = admin_plat_edit_add_select();

    foreach ($selectplat_list as $platLs) {
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
                    $admin_plat_edit_cat = admin_list_categorie_select();
                foreach ($admin_plat_edit_cat as $categories) {
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

        </section>

    </div>
    <?php 
    require_once __DIR__.'/../assets/php/admin_script.php';
    require_once __DIR__.'/../assets/php/footer.php'; ?>

</body>

</html>