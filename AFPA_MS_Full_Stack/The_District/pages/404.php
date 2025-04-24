<?php 
require_once __DIR__.'/../assets/php/connect.php';
require_once __DIR__.'/../assets/php/head.php'; 
?>

<body>
    <div class="container">
        <?php require_once __DIR__.'/../assets/php/header.php'; ?>

        <section class="mt-5">

            <h1 class="text-center text-danger">Erreur 404</h1>
            <h1 class="text-center text-danger">La page est introuvable.</h1>
            <a href="<?= $ip_link . '/index.php' ?>">
                <h4 class="text-center mt-5">Retourner à l'accueil</h4>
            </a>
        </section>

    </div>
    <?php require_once __DIR__.'/../assets/php/footer.php'; ?>
</body>

</html>