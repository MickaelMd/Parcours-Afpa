<?php require_once __DIR__.'/connect.php'; 


if (isset($_FILES['picture_f']) && $_FILES['picture_f']['error'] !== UPLOAD_ERR_NO_FILE) {
    $uploadedFileName = upload_image($_FILES['picture_f']);
    if ($uploadedFileName) {
        $picture = $uploadedFileName; 
    } else {
        echo "Erreur lors de l'upload de l'image.";
        $picture = $uploadedFileName; 
        
    }
}

try {
 
   add_disc($picture);
} catch (Exception $e) {
    echo 'Une erreur s\'est produite : ' . $e->getMessage();
    exit;
}