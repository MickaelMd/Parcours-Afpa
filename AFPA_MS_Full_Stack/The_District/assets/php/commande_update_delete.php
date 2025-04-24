<?php 

if (isset($_POST["delete_commande"])) {
    
    if (hash_equals($_SESSION['csrf'], $_POST['csrf'])) {
   unset($_SESSION['commande_list']);
   echo "<meta http-equiv='refresh' content='0'>";
}
 else {
    die('Token CSRF invalide');
}
}


if (isset($_POST['update_commande'])) {
    if (hash_equals($_SESSION['csrf'], $_POST['csrf'])) {
    $_SESSION['commande_list'] = [];

    foreach ($commande_list as $quant) {
        $id = $quant['id'];
        $quantite = isset($_POST["quantite$id"]) ? (int) $_POST["quantite$id"] : 0;

        for ($i = 0; $i < $quantite; $i++) {
            $_SESSION['commande_list'][] = $id;
        }
    }
    echo "<meta http-equiv='refresh' content='0'>";

} else {
    die('Token CSRF invalide');
}
}