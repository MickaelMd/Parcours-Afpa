<?php require_once __DIR__.'/../assets/php/connect.php';
require_once __DIR__.'/../assets/php/head.php'; ?>

<body>
    <div class="container">

        <?php require_once __DIR__.'/../assets/php/header.php'; ?>

        <section id="contact_section_page">
            <div id="info_contact" class="text-center">
                <h2>Adresse</h2>
                <p class="font_text">30 Rue de Poulainville, 80000 Amiens</p>
                <h2>Téléphone :</h2>
                <p class="font_text">09 72 72 39 36</p>
            </div>
            <div id="OSM-map" style="height: 500px"></div>
        </section>

        <section id="contact_form_section">
            <h2 class="text-center">Contact</h2>
            <div id="form_contact" class="container"></div>
            <form id="contactForm" action="../assets/php/contact_form/contact_script.php" method="POST">
                <div class="row mb-3 mt-3">
                    <div class="col-md-6">
                        <label class="form-label" for="nom">Nom</label>
                        <input type="text" class="form-control" id="nom" name="nom" required <?php

            if (isset($_SESSION['nom']) && !is_null($_SESSION['nom'])) {
                echo 'value="'.$_SESSION['nom'].'" readonly';
            } ?> />
                        <span id="error-nom" class="text-danger"></span>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label" for="prenom">Prenom</label>
                        <input type="text" class="form-control" id="prenom" name="prenom" required <?php

            if (isset($_SESSION['prenom']) && !is_null($_SESSION['prenom'])) {
                echo 'value="'.$_SESSION['prenom'].'" readonly';
            } ?> />
                        <span id="error-prenom" class="text-danger"></span>
                    </div>
                </div>

                <div class="row mb-3 mt-3">
                    <div class="col-md-6">
                        <label class="form-label" for="email">Email</label>
                        <input type="email" class="form-control" id="email" name="email" required <?php

            if (isset($_SESSION['email']) && !is_null($_SESSION['email'])) {
                echo 'value="'.$_SESSION['email'].'" readonly';
            } ?> />
                        <span id="error-email" class="text-danger"></span>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label" for="telephone">Téléphone</label>
                        <input type="text" class="form-control" id="telephone" name="telephone" required <?php

            if (isset($_SESSION['telephone']) && !is_null($_SESSION['telephone'])) {
                echo 'value="'.$_SESSION['telephone'].'" readonly';
            } ?> />
                        <span id="error-telephone" class="text-danger"></span>
                    </div>
                </div>

                <div class="mt-3">
                    <label class="form-label" for="demande">Votre demande</label>
                    <textarea class="form-control" id="demande" cols="30" rows="10" name="demande" required></textarea>
                    <span id="error-demande" class="text-danger"></span>
                </div>
                <div class="d-flex justify-content-center m-5">
                    <input class="btn btn-lg btn-info m-2" type="submit" value="Envoyer" />
                </div>
            </form>
        </section>

    </div>

    <?php require_once __DIR__.'/../assets/php/footer.php'; ?>

    <script src="https://unpkg.com/leaflet@1.6.0/dist/leaflet.js"></script>
</body>

</html>