<?php require_once __DIR__.'/../assets/php/connect.php';
require_once __DIR__.'/../assets/php/head.php'; ?>


<div class="container">

    <?php require_once __DIR__.'/../assets/php/header.php'; ?>

    <section class="mt-5">

        <h1 class="text-center">Mentions légales</h1>

        <h2>Société éditrice du site :</h2>
        <p>
            <strong>E-Corp</strong><br>
            SAS au capital de : 80.500.000.000 euros<br>
            RCS Nanterre n° 828 758 607 00018<br>
            N° TVA : FR 60 828758607<br>
            Code NAF : 4791A<br>
            Siège social :<br>
            1 E-Corp Plaza<br>
            New York, NY 10001, USA<br>
            Téléphone : +1 212-555-0199
        </p>

        <h2>Contact</h2>
        <p>
            <strong>Téléphone :</strong> +1 212-555-0199<br>
            <strong>Mail :</strong> <a href="mailto:contact@ecorp.com">contact@ecorp.com</a>
        </p>

        <h2>Directeur de publication</h2>
        <p>
            <strong>Phillip Price</strong><br>
            <strong>Mail :</strong> <a href="mailto:publication@ecorp.com">publication@ecorp.com</a>
        </p>

        <h2>Hébergeur du site</h2>
        <p>
            <strong>OVH</strong><br>
            SAS au capital de 10.069.020 euros<br>
            Siège social :<br>
            2 rue Kellermann, 59100 Roubaix<br>
            <strong>Tél :</strong> 1007<br>
            <strong>Mail :</strong> <a href="mailto:contact@ovh.com">contact@ovh.com</a>
        </p>

        <h2>Gestion des cookies et politique de confidentialité</h2>
        <p>
            <a href="<?php echo $ip_link; ?>/pages/rgpd.php">Cliquez ici pour accéder à la politique de
                confidentialité</a>
        </p>

        <h2>Conditions générales de vente</h2>
        <p>
            <a href="<?php echo $ip_link; ?>/pages/cgv.php">Cliquez ici pour accéder aux CGV</a>
        </p>

    </section>

</div>

<?php require_once __DIR__.'/../assets/php/footer.php'; ?>

</body>

</html>