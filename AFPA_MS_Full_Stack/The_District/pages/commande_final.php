<?php 

require_once __DIR__.'/../assets/php/connect.php';
require_once __DIR__.'/../assets/php/head.php'; 
// require_once __DIR__.'/../assets/php/commande_verif.php'; 

if (count($_SESSION['commande_list']) <= 0) {

    header('Location: commande.php');
    
         } 
?>

<body>
    <div class="container">
        <?php 
        require_once __DIR__.'/../assets/php/header.php'; ?>

        <section class="mt-5">
            <h1>Récapitulatif de votre commande :</h1>
            <table class="table table-bordered table-striped mt-3">
                <thead>
                    <tr>
                        <th>Image</th>
                        <th>Libellé</th>
                        <th>Description</th>
                        <th>Prix</th>
                        <th>Quantité</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($commande_list as $platLs):
                $libelle = htmlspecialchars($platLs['libelle'], ENT_QUOTES, 'UTF-8');
                $image = htmlspecialchars($platLs['image'], ENT_QUOTES, 'UTF-8');
                $prix = (float) htmlspecialchars($platLs['prix'], ENT_QUOTES, 'UTF-8');
                $description = htmlspecialchars($platLs['description'], ENT_QUOTES, 'UTF-8');
                
                if (strlen($description) > 200) {
                    $description = substr($description, 0, 200) . '...';
                }
                
                $quantite = isset($quantites[$platLs['id']]) ? $quantites[$platLs['id']] : 0;
            ?>
                    <tr>
                        <td><img src="../assets/img/food/<?= $image ?>" alt="<?= $libelle ?>"
                                style="height: 100px; width: auto; object-fit: cover;"></td>
                        <td><?= $libelle ?></td>
                        <td><?= $description ?></td>
                        <td><?= number_format($prix, 2) ?>€</td>
                        <td><?= $quantite ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </section>

        <!-- -------------- -->

        <section id="contact_form_section">
            <div id="form_contact" class="container"></div>
            <form id="contactForm" action="" method="POST">
                <input type="hidden" name="csrf" value="<?= htmlspecialchars($_SESSION['csrf']) ?>">

                <div class="row mb-3 mt-3">
                    <div class="col-md-6">
                        <label class="form-label" for="nom">Nom</label>
                        <input type="text" class="form-control" id="nom" name="nom" required
                            value="<?= isset($_SESSION['nom']) ? htmlspecialchars($_SESSION['nom']) : '' ?>"
                            <?= isset($_SESSION['nom']) ? 'readonly' : '' ?> />
                        <span id="error-nom" class="text-danger"></span>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label" for="prenom">Prenom</label>
                        <input type="text" class="form-control" id="prenom" name="prenom" required
                            value="<?= isset($_SESSION['prenom']) ? htmlspecialchars($_SESSION['prenom']) : '' ?>"
                            <?= isset($_SESSION['prenom']) ? 'readonly' : '' ?> />
                        <span id="error-prenom" class="text-danger"></span>
                    </div>
                </div>

                <div class="row mb-3 mt-3">
                    <div class="col-md-6">
                        <label class="form-label" for="email">Email</label>
                        <input type="email" class="form-control" id="email" name="email" required
                            value="<?= isset($_SESSION['email']) ? htmlspecialchars($_SESSION['email']) : '' ?>"
                            <?= isset($_SESSION['email']) ? 'readonly' : '' ?> />
                        <span id="error-email" class="text-danger"></span>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label" for="telephone">Téléphone</label>
                        <input type="text" class="form-control" id="telephone" name="telephone" required
                            value="<?= isset($_SESSION['telephone']) ? htmlspecialchars($_SESSION['telephone']) : '' ?>"
                            <?= isset($_SESSION['telephone']) ? 'readonly' : '' ?> />
                        <span id="error-telephone" class="text-danger"></span>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="sign_adresse" class="form-label">Adresse</label>
                    <input type="text" class="form-control" id="sign_adresse" name="sign_adresse"
                        value="<?= isset($_SESSION['adresse']) ? htmlspecialchars($_SESSION['adresse']) : '' ?>">
                    <span id="error-sign_adresse" class="text-danger"></span>
                </div>

                <div class="d-flex justify-content-center m-5">
                    <input class="btn btn-lg btn-info m-2" type="submit" name="submit_mail" value="Envoyer" />
                </div>
            </form>
        </section>


    </div>

    <?php require_once __DIR__.'/../assets/php/footer.php'; ?>

</body>

</html>

<?php require_once __DIR__.'/../assets/php/mail_commande.php';