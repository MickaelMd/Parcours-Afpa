<?php 
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
// -----

    if (isset($_POST['submit_mail'])) {


       
        if (hash_equals($_SESSION['csrf'], $_POST['csrf'])) {



        if (!preg_match(pattern: "/^[a-zA-ZÀ-ÿ][a-zà-ÿ' -]*$/", subject: $_POST['nom'])) {
            echo 'Le nom est obligatoire et doit comporter uniquement des lettres.</br></br>';
    
            return;
        }
    
        if (!preg_match(pattern: "/^[a-zA-ZÀ-ÿ][a-zà-ÿ' -]*$/", subject: $_POST['prenom'])) {
            echo 'Le prénom est obligatoire et doit comporter uniquement des lettres. </br></br>';
    
            return;
        }
        if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
            echo 'Veuillez entrer un email valide. </br></br>';
    
            return;
        }
        if (!preg_match(pattern: "/^(\+?\d{1,3}\s?)?([1-9](\s?\d\s?){8}|\d{10,14})$/", subject: $_POST['telephone'])) {
            echo 'Le téléphone doit comporter uniquement des chiffres. (Le signe + est autorisé.)</br></br>';
    
            return;
        }
        if (!preg_match(pattern: "/^\d+\s[A-Za-zÀ-ÿ0-9\s.'-]+(?:\sAppartement\s\d+)?\s*,?\s*\d{5}\s[A-Za-zÀ-ÿ\s.'-]+$/", subject: $_POST['sign_adresse'])) {
            echo 'L\'adresse est obligatoire et doit être valide.</br></br>';
    
            return;
        }

        $mail = new PHPMailer(true);
        $mail->isSMTP();
        $mail->Host = 'localhost';
        $mail->SMTPAuth = false;
        $mail->Port = 1025;
        $mail->setFrom('noreply@thedistrict.com', 'The District Company');
        $mail->addAddress(isset($_SESSION['email']) ? htmlspecialchars($_POST['email']) : '', " ");
        $mail->addReplyTo("reply@thedistrict.com", "Reply");
    
        $mail->isHTML(true);
        $mail->Subject = '=?UTF-8?B?' . base64_encode('The District : Commande') . '?=';
    
       
        $total = 0;

        ob_start();
        ?>
<h1>Récapitulatif de votre commande :</h1>
<table>
    <tr>
        <th>Libellé</th>
        <th>Prix</th>
        <th>Quantité</th>
    </tr>
    <?php foreach ($commande_list as $platLs):
                $libelle = htmlspecialchars($platLs['libelle'], ENT_QUOTES, 'UTF-8');
                $prix = (float) htmlspecialchars($platLs['prix'], ENT_QUOTES, 'UTF-8');
                $quantite = isset($quantites[$platLs['id']]) ? $quantites[$platLs['id']] : 0;
    
                $total += $prix * $quantite;
            ?>
    <tr>
        <td><?= $libelle ?></td>
        <td><?= number_format($prix, 2) ?>€</td>
        <td><?= $quantite ?></td>
    </tr>
    <?php endforeach; ?>
</table>
<p><strong>Total :</strong> <?= number_format($total, 2) ?>€</p>
<?php
        $body = ob_get_clean();
    
        $mail->Body = $body;
    
        try {
            $mail->send();
            echo 'Email envoyé avec succès';
            unset($_SESSION['commande_list']);
            echo ' <meta http-equiv="refresh" content="0;url=mail_success.php">';

        } catch (Exception $e) {
            echo "L'envoi de mail a échoué. L'erreur suivante s'est produite : ", $mail->ErrorInfo;
        }


    }else {
            die('Token CSRF invalide');
        }
        
    }

    
?>