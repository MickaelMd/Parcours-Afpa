<?php require_once __DIR__.'/assets/php/connect.php'; ?>
<?php require_once __DIR__.'/assets/php/header.php'; ?>

<div class="container mt-5">
    <section>
        <div class="container">
            <div class="row justify-content-center">

                <?php 
    
    $disc_list = disc_list();
    foreach ($disc_list as $e):?>

                <div class="col-md-6 d-flex card_index justify-content-center mb-3">
                    <div class="card card_index" style="max-width: 500px;">
                        <div class="row g-0">
                            <div class="col-md-4">
                                <img src="assets/img/pictures/<?= htmlspecialchars($e['disc_picture'])?>"
                                    class="img-fluid img_index w-100" alt="...">
                            </div>
                            <div class="col-md-8">
                                <div class="card-body">
                                    <h5 class="card-title font-title"> <?= htmlspecialchars($e['disc_title']) ?></h5>
                                    <p class="card-text fw-medium"><?= htmlspecialchars($e['artist_name']) ?></p>
                                    <p> Label : <?= htmlspecialchars($e['disc_label']) ?></br>
                                        Year : <?= htmlspecialchars($e['disc_year']) ?></br>
                                        Genre : <?= htmlspecialchars($e['disc_genre']) ?></p>
                                </div>
                                <div class="d-flex justify-content-center mb-3">
                                    <a href="details.php?disc_id=<?= preg_replace('#\s+#', '', htmlspecialchars($e['disc_id'])) ?>"
                                        class="btn btn-primary">Détails</a>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>

            </div>
    </section>

</div>

<?php require_once __DIR__.'/assets/php/footer.php'; ?>