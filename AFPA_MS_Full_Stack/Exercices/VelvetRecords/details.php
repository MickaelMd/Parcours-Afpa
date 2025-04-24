<?php require_once __DIR__.'/assets/php/connect.php'; 
 require_once __DIR__.'/assets/php/header.php'; 


$ids = $_GET['disc_id'];

if (!is_numeric($ids) || (int) $ids <= 0) {
    echo '<h1 class="mt-5 text-center">Erreur : ID invalide.</h1>';
    exit;
}

$prt = details_disc((int)$ids);

if (!$prt) {
    echo '<h1 class="mt-5 text-center">Le disc n\'existe pas.</h1>';
    exit;
} 
$artist_list = select_artist();
?>
<div class="container mt-5">
    <section>
        <form action="assets/php/update_script.php" method="POST" enctype="multipart/form-data">
            <input type="text" value="<?= $ids ?>" name="id" class="d-none">
            <div class="mb-3">
                <label for="title_details_f" class="form-label">Title</label>
                <input type="text" name="title_f" class="form-control" id="title_details_f"
                    value="<?= htmlspecialchars($prt['disc_title']) ?>" disabled>
            </div>
            <div class="mb-2" id="artist_details_f">
                <label for="artist_details_f" class="form-label">Artist</label>
                <input type="text" class="form-control" value="<?= htmlspecialchars($prt['artist_name']) ?>" disabled>
            </div>
            <div id="select_artist" class="mb-2" style="display:none;">
                <label for="artist_details_f" class="form-label">Artist</label>
                <select class="form-select" name="artist_f" aria-label="Default select example">
                    <?php 
                    $active_artist = htmlspecialchars($prt['artist_name']);
                    $set_active = '';
                foreach ($artist_list as $select) {
                    $set_active = ($active_artist == $select['artist_name']) ? 'selected' : '';
                    echo '<option' . ' ' . $set_active . ' ' . 'value="'. htmlspecialchars($select['artist_name']) . '">'. htmlspecialchars($select['artist_name']) . '</option>';
                }
                ?>
                </select>
            </div>

            <div class="mb-3">
                <label for="year_details_f" class="form-label">Year</label>
                <input type="text" name="year_f" class="form-control" id="year_details_f"
                    value="<?= htmlspecialchars($prt['disc_year']) ?>" disabled>
            </div>
            <div class="mb-3">
                <label for="genre_details_f" class="form-label">Genre</label>
                <input type="text" name="genre_f" class="form-control" id="genre_details_f"
                    value="<?= htmlspecialchars($prt['disc_genre']) ?>" disabled>
            </div>

            <div class="mb-3">
                <label for="label_details_f" class="form-label">Label</label>
                <input type="text" name="label_f" class="form-control" id="label_details_f"
                    value="<?= htmlspecialchars($prt['disc_label']) ?>" disabled>
            </div>
            <div class="mb-3">
                <label for="price_details_f" class="form-label">Price</label>
                <input type="text" name="price_f" class="form-control" id="price_details_f"
                    value="<?= htmlspecialchars($prt['disc_price']) ?>" disabled>
            </div>
            <label for="picture_details_f" class="form-label">Picture</label> <br>
            <div class="input-group mb-3" id="upload_img" style="display: none;">
                <input type="file" name="picture_f" class="form-control" id="inputGroupFile02" accept="image/*">

            </div>
            <img id="img_show" class="details_img"
                src="assets/img/pictures/<?= htmlspecialchars($prt['disc_picture']) ?>" alt="">
            <br>
            <div class="d-flex">
                <a href="#btn_edit" id="btn_edit" class="btn btn-primary m-2">Modifier</a>

                <button class="btn btn-primary m-2" id="submit_btn" type="submit" style="display: none;">Submit
                    form</button>

                <a href="#delete_submit" id="delete_btn" class="btn btn-primary m-2" id="submit_btn"
                    type="submit">Supprimer</a>
                <a href="assets/php/delete_script.php?id=<?= $ids; ?>" class="btn btn-danger m-2" id="delete_submit"
                    type="submit" style="display: none;">SUPPRIMER
                </a>

                <a href="" class="btn btn-primary m-2">Retour</a>

            </div>
        </form>

    </section>

</div>

<?php require_once __DIR__.'/assets/php/footer.php'; ?>