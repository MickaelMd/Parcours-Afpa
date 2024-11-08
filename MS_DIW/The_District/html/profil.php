<?php require_once __DIR__.'/../assets/php/connect.php';
if (!isset($_SESSION['email'])) {
    header('Location: ../index.php');
}
require_once __DIR__.'/../assets/php/head.php'; ?>


<body>
    <div class="container">

        <?php require_once __DIR__.'/../assets/php/header.php'; ?>

        </hr>
        <section class="mt-5" id="update_profil">
            <h2 class="text-center">Bonjour, <?php echo $_SESSION['prenom']; ?> !</h2>

            <h3 class="text-center mt-5">Modification du profil</h3>

            <form action="" method="POST" id="form_profil">

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
                    <input type="text" class="form-control" id="profil_old_pwd" name="profil_old_pwd">

                </div>
                <div class="d-flex justify-content-center">
                    <button type="submit" class="btn btn-primary w-50 mt-3" name="profil_submit">Modification</button>
                </div>
            </form>

            <?php
        if (isset($_POST['profil_submit'])) {
            if (!empty($_POST['profil_old_pwd'])) {
                $login_login = $_POST['profil_email'];
                $req = $mysqlClient->prepare('SELECT pass, nom_client, nom, prenom, email, telephone, adresse FROM clients WHERE email = :email');
                $req->execute(['email' => $login_login]);
                $resultat = $req->fetch();

                if (!$resultat || !password_verify($_POST['profil_old_pwd'], $resultat['pass'])) {
                    echo 'Ancien mot de passe incorrect.</br></br>';

                    return;
                }
            } else {
                echo 'Veuillez entrer votre ancien mot de passe pour pouvoir mettre à jour.</br></br>';

                return;
            }

            if (!empty($_POST['profil_nom']) && !preg_match("/^[a-zA-ZÀ-ÿ][a-zà-ÿ' -]*$/", $_POST['profil_nom'])) {
                echo 'Le nom doit comporter uniquement des lettres.</br></br>';

                return;
            }

            if (!empty($_POST['profil_prenom']) && !preg_match("/^[a-zA-ZÀ-ÿ][a-zà-ÿ' -]*$/", $_POST['profil_prenom'])) {
                echo 'Le prénom doit comporter uniquement des lettres. </br></br>';

                return;
            }

            if (!empty($_POST['profil_email'])) {
                if (!preg_match("/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/", $_POST['profil_email'])) {
                    echo 'Veuillez entrer un email valide. </br></br>';

                    return;
                }

                $email = $_POST['profil_email'];
                $req = $mysqlClient->prepare('SELECT id FROM clients WHERE email = :email AND uuid != :uuid');
                $req->execute(['email' => $email, 'uuid' => $_SESSION['uuid']]);
                if ($req->fetch()) {
                    echo 'Cet email est déjà utilisé par un autre compte.</br></br>';

                    return;
                }
            }

            if (!empty($_POST['profil_telephone']) && !preg_match("/^(\+?\d{1,3}\s?)?([1-9](\s?\d\s?){8}|\d{10,14})$/", $_POST['profil_telephone'])) {
                echo 'Le téléphone doit comporter uniquement des chiffres. (Le signe + est autorisé.)</br></br>';

                return;
            }

            if (!empty($_POST['profil_adresse']) && !preg_match("/^\d+\s[A-Za-zÀ-ÿ0-9\s.'-]+(?:\sAppartement\s\d+)?\s*,?\s*\d{5}\s[A-Za-zÀ-ÿ\s.'-]+$/", $_POST['profil_adresse'])) {
                echo 'L\'adresse doit être valide.</br></br>';

                return;
            }

            if (!empty($_POST['profil_pwd'])) {
                if (!preg_match("/^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$/", $_POST['profil_pwd'])) {
                    echo 'Le mot de passe doit contenir au moins une lettre, un chiffre, et avoir au moins 8 caractères.</br></br>';

                    return;
                }
                if ($_POST['profil_pwd'] != $_POST['profil_pwd_confirm']) {
                    echo 'Les mots de passe doivent être identiques.</br></br>';

                    return;
                }
            }

            $fieldsToUpdate = [];
            if (!empty($_POST['profil_nom'])) {
                $fieldsToUpdate['nom'] = $_POST['profil_nom'];
            }
            if (!empty($_POST['profil_prenom'])) {
                $fieldsToUpdate['prenom'] = $_POST['profil_prenom'];
            }
            if (!empty($_POST['profil_email'])) {
                $fieldsToUpdate['email'] = $_POST['profil_email'];
            }
            if (!empty($_POST['profil_telephone'])) {
                $fieldsToUpdate['telephone'] = $_POST['profil_telephone'];
            }
            if (!empty($_POST['profil_adresse'])) {
                $fieldsToUpdate['adresse'] = $_POST['profil_adresse'];
            }
            if (!empty($_POST['profil_pwd'])) {
                $fieldsToUpdate['pass'] = password_hash($_POST['profil_pwd'], PASSWORD_DEFAULT);
            }

            if (!empty($fieldsToUpdate)) {
                $updateQuery = 'UPDATE clients SET ';
                $updateParams = [];
                foreach ($fieldsToUpdate as $field => $value) {
                    $updateQuery .= "$field = :$field, ";
                    $updateParams[$field] = $value;
                }

                if (!empty($_POST['profil_nom']) || !empty($_POST['profil_prenom'])) {
                    $nomClient = trim($_POST['profil_prenom'].' '.$_POST['profil_nom']);
                    $updateQuery .= 'nom_client = :nom_client, ';
                    $updateParams['nom_client'] = $nomClient;
                }

                $updateQuery = rtrim($updateQuery, ', ').' WHERE uuid = :uuid';
                $updateParams['uuid'] = $_SESSION['uuid'];

                $updateStatement = $mysqlClient->prepare($updateQuery);
                $updateStatement->execute($updateParams);

                $_SESSION['nom'] = !empty($_POST['profil_nom']) ? $_POST['profil_nom'] : $resultat['nom'];
                $_SESSION['prenom'] = !empty($_POST['profil_prenom']) ? $_POST['profil_prenom'] : $resultat['prenom'];
                $_SESSION['email'] = !empty($_POST['profil_email']) ? $_POST['profil_email'] : $resultat['email'];
                $_SESSION['telephone'] = !empty($_POST['profil_telephone']) ? $_POST['profil_telephone'] : $resultat['telephone'];
                $_SESSION['adresse'] = !empty($_POST['profil_adresse']) ? $_POST['profil_adresse'] : $resultat['adresse'];
                $_SESSION['nom_client'] = !empty($nomClient) ? $nomClient : $resultat['nom_client'];

                echo 'Profil mis à jour avec succès.</br></br>';
            }
        }
?>
        </section>

        <!-- ---------------------------------------------- -->
    </div>
    <?php require_once __DIR__.'/../assets/php/footer.php'; ?>

</body>

</html>