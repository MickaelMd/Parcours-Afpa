<?php require_once __DIR__.'/assets/php/connect.php';
if (!isset($_SESSION['login'])) {
    echo '<br>Page refusée !';
    header('Location: /assets/php/login.php');
    exit;
}

$user = $_SESSION['login'];

$sqlQuery = "SELECT * FROM `note` WHERE active = 1 AND user = '$user' ORDER BY time DESC";
$noteStatement = $mysqlClient->prepare($sqlQuery);
$noteStatement->execute();
$note = $noteStatement->fetchAll();

if (isset($_POST['note_delete'])) {
    $id_note = (int) $_POST['note_delete'];
    echo $id_note;

    $updateQuery = 'UPDATE `note` SET active = :active WHERE id = :id AND user = :user';
    $updateStatement = $mysqlClient->prepare($updateQuery);
    $updateStatement->execute([
        'active' => 0,
        'id' => $id_note,
        'user' => $user,
    ]);
    echo "<meta http-equiv='refresh' content='0'>";
}

?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300..800;1,300..800&family=Playwrite+DE+Grund:wght@100..400&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="/assets/css/style.css">
    <title>Bloc Note PHP</title>
</head>

<body>
    <nav>
        <div id="btn_right">
            <a href="/assets/php/logout.php"> <button class="font_title">Déconnexion</button></a>
        </div>
    </nav>
    <section id="note_section">
        <form action="" method="post" id="form_newnote">
            <h2 class="font_title">Nouvelle note</h2>
            <input type="text" placeholder="Titre de la note" name="title_newnote" id="title_newnote" required> </br>
            <?php
                                if (isset($_POST['btn_newnote'])) {
                                    if (strlen($_POST['newnote']) < 0) {
                                        echo '<h3 class="error_title">Le titre est invalide </h3>';
                                        $verif_title_newnote = 0;
                                    } else {
                                        $verif_title_newnote = 1;
                                    }
                                }?>
            <textarea name="newnote" id="newnote" cols="30" rows="10" required></textarea> </br>

            <?php
            $testtest = 'jdizaodj dza';
if (isset($_POST['btn_newnote'])) {
    if (empty($_POST['newnote']) && trim($_POST['newnote']) === '') {
        echo '<h3 class="error_title">La note est invalide</h3>';
        $verif_newnote = 0;
    }
    if (strlen($_POST['newnote']) > 16000000000) {
        echo '<h3 class="error_title">La note est trop longue </br>(max 16000000000 caractéres, actuellement : '.strlen($_POST['newnote']).')</h3>';
        $verif_newnote = 0;
    } else {
        $verif_newnote = 1;
    }
}?>
            <button type="submit" name="btn_newnote" id="btn_newnote">Enregistré</button>
        </form>
        <?php if (isset($_POST['btn_newnote'])) {
            if ($verif_newnote > 0 && $verif_title_newnote > 0) {
                $sqlQuery = 'INSERT INTO note (user, name, note) VALUES (:user, :name, :note)';
                $insertmdp = $mysqlClient->prepare($sqlQuery);
                $insertmdp->execute([
                    'user' => $_SESSION['login'],
                    'name' => $_POST['title_newnote'],
                    'note' => $_POST['newnote'],
                ]);
                echo "<meta http-equiv='refresh' content='0'>";
            }
        }?>
    </section>
    <section id="note_section_show">
        <?php
foreach ($note as $notes) {
    $id_note = $notes['id'];

    echo '
    
         <div class="note_box">
            <div class="text_note">

                <h4>'.htmlspecialchars($notes['name']).'</h4>
                <p class="note_date">'.$notes['time'].'</p>
                <p>'.nl2br(htmlspecialchars($notes['note'])).'</p>
            </div>
                <form class="form_delete" action="" method="post">
            <button class="btn_delete" type="submit" name="note_delete" value="'.$id_note.'">Supprimer</button>
            </form>
        </div>
    
    ';

    // echo nl2br(htmlspecialchars($post['content'])); -- nl2br pour un retour a la ligne, remplacement du regex
    // <p>'.preg_replace("/(\r\n|\n|\r)/", '<br>', htmlspecialchars($notes['note'])).' </p>
}
?>

    </section>
</body>

</html>