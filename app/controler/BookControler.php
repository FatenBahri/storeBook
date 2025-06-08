<?php 
require_once "app/model/BookModel.php";

class ProductControler {
    private $productModel;

    public function __construct() { 
        $this->productModel = new ProductModel();
    }
    function findAllProductAction(){
          

           $books = $this->productModel->findAllProduct();
           
           $isLoggedIn = isset($_SESSION['user']);
           $cartCount = $isLoggedIn && isset($_SESSION['cart']) ? count($_SESSION['cart']) : 0;

           require_once('app\view\findAllBookView.php');
    }

    
    function DetailsAction() {
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $book = $this->productModel->detailProduct($id);
            require_once('app/view/DetailBookView.php');
        } else {
            header("location: index.php?action=FindAllProduct");
        }
    }
    
    public function telechargerAction() {
        // Vérification de l'ID du livre dans les paramètres GET
        if (!isset($_GET['id'])) {
            echo "Aucun livre spécifié pour le téléchargement.";
            return;
        }
    
        $bookId = htmlspecialchars($_GET['id']); // Sécuriser l'entrée
    
        // Préparez les données pour la vue
        $downloadLink = "inc/download/$bookId.pdf";
        $onlineReadLink = "inc/online/$bookId.html";
    
        // Inclure la vue pour afficher les liens
        require_once 'app/view/downloadView.php';
    }
    
    public function showAddBookForm() {
        require_once 'app/view/addBookForm.php';
    }
      // Gérer l'ajout du livre
    public function addBook() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Vérification de l'authentification de l'utilisateur
            if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
                header("Location: index.php?action=login");
                exit();
            }

            // Récupérer les données du formulaire
            $title = trim($_POST['title']);
            $author = trim($_POST['author']);
            $price = $_POST['price'];
            $description = trim($_POST['description']);
            $stock = $_POST['stock'];
            
            // Vérifier que toutes les données sont présentes
            if ($title && $author && $price && $description && $stock) {
                $bookModel = new ProductModel();
                $result = $bookModel->addBook($title, $author, $price, $description, $stock);

                if ($result) {
                    header("Location: index.php?action=manageBooks"); // Rediriger vers la gestion des livres
                } else {
                    echo "Erreur : Impossible d'ajouter le livre. Veuillez réessayer.";
                }
            } else {
                echo "Erreur : Tous les champs sont obligatoires.";
            }
        } else {
            echo "Méthode non autorisée.";
        }
    }  
    
    
}


