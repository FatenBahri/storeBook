<?php
require_once 'app/model/Cart.php';
session_start();

class CartController {
    public function getCartItemCount() {
        $cart = new Cart();
        return $cart->getTotalQuantity();
    }

    public function addToCart() {
        // Vérification de l'ID du livre
        if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
            throw new Exception("ID manquant ou invalide dans l'URL.");
        }
        $book_id = (int) $_GET['id'];
    
        // Ajouter l'article au panier
        $cart = new Cart();
        try {
            $cart->addItem($book_id);
        } catch (Exception $e) {
            // Gérer l'erreur si l'ajout échoue
            echo 'Erreur lors de l\'ajout au panier: ' . $e->getMessage();
            exit();
        }
    
        // Rediriger après ajout
        header("Location: index.php?action=findAllProduct");
        exit();
    }
    
    public function showCart() {
        $cart = new Cart();
        $cart_items = $cart->getItems(); // Récupère les articles du panier
        require 'app/view/AffichagePanierView.php'; // Affiche la vue du panier
    }
    
}
?>
