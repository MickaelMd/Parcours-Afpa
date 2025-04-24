<?php 
require_once __DIR__.'/../assets/php/connect.php';

if (!isset($_GET['categorie'])) {
    header("Location:" . $ip_link . "/");
    exit();
}


$id = $_GET['categorie'];
if (!filter_var($id, FILTER_VALIDATE_INT)) {
    echo '<meta http-equiv="refresh" content="0;url=' . $ip_link . '/pages/404.php">';
    exit('ID invalide.');
}

$resultat = foodlist($id);
$platLStatement = foodlistpl($id);

$name = $resultat ? htmlspecialchars($resultat['libelle'], ENT_QUOTES, 'UTF-8') : "La catégorie demandée n'existe pas. <meta http-equiv=\"refresh\" content=\"0;url=/pages/404.php\">";

$platL = $platLStatement->fetchAll();

require_once __DIR__.'/../assets/php/head.php'; 
?>

<body>
    <div class="container">

        <?php require_once __DIR__.'/../assets/php/header.php'; ?>

        <a id="content_link_foodlist"></a>
        <section id="sec_cards_plat_cat">
            <h1 id="title_section_cat_plat">Catégorie : <?= $name; ?></h1>

            <div id="cards_section_p_c">

                <?php if (!$platL): ?>
                <h1 class="text-danger text-center">Aucun plat dans cette catégorie !</h1>
                <?php else: ?>
                <?php foreach ($platL as $platLs):
                        $libelle = htmlspecialchars($platLs['libelle'], ENT_QUOTES, 'UTF-8');
                        $image = htmlspecialchars($platLs['image'], ENT_QUOTES, 'UTF-8');
                        $prix = htmlspecialchars($platLs['prix'], ENT_QUOTES, 'UTF-8');
                        $description = htmlspecialchars($platLs['description'], ENT_QUOTES, 'UTF-8');

                        if (strlen($description) > 200) {
                            $description = substr($description, 0, 200).'...';
                        }
                    ?>
                <form action="" method="POST">
                    <input type="hidden" name="csrf" value="<?= htmlspecialchars($_SESSION['csrf']) ?>">

                    <div class="card mb-3" id="cards_plat_all" style="max-width: 540px">
                        <div class="row g-0">
                            <div class="col-md-4">
                                <img src="../assets/img/food/<?= $image ?>" class="img-fluid rounded-start"
                                    alt="<?= $libelle ?>" />
                            </div>
                            <div class="col-md-8">
                                <div class="card-body">
                                    <h4 class="card-title"><?= $libelle ?></h4>
                                    <p class="card-text font_text"><?= $description ?></p>
                                    <p class="font_text show_price"><?= $prix ?> €</p>
                                    <div class="d-grid gap-2 d-md-flex">
                                        <button type="submit" class="btn btn-info mt-3 btn_com" name="command_btn"
                                            value="<?= htmlspecialchars($platLs['id'], ENT_QUOTES, 'UTF-8') ?>">
                                            COMMANDER
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
                <?php endforeach; ?>
                <?php endif; ?>

            </div>
            <?php
            $resultatL = btn_left($id);
            $btn_link_l = $resultatL ? $ip_link.'/pages/foodlist.php?categorie='.preg_replace('#\s+#', '', htmlspecialchars($resultatL['id'], ENT_QUOTES, 'UTF-8')) . '#content_link_foodlist' : '#';

            $resultatR = btn_right($id);
            $btn_link_r = $resultatR ? $ip_link.'/pages/foodlist.php?categorie='.preg_replace('#\s+#', '', htmlspecialchars($resultatR['id'], ENT_QUOTES, 'UTF-8')) . '#content_link_foodlist' : '#';
            ?>

            <div id="btn_section" class="d-flex justify-content-center">
                <div class="d-grid gap-2 d-md-block btn_section_cat_menu">
                    <?php if ($btn_link_l !== '#'): ?>
                    <a href="<?= $btn_link_l ?>" class="btn btn-primary btn_suiv_prec" role="button">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                            class="bi bi-arrow-left" viewBox="0 0 16 16">
                            <path fill-rule="evenodd"
                                d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8" />
                        </svg>
                        PRÉCÉDENT
                    </a>
                    <?php endif; ?>

                    <?php if ($btn_link_r !== '#'): ?>
                    <a href="<?= $btn_link_r ?>" class="btn btn-primary btn_suiv_prec" role="button">
                        SUIVANT
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                            class="bi bi-arrow-right" viewBox="0 0 16 16">
                            <path fill-rule="evenodd"
                                d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8" />
                        </svg>
                    </a>
                    <?php endif; ?>
                </div>
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