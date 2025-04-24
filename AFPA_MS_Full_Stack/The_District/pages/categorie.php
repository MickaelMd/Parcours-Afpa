<?php require_once __DIR__.'/../assets/php/connect.php';
require_once __DIR__.'/../assets/php/head.php'; ?>

<body>
    <div class="container">
        <?php require_once __DIR__.'/../assets/php/header.php'; ?>

        <section id="pres_cat_pl-p" class="container">
            <?php
            $categorie = index_categorie_list(6666);
            foreach ($categorie as $categories) : ?>
            <div class="cards_cat_mp" id="img_card1">
                <img class="img_card_cat"
                    src="<?= htmlspecialchars($ip_link . '/assets/img/category/' . $categories['image'], ENT_QUOTES, 'UTF-8') ?>"
                    alt="<?= htmlspecialchars($categories['libelle'], ENT_QUOTES, 'UTF-8') ?>">
                <a
                    href="<?= htmlspecialchars($ip_link . '/pages/foodlist.php?categorie=' . preg_replace('#\s+#', '', $categories['id']), ENT_QUOTES, 'UTF-8') ?>"><?= htmlspecialchars($categories['libelle'], ENT_QUOTES, 'UTF-8') ?></a>
            </div>
            <?php endforeach; ?>
        </section>
    </div>
    <?php require_once __DIR__.'/../assets/php/footer.php'; ?>
</body>

</html>