<?php
$title = "Book Details";
ob_start();
?>

    <div class='container mt-2'>
        <!-- Book Image -->
        <div class="text-center mb-4">
            <img src="inc/images/<?= $book->image ?>" alt="<?= $book->title ?>" class="img-fluid" style="height: 300px; object-fit: cover;">
        </div>
        
        <!-- Book Details -->
        <div class="text-center">
            <h3 class="custom-title"><?= $book->title ?></h3>
            <p><strong>Author:</strong> <?= $book->author ?></p>
            <p><strong>Price:</strong> <?= number_format($book->price, 2) ?> TND</p>
            <p><strong>Description:</strong> <?= $book->description ?></p>
            <button><a class="btn btn-sm" href="index.php?action=telecharger&id=<?= $book->title ?>" >download or read Book online</a></button>

                
        </div>

        
    </div>
    <?php
$content = ob_get_clean();
require_once('app/view/layout.php');
?>
