<?php require_once __DIR__.'/../assets/php/connect.php';
require_once __DIR__.'/../assets/php/head.php'; ?>

<body>
    <div class="container">
        <?php require_once __DIR__.'/../assets/php/header.php'; ?>
        <section id="pres_cat_pl-p" class="container">
            <?php
$categorie = index_categorie_list(6666);
foreach ($categorie as $categories) {
    echo '
                            
                            <div class="cards_cat_mp" id="img_card1">
                        <img class="img_card_cat" src="'.$ip_link.'/assets/img/category/'.$categories['image'].'" alt="'.$categories['libelle'].'">
                        <a href="'.$ip_link.'/html/foodlist.php?categorie='.preg_replace('#\s+#', '', $categories['id']).'">'.$categories['libelle'].'</a>
                    </div>';
}
?>
        </section>
    </div>
    <?php require_once __DIR__.'/../assets/php/footer.php'; ?>
</body>

</html>