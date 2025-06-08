<!-- app/controller/OrderController.php -->
<?php
require_once __DIR__ . '/../model/Database.php';
require_once __DIR__ . '/../model/OrderModel.php';

class OrderController {
    protected $orderModel;


   
    public function showForm() {
        
        require 'app/view/OrderFormView.php'; // Exemple de vue du panier
    }
    public function handleOrder() {
        $cart = new OrderModel();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            
            $firstName = isset($_POST['first_name']) ? trim(htmlspecialchars($_POST['first_name'])) : null;
            $lastName = isset($_POST['last_name']) ? trim(htmlspecialchars($_POST['last_name'])) : null;
            $address = isset($_POST['address']) ? trim(htmlspecialchars($_POST['address'])) : null;
            $phone = isset($_POST['phone']) ? trim(htmlspecialchars($_POST['phone'])) : null;
            $email = isset($_POST['email']) ? trim(htmlspecialchars($_POST['email'])) : null;
             // Récupérer le panier de la session
           
            if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
                $cartItems = $_SESSION['cart'];
            } else {
                // Si le panier est vide ou non défini, on peut gérer un message ou une redirection vers la page du panier
                echo "Votre panier est vide.";
                return;
            }
            // Vérification des champs
            if ($firstName && $lastName && $address && $phone && $email &&  $cartItems) {
                // Ajouter la commande via le modèle
                $cart->addOrder($firstName, $lastName, $address, $phone, $email, $cartItems);
                setcookie("cart", "", time() - 3600, "/");
                
                if ($cart) {
                    header('Location: app/view/OrderSuccessView.php');
                    exit();
                } else {
                    echo "Erreur : Impossible d'ajouter la commande. Vérifiez votre base de données.";
                }
            } else {
                echo "Erreur : Tous les champs sont obligatoires.";
            }
        } else {
            echo "Méthode non autorisée.";
        }
    }
    // Gérer l'affichage des commandes pour l'admin
    public function manageOrders() {

        $this->orderModel = new OrderModel();
        // Vérifier si l'utilisateur est connecté et admin
        if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
            header("Location: index.php?action=login");
            exit();
        }

        // Récupérer toutes les commandes
        $orders = $this->orderModel->getAllOrders();

        // Afficher la vue pour gérer les commandes
        require_once "app/view/manageOrders.php";
    }
    public function viewOrderDetails() {
        // Vérifier si l'utilisateur est admin
        if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
            header("Location: index.php?action=login");
            exit();
        }
    
        // Vérifier si l'ID de la commande est passé dans l'URL
        if (isset($_GET['id'])) {
            $orderId = $_GET['id'];
    
            // Récupérer les détails de la commande et les articles associés
            $orderModel = new OrderModel();
            $order = $orderModel->getOrderById($orderId);
            $orderItems = $orderModel->getOrderItems($orderId);
    
            // Vérifier si on a bien récupéré un tableau pour $orderItems
            if (is_array($orderItems)) {
                require 'app/view/viewOrderDetails.php'; // Afficher les détails de la commande
            } else {
                // Gérer le cas où $orderItems n'est pas un tableau (erreur)
                echo "Erreur : Aucune donnée trouvée.";
            }
        } else {
            echo "Erreur : ID de commande manquant.";
        }
    }
    
}
?>
