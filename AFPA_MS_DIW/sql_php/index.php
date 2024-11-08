<?php
// ------------ Connect bbd
try {
    $mysqlClient = new PDO(
        'mysql:host=127.0.0.1;dbname=The_District;charset=utf8',
        'root',
        'root',

        // [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION],
    );
} catch (Exception $e) {
    die('Erreur'. $e->getMessage());
}

// ------------

for ($i = 0; $i < 5; $i++) { 
    echo '</br>'; 
}


$sqlQuery = "SELECT * FROM `categorie`  WHERE active = 'YES' ORDER BY libelle ";
$categorieStatement = $mysqlClient->prepare($sqlQuery);
$categorieStatement->execute();
$categorie = $categorieStatement->fetchAll();


$sqlQueryy = "SELECT * FROM `commande` ORDER BY etat ";
$commandeStatementt = $mysqlClient->prepare($sqlQueryy);
$commandeStatementt->execute();
$commande = $commandeStatementt->fetchAll();



echo '<select name="select_cat_list" id="name="select_cat_list">';

foreach ($categorie as $showcat) {

    echo '<option value="' . strip_tags($showcat['libelle']) . '">' . strip_tags($showcat['libelle']) . '</option>';
};

echo '</select>';

foreach ($categorie as $showcat) { 


    
    echo  '<p>' . strip_tags($showcat['libelle']) . ' ' . '<img src="assets/img/category/' . strip_tags($showcat[2]) . '" width="50"  /> </p>'; 
}

echo '<hr> <table border="1"> <tbody>';

foreach ($commande as $showcom) {
    echo '<tr><td>' . 
    $showcom['id'] . '</td><td>' . 
    $showcom['nom_client'] . '</td>' . '<td>' . 
    $showcom['telephone_client'] . '</td>' . '<td>' . 
    $showcom['adresse_client'] . '</td>' . '<td>' . 
    $showcom['etat'] . '</td>' 
    
    
    .  '</tr>' ;
}

echo '</tbody></table> <hr>';

?>


<!-- ----------------- -->

<form action="testinsert.php" method="POST" id="sqlform" enctype="multipart/form-data">
    <label for="libelle">Libelle</label><br>
    <input type="text" id="libelle" name="libelle"><br><br>

    <!-- <label for="image">Image</label><br>
  <input type="text" id="image" name="image"><br><br> -->

    <label for="image_file">Image file</label>
    <input type="file" id="image_file" name="image_file"><br><br>

    <label for="active">Active (Yes/No)</label><br>
    <input type="active" id="active" name="active"><br><br>

    <input type="submit" value="Submit">
</form>





<!-- <form action="">

<label class="container">One
  <input type="checkbox" >
  <span class="checkmark"></span>
</label> -->


<form action="" method="POST">
    <?php
$sqlQuery = "SELECT * FROM `categorie`  ORDER BY libelle";
$categorieeStatement = $mysqlClient->prepare($sqlQuery);
$categorieeStatement->execute();
$categoriee = $categorieeStatement->fetchAll(); ?>

    <?php
foreach ($categoriee as $showcate) { 

if ($showcate['active'] === 'Yes') { 
    $valueactive = 'checked="checked"';
    
}
else { $valueactive = ''; 
}; 

echo 
'<input type="hidden" ' . ' name="' . $showcate['libelle'] .  '"' . 'value="No"'  . '</br>';

    echo '<label>' . strip_tags($showcate['libelle']) . 
    '<input type="checkbox" ' . ' name="' . $showcate['libelle'] . '"' . $valueactive . '' .'>' . '</br>';

   



}

?>
    <input type="submit" value="Submit" name="SubmitButton">
</form>

</br>
</br>

<!-- -------------- -->


<?php 

if(isset($_POST['SubmitButton'])){ //check if form was submitted
   
  


$sqlQuery = "SELECT * FROM `categorie` ";
$categorieStatement = $mysqlClient->prepare($sqlQuery);
$categorieStatement->execute();
$categorie = $categorieStatement->fetchAll();



foreach ($categorie as $showcat) { 
   
    

   


$value = $_POST[$showcat['libelle']];

echo $value;
   
    if ($value == 'on') {
        $activeStatus = 'Yes';
        
    } 
    
    

    else {
        $activeStatus = 'No';
    };




    $updateQuery = "UPDATE `categorie` SET active = :active WHERE libelle = :libelle";
    $updateStatement = $mysqlClient->prepare($updateQuery);
    $updateStatement->execute([
        'active' => $activeStatus,
        'libelle' => $showcat['libelle']
    ]);
}

echo "<meta http-equiv='refresh' content='0'>";

};
?>



<hr>

<!-- -------------- -->


<form action="" method="POST" id="testdelform">
    <label for="namedel">Name</label><br>
    <input type="text" id="namedel" name="namedel"><br><br>

    <input type="submit" value="Submit" name="SubmitDel">
    <!-- <input type="submit" value="Delete" name="DeleteDel"> -->
</form>



<!-- ---------- Test DELETE ------------- -->

<?php


$sqlQueryy = "SELECT * FROM `TestDel`";
$testdelStatementt = $mysqlClient->prepare($sqlQueryy);
$testdelStatementt->execute();
$testdel = $testdelStatementt->fetchAll();


if (isset($_POST['SubmitDel'])) {

    if ($_POST['namedel'] == '') {

        echo '<h3>Champ vide !</h3></br>';
    } else {

        if (!preg_match("/^[a-zA-Z0-9]+$/", $_POST['namedel'])) {

            echo '<h3>Caractères non autorisés détectés ! Seuls les lettres et les chiffres sont autorisés.</h3></br>';
        } else {

            $sqlQuery = 'INSERT INTO TestDel(Name) VALUES (:Name)';
            $insertRecipe = $mysqlClient->prepare($sqlQuery);
            $insertRecipe->execute([
                'Name' => $_POST['namedel']
            ]);
            
            echo "<meta http-equiv='refresh' content='0'>";
        }
    }
    

}


echo '<form action="" method="POST" id="DELETE">';
foreach ($testdel as $showtestdel) {

    echo '<input type="hidden" name="' . $showtestdel['ID'] . '" value="No">';
    echo strip_tags($showtestdel['Name']) . ' <input type="checkbox" name="delete_ids[]" value="' . $showtestdel['ID'] . '"></br>';
}
echo '</br><input type="submit" value="Delete" name="DeleteDel"></form>';




if (isset($_POST['DeleteDel'])) {


    if (!empty($_POST['delete_ids'])) {

        foreach ($_POST['delete_ids'] as $idToDelete) {


            $deleteQuery = "DELETE FROM TestDel WHERE id = :ID";
            $deleteStatement = $mysqlClient->prepare($deleteQuery);
            $deleteStatement->execute([
                'ID' => $idToDelete
            ]);
        }
        

        echo "<meta http-equiv='refresh' content='0'>";

        
    }
}





?>

<!-- ----------------- -->

<!-- 
Pour éviter la faille XSS, il suffit d'appliquer la fonction htmlspecialchars 
 ou  strip_tags sur tous les textes envoyés par vos visiteurs que vous afficherez. -->