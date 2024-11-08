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
                    <div class="d-flex justify-content-center">
                        <button type="submit" class="btn btn-primary w-50 mt-3" name="sign_submit">Inscription</button>
                    </div>
                </div>
            </form>
        </section>

    </div>
    <?php

    // ------------- Connection ---------------

if (isset($_POST['login_submit'])) {
    $login_login = $_POST['login_email'];
    $mdp_login = $_POST['login_pwd'];

    if (!filter_var($_POST['login_email'], FILTER_VALIDATE_EMAIL)) {
        echo 'Veuillez entrer un email valide. </br></br>';

        return;
    }

    $resultat = connect_result($login_login);

    if (!$resultat or !password_verify(password: $_POST['login_pwd'], hash: $resultat['pass'])) {
        $fail_pass = true;
        echo '<script>localStorage.setItem("loginFail", true);</script>';
    } elseif ($resultat['active'] < 1) {
        echo 'Compte désactivé';
    } else {
        echo 'Vous êtes connecté !<br/>';

        $_SESSION['email'] = $login_login;
        $_SESSION['nom'] = $resultat['nom'];
        $_SESSION['prenom'] = $resultat['prenom'];
        $_SESSION['telephone'] = $resultat['telephone'];
        $_SESSION['adresse'] = $resultat['adresse'];
        $_SESSION['admin'] = $resultat['admin'];
        $_SESSION['nom_client'] = $resultat['nom_client'];
        $_SESSION['uuid'] = $resultat['uuid'];
        // $_SESSION['shopping_list_count'];

        echo ' '.$_SESSION['admin'].'</br>';
        echo ' Session ID : '.session_id();

        connect_resetcode($login_login);

        echo "<meta http-equiv='refresh' content='0'>";
    }
}

?>
    <?php

  // --------  Créer un user et se connecter avec    -----

  if (isset($_POST['sign_submit'])) {
      if (!preg_match(pattern: "/^[a-zA-ZÀ-ÿ][a-zà-ÿ' -]*$/", subject: $_POST['sign_nom'])) {
          echo 'Le nom est obligatoire et doit comporter uniquement des lettres.</br></br>';

          return;
      }

      if (!preg_match(pattern: "/^[a-zA-ZÀ-ÿ][a-zà-ÿ' -]*$/", subject: $_POST['sign_prenom'])) {
          echo 'Le prénom est obligatoire et doit comporter uniquement des lettres. </br></br>';

          return;
      }
      if (!filter_var($_POST['sign_email'], FILTER_VALIDATE_EMAIL)) {
          echo 'Veuillez entrer un email valide. </br></br>';

          return;
      }
      if (!preg_match(pattern: "/^(\+?\d{1,3}\s?)?([1-9](\s?\d\s?){8}|\d{10,14})$/", subject: $_POST['sign_telephone'])) {
          echo 'Le téléphone doit comporter uniquement des chiffres. (Le signe + est autorisé.)</br></br>';

          return;
      }
      if (!preg_match(pattern: "/^\d+\s[A-Za-zÀ-ÿ0-9\s.'-]+(?:\sAppartement\s\d+)?\s*,?\s*\d{5}\s[A-Za-zÀ-ÿ\s.'-]+$/", subject: $_POST['sign_adresse'])) {
          echo 'L\'adresse est obligatoire et doit être valide.</br></br>';

          return;
      }
      if (!preg_match(pattern: "/^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$/", subject: $_POST['sign_pwd'])) {
          echo 'Le mot de passe doit contenir au moins une lettre, un chiffre, et avoir au moins 8 caractères.</br></br>';

          return;
      }
      if ($_POST['sign_pwd_confirm'] != $_POST['sign_pwd']) {
          echo 'Les mots de passe doivent être identiques.';

          return;
      }

      $sign_email = $_POST['sign_email'];

      $user = sign_email($sign_email);

      if ($user) {
          echo "Le nom d'utilisateur existe déjà !";
      } else {
          $nom_client = ucfirst($_POST['sign_prenom']).' '.ucfirst($_POST['sign_nom']);

          echo '</br>';

          $mdp_sU = $_POST['sign_pwd'];

          $mdp_hash = password_hash($mdp_sU, PASSWORD_DEFAULT);

          echo $mdp_hash;

          echo '</br>';

          if (password_verify($mdp_sU, $mdp_hash)) {
              echo 'Le mot de passe est valide !';
          } else {
              echo 'Le mot de passe est invalide.';
          }

          $sign_nom = $_POST['sign_nom'];
          $sign_prenom = $_POST['sign_prenom'];
          $sign_telephone = $_POST['sign_telephone'];
          $sign_adresse = $_POST['sign_adresse'];

          sign_insert($nom_client, $sign_nom, $sign_prenom, $sign_email, $sign_telephone, $sign_adresse, $mdp_hash);

          $_SESSION['email'] = $sign_email;
          $_SESSION['nom'] = $resultat['nom'];
          $_SESSION['prenom'] = $resultat['prenom'];
          $_SESSION['telephone'] = $resultat['telephone'];
          $_SESSION['adresse'] = $resultat['adresse'];
          $_SESSION['admin'] = $resultat['admin'];
          $_SESSION['nom_client'] = $resultat['nom_client'];
          $_SESSION['uuid'] = $resultat['uuid'];
          $_SESSION['shopping_list_count'];

          echo "<meta http-equiv='refresh' content='0'>";
      }
  }

?>
    <?php require_once __DIR__.'/../assets/php/footer.php'; ?>

</body>

</html>