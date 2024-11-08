 <?php

try
{
    $mysqlClient = new PDO(
        'mysql:host=127.0.0.1;dbname=The_District;charset=utf8',
        'root',
        'root',);
}
catch (Exception $e)
{
        die('Erreur : ' . $e->getMessage());
}

// Ecriture de la requête
$sqlQuery = 'INSERT INTO categorie(libelle, image, active) VALUES (:libelle, :image, :active)';

// Préparation
$insertRecipe = $mysqlClient->prepare($sqlQuery);

// Exécution ! 


if ($_POST['active'] !== "Yes" && $_POST['active'] !== "No") {
    echo 'Active doit avoir la valeur Yes ou No.';
    return;
}
else {

if (!preg_match("/^[a-zA-Z0-9]+$/", $_POST['libelle'])) {

    echo 'Dans Libelle Seuls les lettres et les chiffres sont autorisés.';
    return;
}
else {

    if (isset($_FILES['image_file']) && $_FILES['image_file']['error'] === 0) {
        // Testons, si le fichier est trop volumineux
        if ($_FILES['image_file']['size'] > 1000000) {
            echo "L'envoi n'a pas pu être effectué, erreur ou image trop volumineuse";
            return;
        }
    
        // Testons, si l'extension n'est pas autorisée
        $fileInfo = pathinfo($_FILES['image_file']['name']);
        $extension = strtolower($fileInfo['extension']);
        $allowedExtensions = ['jpg', 'jpeg', 'gif', 'png'];
        if (!in_array($extension, $allowedExtensions)) {
            echo "L'envoi n'a pas pu être effectué, l'extension {$extension} n'est pas autorisée";
            return;
        }
    
        // Testons, si le dossier uploads est manquant
        $path = __DIR__ . '/assets/img/category/';
        if (!is_dir($path)) {
            echo "L'envoi n'a pas pu être effectué, le dossier uploads est manquant";
            return;
        }
    
        // Nommer le nouveau fichier avec une extension ".jpg"
        $newnamefile = time() . rand() . '.jpg';
    
        // Redimensionner l'image
        list($width, $height) = getimagesize($_FILES['image_file']['tmp_name']);
        $newWidth = 200;
        $newHeight = 200;
    
        // Créer une nouvelle image en fonction de l'extension
        switch ($extension) {
            case 'jpg':
            case 'jpeg':
                $src = imagecreatefromjpeg($_FILES['image_file']['tmp_name']);
                break;
            case 'png':
                $src = imagecreatefrompng($_FILES['image_file']['tmp_name']);
                break;
            case 'gif':
                $src = imagecreatefromgif($_FILES['image_file']['tmp_name']);
                break;
            default:
                echo "Format d'image non pris en charge";
                return;
        }
    
        // Créer une nouvelle image redimensionnée
        $dst = imagecreatetruecolor($newWidth, $newHeight);
        imagecopyresampled($dst, $src, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);
    
        // Sauvegarder l'image redimensionnée en JPG
        imagejpeg($dst, $path . $newnamefile);
    
        // Libérer la mémoire
        imagedestroy($src);
        imagedestroy($dst);
    
        // Enregistrer le nom du fichier dans la base de données
        $filename = $_FILES['image_file']['name'];
        echo $filename;
    
        $insertRecipe->execute([
            'libelle' => $_POST['libelle'],
            'image' => $newnamefile,
            'active' => $_POST['active']
        ]);
    }
    

}};

header('Location: ' . $_SERVER['HTTP_REFERER']);

?>

 <!-- UPDATE categorie SET id = 20 WHERE libelle = 'libelle'; -->

 <!-- UPDATE commande SET id_plat = 20 WHERE id = '20'; -->