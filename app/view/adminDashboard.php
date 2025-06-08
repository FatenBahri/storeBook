<?php
// Définir le titre en incluant le nom d'utilisateur
$title = 'Bienvenue, Admin ' . htmlspecialchars($_SESSION['user']['username']);

// Démarrer la mise en mémoire tampon pour le contenu
ob_start();
?>

<nav>
    <ul>
        <li><a href="index.php?action=manageOrders">Gérer les Produits</a></li>
        <li><a href="index.php?action=manageUsers">Gérer les Utilisateurs</a></li>
        <li><a href="index.php?action=showAddBookForm">Ajouter un Livre</a></li> <!-- Nouveau lien ajouté -->

    </ul>
</nav>

<?php
// Récupérer le contenu mis en mémoire tampon
$content = ob_get_clean();

// Inclure le fichier de mise en page principale
require_once('app/view/layout.php');
?>
