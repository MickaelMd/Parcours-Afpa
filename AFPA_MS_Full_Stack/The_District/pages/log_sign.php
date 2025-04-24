<?php require_once __DIR__.'/../assets/php/connect.php';
require_once __DIR__.'/../assets/php/head.php'; ?>

<body>
    <div class="container">

        <?php require_once __DIR__.'/../assets/php/header.php'; ?>

        <?php

           if (isset($_SESSION['email']) && !is_null($_SESSION['email'])) {
               echo '<h3 class="text-center mt-5 text-success">Vous êtes connecté ! </h3>';
               echo '<meta http-equiv="refresh" content="1; URL='.$ip_link.'/index.php">';

               return;
           }
?>
        <section id="login_section_page" class="mt-5">

            <h3 class="text-center">Connexion
            </h3>
            <div id="error_login_fail" class="mt-5">
                <h4 class="text-danger text-center">Identifiant ou Mot De Passe incorrect.</h4>
            </div>

            <form action="" method="POST">
                <input type="hidden" name="csrf" value="<?php echo htmlspecialchars($_SESSION['csrf']); ?>">

                <div class="row">
                    <div class="mb-3">
                        <label for="login_email" class="form-label">Adresse email</label>
                        <input type="email" class="form-control" id="login_email" name="login_email">

                    </div>
                    <div class="mb-3">
                        <label for="login_pwd" class="form-label">Mot de passe</label>
                        <input type="password" class="form-control" id="login_pwd" name="login_pwd">
                    </div>

                    <div class="d-flex justify-content-center">
                        <button type="submit" class="btn btn-primary w-50 mt-3" name="login_submit">Connexion</button>

                    </div>
                    <a href="pwdlost.php" class="text-center mt-2">Mot de passe oublié</a>
                </div>
            </form>

        </section>

        <section id="signup_section_page" class="mt-5">

            <h3 class="text-center">Inscription</h3>

            <form id="sign_up_form" action="" method="POST" class="mt-5">
                <input type="hidden" name="csrf" value="<?php echo htmlspecialchars($_SESSION['csrf']); ?>">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="sign_nom" class="form-label text-center">Nom</label>
                        <input type="text" class="form-control" id="sign_nom" name="sign_nom" placeholder="Smith">
                        <span id="error-sign_nom" class="text-danger"></span>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="sign_prenom" class="form-label">Prénom</label>
                        <input type="text" class="form-control" id="sign_prenom" name="sign_prenom" placeholder="John">
                        <span id="error-sign_prenom" class="text-danger"></span>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="sign_email" class="form-label text-center">Email</label>
                        <input type="email" class="form-control" id="sign_email" name="sign_email"
                            placeholder="time.lord@tardismail.com">
                        <span id="error-sign_email" class="text-danger"></span>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="sign_telephone" class="form-label">Téléphone</label>
                        <input type="text" class="form-control" id="sign_telephone" name="sign_telephone"
                            placeholder="07 13 87 19 63">
                        <span id="error-sign_telephone" class="text-danger"></span>
                    </div>

                    <div class="mb-3">
                        <label for="sign_adresse" class="form-label">Adresse</label>
                        <input type="text" class="form-control" id="sign_adresse" name="sign_adresse"
                            placeholder="7 Rue Des Seigneurs du Temps, 00000 Gallifrey">
                        <span id="error-sign_adresse" class="text-danger"></span>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="sign_pwd" class="form-label">Mot de passe</label>
                        <input type="password" class="form-control" id="sign_pwd" name="sign_pwd">
                        <span id="error-sign_pwd" class="text-danger"></span>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="sign_pwd_confirm" class="form-label">Confirmer le mot de passe</label>
                        <input type="password" class="form-control" id="sign_pwd_confirm" name="sign_pwd_confirm">
                        <span id="error-sign_pwd_confirm" class="text-danger"></span>
                    </div>

                    <div>

                        <input type="checkbox" class="form-check-input" id="check_rgpd" name="check_rgpd">
                        <label for="check_rgpd"> Accepter la <a href="<?= $ip_link ?>/pages/rgpd.php">Politique de
                                confidentialité</a></label>
                        </br>
                        <span id="error-check_rgpd" class="text-danger"></span>
                    </div>

                </div>

                <div class="d-flex justify-content-center">
                    <button type="submit" class="btn btn-primary w-50 mt-3" name="sign_submit">Inscription</button>
                </div>
    </div>
    </form>
    </section>

    </div>


    <?php
    require_once __DIR__.'/../assets/php/log_sign_script.php'; 
    require_once __DIR__.'/../assets/php/footer.php'; ?>

</body>

</html>