<?php
require_once 'app/model/Cart.php';

$cart = new Cart();
$totalItems = $cart->getTotalQuantity();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bookie</title>
    <!-- Bootstrap CSS -->

    
</head>
<body>
    <!-- Barre de navigation -->
    <nav class="navbar navbar-expand-lg navbar-custom px-4">
        <a class="navbar-brand d-flex align-items-center" href="#">
            <img src="inc/images/book-shop.png" alt="Logo" class="d-inline-block align-text-top">
            <span>Bookie</span>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="index.php?action=findAllProduct">Books</a>

                </li>
                
                <li class="nav-item">
                </li>
            </ul>
            <!-- Icône de panier -->
            <a href="index.php?action=showCart" class="position-relative">
    <i class="bi bi-cart-fill" style="font-size: 1.6rem;"></i>
    <span class="position-absolute top-0 start-20 translate-middle badge rounded-pill bg-danger">
        <?php
        // Vérifier si l'utilisateur est un admin
        if (isset($_SESSION['user']) && $_SESSION['user']['role'] === 'admin') {
            echo 0;  // Afficher 0 pour l'admin
        } else {
            // Afficher le nombre d'articles dans le panier pour les autres utilisateurs
            echo isset($_SESSION['cart']) ? count($_SESSION['cart']) : 0;
        }
        ?>
    </span>
</a>

            <!-- Boutons Login / Sign-up -->
            <div class="d-flex">
            <?php if (isset($_SESSION['user']) && $_SESSION['user']['role'] === 'admin'): ?>
    <a class="btn btn-blue-pink" href="index.php?action=adminDashboard">admin</a>
<?php else: ?>
    <a class="btn btn-blue-pink" href="index.php?action=findAllProduct">
        <?= isset($_COOKIE['username']) ? htmlspecialchars($_COOKIE['username']) : 'Login' ?>
    </a>
<?php endif; ?>

            <a class="btn btn-blue-pink" href="index.php?action=logout">logout</a>
        </div>
        </div>
    </nav>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
