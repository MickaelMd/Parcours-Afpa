<?php require_once __DIR__.'/connect.php'; 

$ids = $_POST['id'];
$artist_id = artist_id($_POST['artist_f']);


if (!is_numeric($ids) || (int) $ids <= 0) {
    echo '<h1>Erreur : ID invalide.</h1>';
    exit;
}

$prt = details_disc($ids);

if (!$prt) {
    echo "Le disc n'existe pas.";
    exit;
} 

if (isset($_FILES['picture_f']) && $_FILES['picture_f']['error'] !== UPLOAD_ERR_NO_FILE) {
    $uploadedFileName = upload_image($_FILES['picture_f']);
    if ($uploadedFileName) {
        $picture = $uploadedFileName; 
    } else {
        echo "Erreur lors de l'upload de l'image.";
        $picture = $prt['disc_picture'];
    }
} else {

    $picture = $prt['disc_picture'];
}

try {
    update_disc($ids, $artist_id[0], $picture);


    // function update_disc($ids, $artist_id, $picture) {

    //     global $mysqlClient;
    //     $updateQuery = 'UPDATE disc 
    //                     SET disc_title = :title, 
    //                         disc_year = :year, 
    //                         disc_picture = :picture, 
    //                         disc_label = :label, 
    //                         disc_genre = :genre, 
    //                         disc_price = :price, 
    //                         artist_id = :artist_id 
    //                     WHERE disc_id = :id';
                        
    //     $updateStatement = $mysqlClient->prepare($updateQuery);
    //     $updateStatement->execute([
    //         'title' => $_POST['title_f'],
    //         'year' => $_POST['year_f'],
    //         'picture' => $picture,
    //         'label' => $_POST['label_f'],
    //         'genre' => $_POST['genre_f'],
    //         'price' => $_POST['price_f'],
    //         'artist_id' => $artist_id,
    //         'id' => $ids
    //     ]);
    // }


} catch (Exception $e) {
    echo 'Une erreur s\'est produite : ' . $e->getMessage();
    exit;
}

header("Location: /Exercices/VelvetRecords/");