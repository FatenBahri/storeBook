<?php 
require_once "app/model/Database.php"; 
class ProductModel {
    protected $pdo;

    public function __construct() { 
        $this->pdo = Database::getInstance()->getConnection();
    }

    function findAllProduct(){
        //selectionner tous les produits avec la class Database
        $req = "SELECT * FROM book";
        $reponse = $this->pdo->query($req);
        $books = $reponse->fetchAll(PDO::FETCH_OBJ);
        return $books;
    }
    function findProduct($id){
        $req = "SELECT * FROM produit WHERE id = :id";
        $requete = $this->pdo->prepare($req);
        $requete->execute(['id' => $id]);
        return ($requete->fetch(PDO::FETCH_OBJ));
    }
    function detailProduct($id) {
        // Code to retrieve details of a specific book
        $query = $this->pdo->prepare("SELECT * FROM book WHERE idBook = :id");
        $query->execute(['id'=>$id]);
        return $query->fetch(PDO::FETCH_OBJ);
    }
    public function addBook() {
        // Vérifier si l'utilisateur est admin
        if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
            header("Location: index.php?action=login");
            exit();
        }

        // Récupérer les données du formulaire
        $title = $_POST['title'];
        $author = $_POST['author'];
        $description = $_POST['description'];
        $price = $_POST['price'];
        $stock = $_POST['stock'];

        // Gestion de l'upload de l'image
        if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
            $uploadDir = 'inc/images/';
            $fileTmpPath = $_FILES['image']['tmp_name'];
            $fileName = $_FILES['image']['name'];
            $fileExtension = pathinfo($fileName, PATHINFO_EXTENSION);
            $newFileName = uniqid('image_', true) . '.' . $fileExtension;
            $destPath = $uploadDir . $newFileName;

            // Déplacer le fichier téléchargé vers le répertoire de destination
            if (move_uploaded_file($fileTmpPath, $destPath)) {
                $query = "INSERT INTO book (title, author, description, price, stock, image) 
                VALUES (:title, :author, :description, :price, :stock, :image)";
      $stmt = $this->pdo->prepare($query);
      $stmt->execute([
          ':title' => $title,
          ':author' => $author,
          ':description' => $description,
          ':price' => $price,
              ':stock' => $stock,
          ':image' => $newFileName
      ]);

      echo "Produit ajouté avec succès.";
      // Rediriger vers une autre page (ex: page de confirmation)
      header("Location: index.php?action=adminDashboard");
      exit;
  } else {
      echo "Erreur lors du déplacement de l'image.";
  }
} else {
  echo "Erreur de téléchargement de l'image.";
}
}

    
    
    
}