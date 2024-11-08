<?php require_once __DIR__.'/connect.php'; ?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300..800;1,300..800&family=Playwrite+DE+Grund:wght@100..400&display=swap"
        rel="stylesheet" />
    <link rel="stylesheet" href="/assets/css/style.css" />
    <title>Bloc Note PHP</title>
</head>
<?php
if (isset($_SESSION['login']) && !is_null($_SESSION['login'])) {
    echo '<h3 class="font_title text-center">Vous êtes connecté ! </h3>';
    echo ' <meta http-equiv="refresh" content="1; URL=/../index.php" />';

    return;
} ?>

<body>
    <section id="login_form">
        <form action="" method="post">
            <label for="" class="font_title">Login</label> <br />
            <input type="text" name="login_login" />
            <br />
            <label for="" class="font_title">Mot de passe</label> <br />
            <input type="password" name="login_pass" id="" /> <br />
            <br />
            <input type="submit" class="font_title btn_form" name="btn_login_form" value="Connect" />
        </form>
    </section>
    <section class="error_login">

        <?php

    if (isset($_POST['btn_login_form'])) {
        $login_login = $_POST['login_login'];
        $mdp_login = $_POST['login_pass'];

        $req = $mysqlClient->prepare(query: 'SELECT * FROM users WHERE login = :login');
        $req->execute(params: [
            'login' => $login_login]);
        $resultat = $req->fetch();

        if (!$resultat or !password_verify(password: $_POST['login_pass'], hash: $resultat['mdp'])) {
            echo '<h4>Identifiant ou Mot De Passe incorrect.</h4><br/>';
        } elseif ($resultat['active'] < 1) {
            echo '<h4>Compte désactivé</h4>';
        } else {
            echo '<h4>Vous êtes connecté !</h4><br/>';

            $_SESSION['login'] = $login_login;
            $_SESSION['id'] = $resultat['id'];

            echo ' <meta http-equiv="refresh" content="1; URL=/../index.php" />';
        }
    }
?>
    </section>

    <section id="sign_form">
        <form action="" method="post" name="sign_form">
            <label for="" class="font_title">Login</label> <br />
            <input type="text" name="sign_login" />
            <br />
            <label for="" class="font_title">Mot de passe</label> <br />
            <input type="password" name="sign_pass" id="" /> <br />
            <label for="" class="font_title">Confirmer mot de passe</label> <br />
            <input type="password" name="sign_pass_confirm" id="" /> <br />
            <br />
            <input type="submit" class="font_title btn_form" name="btn_sign_form" value="Sign up" />
        </form>

    </section>
    <section class="error_login">
        <?php
  if (isset($_POST['btn_sign_form'])) {
      if (!preg_match(pattern: "/^[a-zA-ZÀ-ÿ][a-zà-ÿ' -]*$/", subject: $_POST['sign_login'])) {
          echo '<h4>Le login est obligatoire et doit comporter uniquement des lettres.</h4></br></br>';

          return;
      }

      if (!preg_match(pattern: "/^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$/", subject: $_POST['sign_pass'])) {
          echo '<h4>Le mot de passe doit contenir au moins une lettre, un chiffre, et avoir au moins 8 caractères.</h4></br></br>';

          return;
      }
      if ($_POST['sign_pass_confirm'] != $_POST['sign_pass']) {
          echo '<h4>Les mots de passe doivent être identiques.</h4>';

          return;
      }

      $sign_login = $_POST['sign_login'];
      $sign_pass = $_POST['sign_pass_confirm'];

      $stmt = $mysqlClient->prepare(query: 'SELECT * FROM users WHERE login=?');
      $stmt->execute(params: [$sign_login]);
      $user = $stmt->fetch();
      if ($user) {
          echo "<h4>Le nom d'utilisateur existe déjà !</h4>";

          return;
      } else {
          $mdp_hash = password_hash($sign_pass, PASSWORD_DEFAULT);

          $sqlQuery = 'INSERT INTO users (login, mdp) VALUES (:login, :mdp)';
          $insertmdp = $mysqlClient->prepare($sqlQuery);
          $insertmdp->execute([
              'login' => $_POST['sign_login'],
              'mdp' => $mdp_hash,
          ]);
          $req = $mysqlClient->prepare(query: 'SELECT id, login FROM users WHERE login = :login');
          $req->execute([
              'login' => $sign_login]);
          $resultat = $req->fetch();

          $_SESSION['login'] = $sign_login;
          $_SESSION['id'] = $resultat['id'];

          echo '<h4> Compte créer !</h4>';
          echo ' <meta http-equiv="refresh" content="1; URL=/../index.php" />';
      }
  }
?>
    </section>
</body>

</html>