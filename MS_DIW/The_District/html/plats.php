<?php require_once __DIR__.'/../assets/php/connect.php';

require_once __DIR__.'/../assets/php/head.php'; ?>

<body>
    <div class="container">

        <?php require_once __DIR__.'/../assets/php/header.php'; ?>

        <section id="sec_cards_plat_cat">
            <h1 id="title_section_cat_plat" class="text-center">Tout les plats</h1>
            <div id="cards_section_p_c">

                <?php
$platL = plat_index_list(90000);
foreach ($platL as $plats) {
    $description = $plats['description'];
    if (strlen($description) > 100) {
        $description = substr($description, 0, 200).'...';
    }

    echo '              
                        <form action="" method="POST">
                    <div class="card mb-3" id="cards_plat_all" style="max-width: 540px">
                        <div class="row g-0">
                            <div class="col-md-4">
                                <img src="'.$ip_link.'/assets/img/food/'.$plats['image'].'" class="img-fluid rounded-start" alt="Image du plat" />
                            </div>
                            <div class="col-md-8">
                                <div class="card-body">
                                    <h4 class="card-title"> '.$plats['libelle'].' </h4>
                                    <p class="card-text font_text">
                                        '.$description.'
                                    </p>
                                    <p class="font_text show_price">'.$plats['prix'].' €</p>
                                    <div class="d-grid gap-2 d-md-flex">
                                        
                                            <button type="submit" class="btn btn-info mt-3 btn_com" name="command_btn" value="'.$plats['id'].'">
                                                COMMANDER
                                            </button>
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> </form>';
}

// if (isset($_POST['command_btn'])) {
//     $_SESSION['shopping_list_count'] = $_SESSION['shopping_list_count'] + 1;
// }

?>

            </div>
        </section>
    </div>

    <?php require_once __DIR__.'/../assets/php/footer.php'; ?>

</body>

</html>