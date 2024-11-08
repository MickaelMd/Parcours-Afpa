<!-- --------------------------------------------------
--- Plus complet dans le dossier sql_php/login ---
-------------------------------------------------- -->

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=SUSE:wght@100..800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <title>Document</title>
</head>
<body>
    

<body>
    <form class="form" action="sign_up_script.php" method="POST">
       <p class="form-title">Créer un compte</p>
        <div class="input-container">
          <input type="text" placeholder="Nom" name="sign_nom" required>
        </div>
        <div class="input-container">
          <input type="text" placeholder="Prénom" name="sign_prenom" required>
        </div>
        <div class="input-container">
          <input type="email" placeholder="Adresse email" name="sign_email" required>
        </div>
        <div class="input-container">
          <input type="text" placeholder="Login" name="sign_login" required>
        </div>
        <div class="input-container">
          <input type="password" placeholder="Mot de passe" name="sign_password" required>
        </div>
        <button type="submit" class="submit">S'inscrire</button>
    </form>
    
   </form>


</body>
</html>