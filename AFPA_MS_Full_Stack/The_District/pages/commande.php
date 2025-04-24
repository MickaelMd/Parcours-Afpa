<?php 
require_once __DIR__.'/../assets/php/connect.php';
require_once __DIR__.'/../assets/php/head.php'; 


// unset($_SESSION['commande_list']);

//  $where = [16,16,12,13,4,5, 'a', 'b'];
//         $_SESSION['commande_list'] = $where;

// require_once __DIR__.'/../assets/php/commande_verif.php'; 

?>

<body>
    <div class="container">
        <?php 
        require_once __DIR__.'/../assets/php/header.php';

        // print_r($_SESSION['commande_list']);
        // echo count($_SESSION['commande_list']);
        ?>

        <section class="mt-5" id="commande_list_section">

            <?php 
        
        if (count($_SESSION['commande_list']) <= 0) {

            echo '<h1>Votre commande est vide.</h1>';
 
         }  else {
            echo ' <h1>Récapitulatif de votre commande :</h1>';
        
        ?>

            <hr>

            <form action="" method="post">
                <input type="hidden" name="csrf" value="<?= htmlspecialchars($_SESSION['csrf']) ?>">
                <section id="sec_cards_plat_cat" class="row">
                    <?php
                    foreach ($commande_list as $platLs):
                        $libelle = htmlspecialchars($platLs['libelle'], ENT_QUOTES, 'UTF-8');
                        $image = htmlspecialchars($platLs['image'], ENT_QUOTES, 'UTF-8');
                        $prix = (float) htmlspecialchars($platLs['prix'], ENT_QUOTES, 'UTF-8'); 
                        $description = htmlspecialchars($platLs['description'], ENT_QUOTES, 'UTF-8');

                        if (strlen($description) > 200) {
                            $description = substr($description, 0, 200) . '...';
                        }

                        $quantite = isset($quantites[$platLs['id']]) ? $quantites[$platLs['id']] : 0;
                    ?>

                    <div class="col-md-4 mb-4">
                        <div class="card h-100">
                            <img src="../assets/img/food/<?= $image ?>" class="card-img-top" alt="<?= $libelle ?>"
                                style="height: 200px; object-fit: cover;">
                            <div class="card-body d-flex flex-column">
                                <h4 class="card-title"><?= $libelle ?></h4>
                                <p class="card-text font_text"><?= $description ?></p>
                                <p class="font_text show_price"><?= number_format($prix, 2) ?>€</p>
                                <input type="number" name="quantite<?= $platLs['id'] ?>" class="form-control" min="0"
                                    value="<?= $quantite ?>" style="width: 100px;">
                                <?php if ($quantite > 0): ?>
                                <p class="mt-2">Quantité : <?= $quantite ?></p>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>

                    <?php 
                
                endforeach; ?>
                </section>

                <button type="submit" name="update_commande" class="btn btn-primary mt-4">Mettre à jour la
                    commande</button>
                <form action="" method="post">
                    <input type="hidden" name="csrf" value="<?= htmlspecialchars($_SESSION['csrf']) ?>">
                    <button type="submit" name="delete_commande" class="btn btn-danger mt-4">Supprimer la
                        commande</button>
                </form>
            </form>

        </section>
        <hr>
        <section id="total_section_commande_list">
            <?php
    $total = 0;
    foreach ($commande_list as $platLs) {
        $prix = (float) htmlspecialchars($platLs['prix'], ENT_QUOTES, 'UTF-8');
        $quantite = isset($quantites[$platLs['id']]) ? $quantites[$platLs['id']] : 0;
        $total_s = $prix * $quantite;
        $total += $total_s;
    }
    ?>
            <h1>Total de la commande : <?= number_format($total, 2) ?>€</h1>
            <a href="commande_final.php" name="validate_commande" class="btn btn-success mt-4">Finalisé la
                commande</a>

        </section>

        <?php } ?>
    </div>

    <?php require_once __DIR__.'/../assets/php/footer.php'; 
    require_once __DIR__.'/../assets/php/commande_update_delete.php'; ?>

</body>

</html>