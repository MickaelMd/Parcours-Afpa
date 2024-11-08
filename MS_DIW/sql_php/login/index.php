<?php require_once(__DIR__ . '/verif.php'); ?>

<!-- ------------- Cookie ------------- -->
<?php

// if (isset($_SESSION['login'])) {
//   setcookie(
//       'login',
//       $_SESSION['login'], 
//       [
//           'expires' => time() + 365*24*3600,
//           'secure' => true,
//           'httponly' => true,
//       ]
//   );
// }
// ?>

<?php 
//  if (isset($_COOKIE["login"])) {

// echo 'Bonjour ' . $_COOKIE['login'];

// }; 
?>
<!-- --------------------------------- -->

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous" />
    <title>Document</title>
</head>






<div class="container mt-5">
    <form action="" method="POST" id="mdp_form">
        <h4>Connection</h4>

        <label for="login">Login</label><br />
        <input type="text" id="login" name="login" /><br /><br />

        <label for="mdp">Mot de passe</label><br />
        <input type="password" id="mdp" name="mdp" /><br /><br />
        <input type="submit" value="Submit" name="submit" />
    </form>

    <hr />

    <form action="" method="POST" id="sU_form">
        <h4>Inscription</h4>
        <label for="login_sU">Login</label><br />
        <input type="text" id="login_sU" name="login_sU" /><br /><br />

        <label for="mdp_sU">Mot de passe</label><br />
        <input type="password" id="mdp_sU" name="mdp_sU" /><br /><br />
        <input type="submit" value="Submit" name="submit_sU" />

    </form>
</div>

<hr>

<?php if (isset($_SESSION["login"])) {

echo '<form action="" method="POST" id="deco" style="margin-left:310;">

    <input type="submit" value="Déconnexion" name="deco" />

    </form>';


}
 ?>
<!-- 
    <form action="" method="POST" id="deco" style="margin-left:310;">

    <input type="submit" value="Déconnexion" name="deco" />

    </form> -->

<a href="test_admin.php">Test compte admin</a>
</br>
<a href="test_membre.php">Test membre</a>
<!-- --------------------------------- Kill la session  -->
<?php
if (isset($_POST['deco'])) {
   
    unset($_SESSION["login"]);
    unset($_SESSION["role"]);

   
    if (isset($_COOKIE['login'])) {
        setcookie('login', '', time() - 3600, '/', '', true, true); // chemin et paramètres sécurisés
    }

    
    if (ini_get("session.use_cookies")) {
        setcookie(session_name(), '', time() - 42000, '/');
    }

    
    session_destroy();

    
    echo "Session ID : " . session_id();

    echo "<meta http-equiv='refresh' content='0'>";
}
?>

<!-- ------------------------- -->

<?php 
  // -------------
  try {
    $mysqlClient = new PDO(
        dsn: 'mysql:host=127.0.0.1;dbname=The_District;charset=utf8',
        username: 'root',
        password: 'root',

        // [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION],
    );
} catch (Exception $e) {
    die('Erreur'. $e->getMessage());
}
// ------------- Connection ---------------

 if (isset($_POST['submit'])) {

  $login_login = $_POST['login'];
  $mdp_login = $_POST['mdp'];

  if (!preg_match(pattern: "/^[a-zA-Z0-9]{4,}$/", subject: $_POST['login'])) {
        
    echo 'Le login doit avoir au minimum 4 caractéres uniquement de lettres et de chiffres . </br></br>';
    return;
    }

  echo $login_login . ' - ' . $mdp_login . '</br>';

  
                    $req = $mysqlClient->prepare(query: 'SELECT id, mdp, admin FROM users WHERE login = :login');
                    $req-> execute(params: array(
                        'login' => $login_login));
 
                    $resultat = $req->fetch();
 
                     
                    if (!$resultat OR !password_verify(password: $_POST['mdp'], hash: $resultat['mdp']))
                    {
                        echo 'Identifiant ou Mot De Passe incorrect.<br/>';
                    }
                    else
                    {
                        echo 'Vous êtes connecté !<br/>';

                        $_SESSION["login"] = $login_login;
                        $_SESSION["admin"] = $resultat['admin'];

                        echo' ' . $_SESSION["admin"] . '</br>';
                        echo" Session ID : ".session_id(); 

                        

                        

                         require_once(__DIR__ . '/include.php'); 

                         echo "<meta http-equiv='refresh' content='0'>";

                    }



  };
  
  // --------  Créer un user et se connecter avec    ----- 
  
  if (isset($_POST['submit_sU'])) {

    echo  '</br>' . $_POST['login_sU'] . '</br>';
    echo $_POST['mdp_sU'] . '</br>';

    if (!preg_match(pattern: "/^[a-zA-Z0-9]{4,}$/", subject: $_POST['login_sU'])) {
        
      echo 'Le login doit avoir au minimum 4 caractéres uniquement de lettres et de chiffres . </br></br>';
      return;
      }

      if (!preg_match(pattern: "/^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d!;:?.@#$%^&*{}]{8,}$/", subject: $_POST['mdp_sU'])) {
        
        echo 'Le mot de passe doit contenir au moins une lettre, un chiffre, et avoir au moins 8 caractères. </br></br>';
        return;
        }


    $username_sU = $_POST['login_sU'];
    $stmt = $mysqlClient->prepare(query: "SELECT * FROM users WHERE login=?");
    $stmt->execute(params: [$username_sU]); 
    $user = $stmt->fetch();
    if ($user) {
        echo "Le nom d'utilisateur existe déjà !";
    } else {
        // le nom d'utilisateur n'existe pas
    





echo '</br>';

$mdp_sU = $_POST['mdp_sU'];

$mdp_hash = password_hash($mdp_sU, PASSWORD_DEFAULT);

echo $mdp_hash;

echo '</br>';

if (password_verify($mdp_sU, $mdp_hash)) {
  echo 'Le mot de passe est valide !';
} else {
  echo 'Le mot de passe est invalide.';
}

$sqlQuery = 'INSERT INTO users(login, mdp) VALUES (:login, :mdp)';

// Préparation
$insertmdp = $mysqlClient->prepare($sqlQuery);

// Exécution ! 
$insertmdp->execute([
  'login' => $_POST['login_sU'],
  'mdp' => $mdp_hash,
  
  
]);
// --------------connection avec la nouvelle-----------------
// unset($_SESSION["login"]);
//    unset($_SESSION["role"]);

//    if (ini_get("session.use_cookies")) 
//    {
//        setcookie(session_name(), '', time()-42000);
//    }

//    session_destroy();


$req = $mysqlClient->prepare('SELECT id, mdp, admin FROM users WHERE login = :login');
                    $req-> execute(array(
                        'login' => $username_sU));
 
                    $resultat = $req->fetch();
 

$_SESSION["login"] = $username_sU;
$_SESSION["admin"] = $resultat['admin'];

// ----------------------------------

// echo' ' . $_SESSION["admin"] . '</br>';
// echo" Session ID : ".session_id(); 





//  require_once(__DIR__ . '/include.php'); 

 echo "<meta http-equiv='refresh' content='0'>";


  };
};


  
  
  
  ?>

<!-- ------------------------- -->

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
</script>
</body>

</html>




<?php   
        
        //         if (isset($_POST['submit'])) {
        //         if (!preg_match("/^[a-zA-Z0-9]+$/", $_POST['login'])) {
        
        // echo 'Seuls les lettres et les chiffres sont autorisés. </br></br>';
        
        // }
        // } ?>