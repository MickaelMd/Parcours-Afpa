<?php require_once __DIR__.'/../assets/php/connect.php';
if (!isset($_SESSION['email'])) {
    header('Location: ../index.php');
}
require_once __DIR__.'/../assets/php/head.php'; 
?>

<body>

    <div class="container">

        <?php require_once __DIR__.'/../assets/php/header.php'; ?>

        </hr>
        <section class="mt-5" id="update_profil">
            <h2 class="text-center">Bonjour, <?php echo $_SESSION['prenom']; ?> !</h2>

            <h3 class="text-center mt-5">Modification du profil</h3>

            <form action="" method="POST" id="form_profil">
                <input type="hidden" name="csrf" value="<?php echo htmlspecialchars($_SESSION['csrf']); ?>">

                <div class="row mb-3 mt-3">
                    <div class="col-md-6">
                        <label class="form-label" for="nom">Nom</label>
                        <input type="text" class="form-control" id="profil_nom" name="profil_nom" <?php

           if (isset($_SESSION['nom']) && !is_null($_SESSION['nom'])) {
               echo 'value="'.$_SESSION['nom'].'"';
           } ?> />
                        <span id="error-profil_nom" class="text-danger"></span>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label" for="profil_prenom">Prenom</label>
                        <input type="text" class="form-control" id="profil_prenom" name="profil_prenom" <?php

           if (isset($_SESSION['prenom']) && !is_null($_SESSION['prenom'])) {
               echo 'value="'.$_SESSION['prenom'].'"';
           } ?> />
                        <span id="error-profil_prenom" class="text-danger"></span>
                    </div>
                </div>
                <div class="row mb-3 mt-3">
                    <div class="col-md-6">
                        <label class="form-label" for="profil_email">Email</label>
                        <input type="email" class="form-control" id="profil_email" name="profil_email" <?php

           if (isset($_SESSION['email']) && !is_null($_SESSION['email'])) {
               echo 'value="'.$_SESSION['email'].'"';
           } ?> />
                        <span id="error-profil_email" class="text-danger"></span>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label" for="profil_telephone">Téléphone</label>
                        <input type="text" class="form-control" id="profil_telephone" name="profil_telephone" <?php

           if (isset($_SESSION['telephone']) && !is_null($_SESSION['telephone'])) {
               echo 'value="'.$_SESSION['telephone'].'"';
           } ?> />
                        <span id="error-profil_telephone" class="text-danger"></span>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="profil_adresse" class="form-label">Adresse</label>
                    <input type="text" class="form-control" id="profil_adresse" name="profil_adresse" <?php if (isset($_SESSION['adresse']) && !is_null($_SESSION['adresse'])) {
                        echo 'value="'.$_SESSION['adresse'].'"';
                    }?>>
                    <span id="error-profil_adresse" class="text-danger"></span>
                </div>
                <div class="row mb-3 mt-3">
                    <div class="col-md-6 mb-3">
                        <label for="profil_pwd" class="form-label">Mot de passe</label>
                        <input type="password" class="form-control" id="profil_pwd" name="profil_pwd">
                        <span id="error-profil_pwd" class="text-danger"></span>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="profil_pwd_confirm" class="form-label">Confirmer le mot de passe</label>
                        <input type="password" class="form-control" id="profil_pwd_confirm" name="profil_pwd_confirm">
                        <span id="error-profil_pwd_confirm" class="text-danger"></span>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="profil_old_pwd" class="form-label">Ancien mot de
                        passe</label>
                    <input type="password" class="form-control" id="profil_old_pwd" name="profil_old_pwd">

                </div>
                <div class="d-flex justify-content-center">
                    <button type="submit" class="btn btn-primary w-50 mt-3" name="profil_submit">Modification</button>

                </div>
                <div class="d-flex justify-content-center">
                    <button type="button" class="btn btn-danger text-center mt-3" id="btn_delete_profil">Supprimer
                        votre
                        compte</button>
                </div>
            </form>
            <?php require_once __DIR__.'/../assets/php/profil_script.php'; ?>

        </section>

        <section id="delete_account_section">
            <h2 class="text-light text-center">Voulez vous vraiment supprimer votre compte ?</h2>

            <div id="btn_section_delete">
                <form action="" method="post">
                    <input type="hidden" name="csrf" value="<?php echo htmlspecialchars($_SESSION['csrf']); ?>">
                    <button type="submit" class="btn btn-danger text-center" name="delete_profil">Supprimer
                        définitivement !</button>

                </form>

                <div class="d-flex justify-content-center">
                    <button type="button" class="btn btn-primary text-center mt-3" id="btn_delete_profil_back">Retour
                        vers le
                        profil</button>
                </div>

            </div>

        </section>

        <!-- ---------------------------------------------- -->

    </div>
    <?php require_once __DIR__.'/../assets/php/footer.php'; ?>

</body>

</html>