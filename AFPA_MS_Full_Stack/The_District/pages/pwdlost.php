<?php 
require_once __DIR__.'/../assets/php/connect.php';
require_once __DIR__.'/../assets/php/head.php'; 
require_once __DIR__.'/../assets/php/mail_reset_pass.php'; 
?>

<body>
    <div class="container">

        <?php require_once __DIR__.'/../assets/php/header.php'; ?>

        <?php if (isset($_SESSION['email']) && !is_null($_SESSION['email'])): ?>
        <h3 class="text-center mt-5 text-success">Vous êtes connecté !</h3>
        <?php else: ?>
        <section id="login_section_page" class="mt-5">
            <h3 class="text-center">Mot de passe perdu</h3>
            <form action="" method="POST">
                <input type="hidden" name="csrf" value="<?= htmlspecialchars($_SESSION['csrf']) ?>">

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
        <?php endif; ?>

        <?php 
        if (isset($_POST['reset_submit'])) {
            if (hash_equals($_SESSION['csrf'], $_POST['csrf'])) {
            $lostemail = $_POST['reset_email'];
            $resultat = pwdlostfind($lostemail);

            if (!$resultat): ?>
        <br>
        <h3 class="text-center">Aucun utilisateur trouvé avec cet email.</h3><br />
        <?php else:
                $resetcode = rand(10000000, 99999999);
                setresetcode($resetcode, $lostemail); 
            ?>
        <h3 class="text-center mt-4 text-danger">Code de réinitialisation : <?php 
        
        // $resetcode 
        
        
        ?></h3>
        <br>
        <p class="text-center">(envoyer par mail avec phpmailer et MailHog)</p>


        <?php 
        
        reset_code_mail($lostemail, $resetcode);
        
        echo "<meta http-equiv=refresh content=1>";

    
        ?>

        <?php endif;
            } else {
            
                die('Token CSRF invalide');
            
            }
        }
        ?>

    </div>
    <?php require_once __DIR__.'/../assets/php/footer.php'; ?>

</body>

</html>