<?php

    // ------------- Connection ---------------

    if (isset($_POST['login_submit'])) {

        if (hash_equals($_SESSION['csrf'], $_POST['csrf'])) {

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
    else {
        die('Token CSRF invalide');
    }
    }
    

// --------  Créer un user et se connecter avec    -----

if (isset($_POST['sign_submit'])) {
    if (hash_equals($_SESSION['csrf'], $_POST['csrf'])) {

        if (!isset($_POST['check_rgpd'])) {
            echo 'Vous devez accepter la politique de confidentialité.';
            return;
        }

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

        $resultat = connect_result($sign_email);
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
    else {
        die('Token CSRF invalide');
    }
}