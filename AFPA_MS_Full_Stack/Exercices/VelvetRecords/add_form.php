<?php require_once __DIR__.'/assets/php/connect.php'; ?>
<?php require_once __DIR__.'/assets/php/header.php'; ?>

<div class="container mt-5">

    <section>
        <form action="assets/php/add_script.php" method="POST" enctype="multipart/form-data">

            <div class="mb-3">
                <label for="title_details_f" class="form-label">Title</label>
                <input type="text" name="title_f" class="form-control" id="title_details_f">

            </div>

            <div id="select_artist" class="mb-2">
                <label for="artist_details_f" class="form-label">Artist</label>
                <select class="form-select" name="artist_f" aria-label="Default select example">
                    <?php 
                    $artist_list = select_artist();
                foreach ($artist_list as $select) {
                   
                    echo '<option' . ' ' . ' ' . 'value="'. htmlspecialchars($select['artist_id']) . ' ' .  '">'. htmlspecialchars($select['artist_name']) . '</option>';
                }
                ?>
                </select>
            </div>

            <div class="mb-3">
                <label for="year_details_f" class="form-label">Year</label>
                <input type="text" name="year_f" class="form-control" id="year_details_f">
            </div>
            <div class="mb-3">
                <label for="genre_details_f" class="form-label">Genre</label>
                <input type="text" name="genre_f" class="form-control" id="genre_details_f">
            </div>

            <div class="mb-3">
                <label for="label_details_f" class="form-label">Label</label>
                <input type="text" name="label_f" class="form-control" id="label_details_f">
            </div>
            <div class="mb-3">
                <label for="price_details_f" class="form-label">Price</label>
                <input type="text" name="price_f" class="form-control" id="price_details_f">
            </div>
            <label for="picture_details_f" class="form-label">Picture</label> <br>
            <div class="input-group mb-3" id="upload_img">
                <input type="file" name="picture_f" class="form-control" id="inputGroupFile02" accept="image/*">

            </div>
            <img id="img_show" class="details_img" src="" alt="">
            <br>
            <div class="d-flex">
                <button class="btn btn-primary m-2" id="submit_btn" type="submit">Submit
                    form</button>
                <a href="" class="btn btn-primary m-2">Retour</a>
            </div>
        </form>
    </section>

</div>

<?php require_once __DIR__.'/assets/php/footer.php'; ?>