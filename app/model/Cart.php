<?php
require_once "app/model/Database.php";

class Cart {
    
    protected $pdo;

    public function __construct() {
        $this->pdo = Database::getInstance()->getConnection();

        // Initialisez la session et la connexion PDO
        if (!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = [];
        }

    }

    public function addItem($id, $title = null, $price = null) {
        // Si les détails ne sont pas fournis, les récupérer depuis la base
        if (!$title || !$price) {
            $product = $this->fetchBookFromDatabase($id);
            if ($product) {
                $title = $product['title'];
                $price = $product['price'];
            } else {
                throw new Exception("Produit introuvable.");
            }
        }
    
        // Vérifier que $_SESSION['cart'][$id] est un tableau avant de l'indexer
        if (!isset($_SESSION['cart'][$id])) {
            $_SESSION['cart'][$id] = [
                'title' => $title,
                'price' => $price,
                'quantity' => 0
            ];
        }
    
        // Ajouter ou mettre à jour la quantité du produit dans le panier
        $_SESSION['cart'][$id]['quantity']++;
    }
    
    private function fetchBookFromDatabase($book_id) {
        try {
            $stmt = $this->pdo->prepare("SELECT * FROM book WHERE idBook = :id");
            $stmt->bindParam(':id', $book_id, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Erreur lors de la récupération du livre : " . $e->getMessage();
            return null;
        }
    }

    public function getItems() {
        return $_SESSION['cart'];
    }

    public function getTotalPrice() {
        $total = 0;
        foreach ($_SESSION['cart'] as $item) {
            $total += $item['price'] * $item['quantity'];
        }
        return $total;
    }

    public function getTotalQuantity() {
    // Vérifier que $_SESSION['cart'] est bien un tableau
    if (!is_array($_SESSION['cart'])) {
        $_SESSION['cart'] = [];  // Réinitialiser $_SESSION['cart'] si ce n'est pas un tableau
    }

    $totalQuantity = 0;
    foreach ($_SESSION['cart'] as $item) {
        $totalQuantity += $item['quantity'];
    }
    return $totalQuantity;
}

   
  


}
