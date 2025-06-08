<?php
require_once "app/model/Database.php";

class OrderModel {
    protected $pdo;

    public function __construct() {
        $this->pdo = Database::getInstance()->getConnection();
    }

    public function addOrder($firstName, $lastName, $address, $phone, $email, $cart_items) {
        try {
            // Commencer une transaction
            $this->pdo->beginTransaction();

            // Insérer les informations de la commande dans la table `orders`
            $query = "INSERT INTO `orders` (first_name, last_name, address, phone, email) 
                      VALUES (:first_name, :last_name, :address, :phone, :email)";
            $stmt = $this->pdo->prepare($query);
            
            // Bind des valeurs
            $stmt->bindParam(":first_name", $firstName);
            $stmt->bindParam(":last_name", $lastName);
            $stmt->bindParam(":address", $address);
            $stmt->bindParam(":phone", $phone);
            $stmt->bindParam(":email", $email);

            $stmt->execute();

            // Récupérer l'ID de la commande
            $orderId = $this->pdo->lastInsertId();

            // Insertion des éléments du panier dans `order_items`
            $queryItems = "INSERT INTO order_items (order_id, product_name, quantity, price) VALUES ";
            $params = [];
            foreach ($cart_items as $item) {
                $queryItems .= "(?, ?, ?, ?),";
                array_push($params, $orderId, $item['title'], $item['quantity'], $item['price']);
            }
            $queryItems = rtrim($queryItems, ','); // Supprime la dernière virgule
            $stmtItems = $this->pdo->prepare($queryItems);
            $stmtItems->execute($params);

            // Valider la transaction
            $this->pdo->commit();
            // Vider le panier après la commande
            unset($_SESSION['cart']); // ou $_SESSION['cart'] = [];
            return true;
        } catch (PDOException $e) {
            // Annuler la transaction en cas d'erreur
            $this->pdo->rollBack();
            echo "Erreur lors de l'ajout de la commande : " . $e->getMessage();
            return false;
        }
    }
    public function getAllOrders() {
        $sql = "SELECT * FROM orders"; // Remplacez 'orders' par le nom de votre table des commandes
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        
        return $stmt->fetchAll(PDO::FETCH_ASSOC); // Retourne toutes les commandes sous forme de tableau associatif
    }
    // Récupérer une commande par son ID
    public function getOrderById($orderId) {
        $sql = "SELECT * FROM orders WHERE id = :id";  // Remplacer 'orders' par le nom de votre table des commandes
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':id', $orderId, PDO::PARAM_INT);
        $stmt->execute();
        
        return $stmt->fetch(PDO::FETCH_ASSOC);  // Retourne la commande sous forme de tableau associatif
    }

    // Récupérer les articles d'une commande
    public function getOrderItems($orderId) {
        $sql = "SELECT * FROM order_items WHERE id = :order_id";  // Remplacer 'order_items' par le nom de votre table des articles de commande
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':order_id', $orderId, PDO::PARAM_INT);
        $stmt->execute();
        
        return $stmt->fetchAll(PDO::FETCH_ASSOC);  // Retourne tous les articles sous forme de tableau associatif
    }
}

?>
