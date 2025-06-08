<?php
$title = 'Liste des books';
ob_start();
?>
<div class="container">
    <div class="row">
        <?php foreach ($books as $p): ?>
            <div class="col-md-3 text-center mb-4">
                <!-- Image du livre -->
                <img src="inc/images/<?= $p->image ?>" alt="<?= $p->title ?>" class="img-fluid" style="height: 300px; object-fit: cover;">
                <!-- Titre du livre -->
                <h5 class="mt-2"><?= $p->title ?></h5>
                <!-- Auteur -->
                <p><strong><?= $p->author ?></strong></p>
                <!-- Prix -->
                <p><?= number_format($p->price, 2) ?> TND</p>
                <!-- Liens vers les actions -->
                <div>
                <a href="index.php?action=details&id=<?= $p->idBook ?>" class="btn btn-sm" style="background-color: beige; color: black; border-color: beige;">Details</a>
                <a href="index.php?action=addToCart&id=<?= $p->idBook ?>" class="btn btn-sm" style="background-color: beige; color: black; border-color: beige;">Add</a>

                </div>
            </div>
        <?php endforeach; ?>
    </div>
   
</div>
<?php
$content = ob_get_clean();
require_once('app/view/layout.php');
?>
