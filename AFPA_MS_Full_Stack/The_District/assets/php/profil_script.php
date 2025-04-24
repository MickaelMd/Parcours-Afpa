<?php


        if (isset($_POST['profil_submit'])) {


            if (hash_equals($_SESSION['csrf'], $_POST['csrf'])) {


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
        else {
            die('Token CSRF invalide');
        }
        }

        if (isset($_POST['delete_profil'])) {
            if (hash_equals($_SESSION['csrf'], $_POST['csrf'])) {

    delete_profil($_SESSION['uuid']);
    echo "<meta http-equiv='refresh' content='0'>";

            echo "test btn delete";
            }  else {
                die('Token CSRF invalide');
            }
        };