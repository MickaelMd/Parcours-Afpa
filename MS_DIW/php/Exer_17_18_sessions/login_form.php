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
    



    <form class="form" action="login_script.php" method="POST">
       <p class="form-title">Sign in to your account</p>
        <div class="input-container">
          <input type="text" placeholder="Enter login" name="login">
          <span>
          </span>
      </div>
      <div class="input-container">
          <input type="password" placeholder="Enter password" name="password">
        </div>
         <button type="submit" class="submit">
        Sign in
        
      </button>
      <p class="signup-link">
        No account?
        <a href="sign_up.php">Sign up</a>
      </p>
      
   </form>




</body>
</html>