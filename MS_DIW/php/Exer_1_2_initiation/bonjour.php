<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php 

$bonjour = "Bonjour le monde"; 
echo "<b>$bonjour</b> </br> </br>"; 

   echo "IP Server -> " . $_SERVER["SERVER_NAME"];
   echo "</br>";
   echo "IP Client -> " . $_SERVER["REMOTE_ADDR"];
  
  ?> 


</body>
</html>