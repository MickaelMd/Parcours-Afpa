<?php require_once __DIR__.'/../assets/php/connect.php';
require_once __DIR__.'/../assets/php/head.php'; ?>

<body>
    <div class="container">

        <?php require_once __DIR__.'/../assets/php/header.php'; ?>

        <?php

            if (isset($_SESSION['email']) && !is_null($_SESSION['email'])) {
                echo '<h3 class="text-center mt-5 text-success">Vous êtes connecté ! </h3>';
            } else {
                echo ' 

        <section id="login_section_page" class="mt-5">
            <h3 class="text-center">Mot de passe perdu</h3>
            <form action="" method="POST">
                <div class="row">
                    <div class="mb-3 mt-5 text-center">
                        <label for="reset_email" class="form-label text-center">Adresse email</label>
                        <input type="email" class="form-control" id="reset_email" name="reset_email">
                    </div>
                    <div class="d-flex justify-content-center">
                        <button type="submit" class="btn btn-primary w-50 mt-3"
                            name="reset_submit">Réinitialiser</button>
                    </div>
<a href="resetpass.php" class="text-center mt-2">Vous avez un code ?</a>
                </div>
            </form>
        </section>
    </div>
 ';
            }

?>
        <?php
    if (isset($_POST['reset_submit'])) {
        $lostemail = $_POST['reset_email'];

        $resultat = pwdlostfind($lostemail);

        if (!$resultat) {
            echo ' </br><h3 class="text-center">Aucun utilisateur trouvé avec cet email.</h3><br/>';
        } else {
            $resetcode = rand(10000000, 99999999);

            setresetcode($resetcode, $lostemail);

            echo '<h3 class="text-center mt-4 text-danger">Code de réinitialisation : '.$resetcode.'</h3>'.
            '</br> <p class="text-center">(a envoyer par mail)</p>';
        }
    }
?>

    </div>
    <?php require_once __DIR__.'/../assets/php/footer.php'; ?>

</body>

</html>