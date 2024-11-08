<?php 
require_once(__DIR__ . '/verif.php'); 
?> 


<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH"
      crossorigin="anonymous"
    />
  </head>
  <body>





  <?php if (isset($_SESSION["login"])) {


if ($_SESSION["admin"] < 1) {

    echo '</br>' . 'Page refusé !';
    return;
  
  };

}
else {

    echo '</br>' . 'Page refusé';
    return;

} ?>




<?php 

try {
  $mysqlClient = new PDO(
      'mysql:host=127.0.0.1;dbname=The_District;charset=utf8',
      'root',
      password: 'root',

      // [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION],
  );
} catch (Exception $e) {
  die('Erreur'. $e->getMessage());
}


// -------------------------

for ($i = 0; $i < 5; $i++) { echo '</br>'; }


$sqlQueryy = "SELECT * FROM `users` WHERE `admin` != 1";
$testdelStatementt = $mysqlClient->prepare($sqlQueryy);
$testdelStatementt->execute();
$testdel = $testdelStatementt->fetchAll();
echo '<div class="container">';
echo '<form action="" method="POST" id="DELETE">';
echo '<table class="table" >
  <thead>
    <tr>
      <th scope="">Login</th>
      <th scope="">Date d\'inscription</th>
      <th scope="">Select</th>
    </tr>
  </thead>
  <tbody>';

  foreach ($testdel as $showtestdel) {

    echo '<tr> <td>' . strip_tags($showtestdel['login']) . '</td>' .
    '<td>' . $showtestdel['date'] . '</td>' .
     '<td>' . ' <input type="checkbox" name="delete_ids[]" value="' . $showtestdel['id'] . '' . '"> ' . '</td>'
    
    ;

  };
echo '<div class="container">';
  echo '</tbody></table>  <input type="submit" value="Delete" name="DeleteDel"> </form>';


echo '<form action="" method="POST" id="DELETE">';
foreach ($testdel as $showtestdel) {

    echo '<input type="hidden" name="' . $showtestdel['login'] . '" value="No">';
    echo 'Login : ' . strip_tags($showtestdel['login']) . ' - Date d\'inscription ' . $showtestdel['date'] .  ' <input type="checkbox" name="delete_ids[]" value="' . $showtestdel['id'] . '' . '"></br>';
}
echo '</br><input type="submit" value="Delete" name="DeleteDel"></form></div>';


if (isset($_POST['DeleteDel'])) {


    if (!empty($_POST['delete_ids'])) {

        foreach ($_POST['delete_ids'] as $idToDelete) {


            $deleteQuery = "DELETE FROM users WHERE id = :login";
            $deleteStatement = $mysqlClient->prepare($deleteQuery);
            $deleteStatement->execute([
                'login' => $idToDelete
            ]);
        }
        

        echo "<meta http-equiv='refresh' content='0'>";

        
    }
}



?>
    

    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
      crossorigin="anonymous"
    ></script>
  </body>
</html>
