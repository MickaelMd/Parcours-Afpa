<?php 
require_once __DIR__.'/../assets/php/connect.php';
require_once __DIR__.'/../assets/php/head.php'; 
?>

<body>
    <div class="container">
        <?php require_once __DIR__.'/../assets/php/header.php'; ?>

        <section id="sec_cards_plat_cat">
            <h1 id="title_section_cat_plat" class="text-center">Tous les plats</h1>
            <div id="cards_section_p_c">

                <?php
                $platL = plat_index_list(90000);

                foreach ($platL as $plats):
                    $libelle = htmlspecialchars($plats['libelle'], ENT_QUOTES, 'UTF-8');
                    $image = htmlspecialchars($plats['image'], ENT_QUOTES, 'UTF-8');
                    $prix = htmlspecialchars($plats['prix'], ENT_QUOTES, 'UTF-8');
                    $description = htmlspecialchars($plats['description'], ENT_QUOTES, 'UTF-8');

                   
                    if (strlen($description) > 200) {
                        $description = substr($description, 0, 200).'...';
                    }
                ?>

                <form action="" method="POST">
                    <input type="hidden" name="csrf" value="<?= htmlspecialchars($_SESSION['csrf']) ?>">

                    <div class="card mb-3" id="cards_plat_all" style="max-width: 540px">
                        <div class="row g-0">
                            <div class="col-md-4">
                                <img src="<?= $ip_link ?>/assets/img/food/<?= $image ?>" class="img-fluid rounded-start"
                                    alt="Image du plat" />
                            </div>
                            <div class="col-md-8">
                                <div class="card-body">
                                    <h4 class="card-title"><?= $libelle ?></h4>
                                    <p class="card-text font_text"><?= $description ?></p>
                                    <p class="font_text show_price"><?= $prix ?> €</p>
                                    <div class="d-grid gap-2 d-md-flex">
                                        <button type="submit" class="btn btn-info mt-3 btn_com" name="command_btn"
                                            value="<?= htmlspecialchars($plats['id'], ENT_QUOTES, 'UTF-8') ?>">
                                            COMMANDER
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>

                <?php endforeach; ?>

            </div>
        </section>
    </div>

    <?php require_once __DIR__.'/../assets/php/footer.php'; ?>

</body>

</html>


<?php 
if (isset($_POST['command_btn'])) {
    
    if (hash_equals($_SESSION['csrf'], $_POST['csrf'])) {
        
        
        if (filter_var($_POST['command_btn'], FILTER_VALIDATE_INT) !== false) {
            $command_id = (int) $_POST['command_btn']; 
            
            
            if (platExists($command_id)) {
               
                array_push($_SESSION['commande_list'], $command_id);
                echo "<meta http-equiv='refresh' content='0'>";
            } else {
                die('ID du plat invalide');
            }
        } else {
            die('La valeur de command_btn doit être un entier valide');
        }
    } else {
        die('Token CSRF invalide');
    }
}


?>