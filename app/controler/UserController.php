<?php
require_once "app/model/UserModel.php";

class UserController {
    protected $userModel;

    public function __construct() {
        $this->userModel = new UserModel();
    }

    public function login() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST['username'] ?? '';
            $password = $_POST['password'] ?? '';
    
            if (empty($username) || empty($password)) {
                $error = "Veuillez remplir tous les champs.";
                require_once "app/view/login.php";
                return;
            }
    
            $user = $this->userModel->getUserByUsername($username);
    
            if ($user && $password === $user['password']) { // Utilisation de password_verify pour plus de sécurité
                // Initialiser la session
                session_start();
                $_SESSION['user'] = [
                    'id' => $user['id'],
                    'username' => $user['username'],
                    'role' => $user['role']
                ];
                setcookie("username", $user['username'], time() + (7 * 24 * 60 * 60), "/");

                // Charger le panier de l'utilisateur
               // require_once 'app/controler/CartController.php';  // Inclure CartController
                //$cartController = new CartController();
                ///$cartItems = $cartController->getCartItemCount();  // ou une autre méthode pour récupérer les articles
                ///$_SESSION['cart'] = $cartItems;
                // Charger le panier depuis les cookies
                if (isset($_COOKIE['cart'])) {
                    $_SESSION['cart'] = json_decode($_COOKIE['cart'], true);
                } else {
                    $_SESSION['cart'] = []; // Créer un panier vide si aucun cookie n'existe
                }
                if ($user['role'] === 'admin') {
                    header("Location: index.php?action=adminDashboard");
                } else {
                    header("Location: index.php?action=findAllProduct");
                }
                exit();
            } else {
                $error = "Nom d'utilisateur ou mot de passe incorrect.";
                require_once "app/view/login.php";
            }
        } else {
            require_once "app/view/login.php";
        }
    }
    
    public function manageUsers() {
        
        if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
            header("Location: index.php?action=login");
            exit();
        }
    
        // Récupérer les utilisateurs de la base de données
        $users = $this->userModel->getAllUsers();
    
        // Inclure la vue pour gérer les utilisateurs
        require_once "app/view/manageUsers.php";
    }
    
    

    public function logout() {
        session_start();
        
        // Sauvegarder le panier dans un cookie avant de supprimer la session
        if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
            setcookie('cart', json_encode($_SESSION['cart']), time() + (3600 * 24 * 7), "/"); // Cookie valable 7 jours
            setcookie("username", "", time() - 3600, "/");

        }

        
        // Optionnel : Supprimer la session complète si nécessaire
         session_destroy();

        // Rediriger l'utilisateur vers la page de connexion
        header("Location: index.php?action=login");
        exit();
    }
}
    

?>
