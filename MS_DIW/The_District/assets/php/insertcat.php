<?php

require_once __DIR__.'/connect.php';

if (!isset($_SESSION['email']) || $_SESSION['admin'] < 1) {
    echo '<br>Page refusée !';
    header('Location: '.$ip_link.'/index.php');
    exit;
}
$insertRecipe = insert_cat();

$active = isset($_POST['cat_add_active']) ? 'Yes' : 'No';

if ($active !== 'Yes' && $active !== 'No') {
    echo 'Active doit avoir la valeur Yes ou No.';

    return;
}

if (!preg_match('/^[a-zA-Z0-9]+$/', $_POST['cat_add_name'])) {
    echo 'Dans Libelle, seuls les lettres et les chiffres sont autorisés.';

    return;
}

if (isset($_FILES['cat_add_img']) && $_FILES['cat_add_img']['error'] === 0) {
    if ($_FILES['cat_add_img']['size'] > 1000000) {
        echo "L'image est trop volumineuse.";

        return;
    }

    $fileInfo = pathinfo($_FILES['cat_add_img']['name']);
    $extension = strtolower($fileInfo['extension']);
    $allowedExtensions = ['jpg', 'jpeg', 'gif', 'png'];
    if (!in_array($extension, $allowedExtensions)) {
        echo "L'extension {$extension} n'est pas autorisée.";

        return;
    }

    $path = __DIR__.'/../img/category/';
    if (!is_dir($path)) {
        echo "Le dossier d'upload est manquant.";
        echo $path;

        return;
    }

    $newnamefile = time().rand().'.jpg';

    list($width, $height) = getimagesize($_FILES['cat_add_img']['tmp_name']);
    $newWidth = 200;
    $newHeight = 200;

    switch ($extension) {
        case 'jpg':
        case 'jpeg':
            $src = imagecreatefromjpeg($_FILES['cat_add_img']['tmp_name']);
            break;
        case 'png':
            $src = imagecreatefrompng($_FILES['cat_add_img']['tmp_name']);
            break;
        case 'gif':
            $src = imagecreatefromgif($_FILES['cat_add_img']['tmp_name']);
            break;
        default:
            echo "Format d'image non pris en charge.";

            return;
    }

    $dst = imagecreatetruecolor($newWidth, $newHeight);
    imagecopyresampled($dst, $src, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);

    imagejpeg($dst, $path.$newnamefile);

    imagedestroy($src);
    imagedestroy($dst);

    $insertRecipe->execute([
        'libelle' => $_POST['cat_add_name'],
        'image' => $newnamefile,
        'active' => $active,
    ]);

    header('Location: '.$_SERVER['HTTP_REFERER']);
} else {
    echo "Erreur lors du téléchargement de l'image.";
}
