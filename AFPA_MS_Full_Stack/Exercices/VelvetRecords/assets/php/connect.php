<?php

session_start();
date_default_timezone_set('Europe/Paris');

require_once __DIR__.'/../../vendor/autoload.php';

use Dotenv\Dotenv;

define('BASE_URL', '/exercices/VelvetRecords/');

try {
     $dotenv = Dotenv::createImmutable(__DIR__.'/../../../../../'); // Chemin vers le .env en dehors de du projet <---
   // $dotenv = Dotenv::createImmutable(__DIR__.'/../../../../'); // .env dans le main projet <---
    $dotenv->load();

    $dsn = 'mysql:host='.$_ENV['DB_HOST'].';dbname='.$_ENV['DB_NAME_EXO_CRUB'].';charset='.$_ENV['DB_CHARSET'];
    $username = $_ENV['DB_USER'];
    $password = $_ENV['DB_PASSWORD'];

    $mysqlClient = new PDO($dsn, $username, $password);
} catch (Exception $e) {
    echo '<h1>Erreur : Configurer le fichier connect.php dans /assets/php et le .env, et utilisez MariaDB.</h1>';
    exit('Erreur : '.$e->getMessage());
}

function disc_list() {
        
    global $mysqlClient;
    $sqlQueryy = "SELECT * FROM artist JOIN disc ON disc.artist_id = artist.artist_id";
    $Statement = $mysqlClient->prepare($sqlQueryy);
    $Statement->execute();
    $disc_list = $Statement->fetchAll();

    return $disc_list;

}
function details_disc($id) {
    global $mysqlClient;
    $sqlQueryy = "SELECT * FROM artist JOIN disc ON disc.artist_id = artist.artist_id WHERE disc_id = :id";
    $Statement = $mysqlClient->prepare($sqlQueryy);
    $Statement->bindParam(':id', $id, PDO::PARAM_INT);
    $Statement->execute();
    $disc = $Statement->fetch();

    return $disc;
}

function delete_disc($id) {
    global $mysqlClient;
    $sqlQuery = "DELETE FROM disc WHERE disc_id = :id";
    $Statement = $mysqlClient->prepare($sqlQuery);
    $Statement->bindParam(':id', $id, PDO::PARAM_INT);
    $Statement->execute();

}

function select_artist() {
    global $mysqlClient;
    $sqlQueryy = "SELECT artist_name, artist_id FROM artist";
    $Statement = $mysqlClient->prepare($sqlQueryy);
    $Statement->execute();
    $artist_list = $Statement->fetchAll();

    return $artist_list;

}

function artist_id($name) {

    global $mysqlClient;
    $sqlQuery = "SELECT artist_id FROM artist WHERE artist_name = :name";
    $Statement = $mysqlClient->prepare($sqlQuery);
    $Statement->execute(['name' => $name]);

    $artist_id = $Statement->fetch();

    return $artist_id;
}

function update_disc($ids, $artist_id, $picture) {

    global $mysqlClient;
    $updateQuery = 'UPDATE disc 
                    SET disc_title = :title, 
                        disc_year = :year, 
                        disc_picture = :picture, 
                        disc_label = :label, 
                        disc_genre = :genre, 
                        disc_price = :price, 
                        artist_id = :artist_id 
                    WHERE disc_id = :id';
                    
    $updateStatement = $mysqlClient->prepare($updateQuery);
    $updateStatement->execute([
        'title' => $_POST['title_f'],
        'year' => $_POST['year_f'],
        'picture' => $picture,
        'label' => $_POST['label_f'],
        'genre' => $_POST['genre_f'],
        'price' => $_POST['price_f'],
        'artist_id' => $artist_id,
        'id' => $ids
    ]);
}

function upload_image($file) {
   
    if ($file['error'] !== UPLOAD_ERR_OK) {
        return null; 
    }

    $check = getimagesize($file["tmp_name"]);
    if ($check === false) {
        return null; 
    }

    $targetDir = __DIR__ . '/../img/pictures/'; 
    $targetFile = $targetDir . basename($file["name"]);
    $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

    if (file_exists($targetFile)) {
        return null; 
    }

    if ($file["size"] > 5000000) {
        return null; 
    }

    if (!in_array($imageFileType, ['jpg', 'jpeg', 'png', 'gif'])) {
        return null;
    }

    if (move_uploaded_file($file["tmp_name"], $targetFile)) {
        return basename($file["name"]); 
    } else {
        return null; 
    }
}

function add_disc($picture) { 
    global $mysqlClient;

    $sqlQuery = 'INSERT INTO disc(disc_title, disc_year, disc_picture, disc_label, disc_genre, disc_price, artist_id) 
                 VALUES (:title, :year, :picture, :label, :genre, :price, :artist_id)';
    $insertQuery = $mysqlClient->prepare($sqlQuery);
    $insertQuery->execute([
        'title' => $_POST['title_f'],
        'year' => $_POST['year_f'],
        'picture' => $picture,
        'label' => $_POST['label_f'],
        'genre' => $_POST['genre_f'],
        'price' => $_POST['price_f'],
        'artist_id' => $_POST['artist_f']
        
    ]);

}