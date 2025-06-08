<?php




require_once ('app/controler/BookControler.php');
require_once ('app/controler/CartController.php');
require_once ('app/controler/OrderController.php');
require_once ('app/controler/UserController.php');

$userController = new UserController();
$productControler = new ProductControler();
$cartController = new CartController();
$orderController = new OrderController();
// Création d'un routeur simplifié.
if (isset($_GET['action'])) {
$action = $_GET['action'];

switch ($action) {
case 'login':
       $userController->login();
      break;
 case 'logout':
      $userController->logout();
      break; 
  case 'adminDashboard':
      require_once 'app/view/adminDashboard.php';
        break;

case 'findAllProduct':
$productControler->findAllProductAction();
break;
case 'details':
$productControler->DetailsAction();
break;
case 'addProduct':
    $productControler->addProductAction();
    break;
 case 'addToCart':
        $cartController->addToCart();
        break;
case 'showCart':
        $cartController->showCart();
        break;

  case 'telecharger': 
        $productControler->telechargerAction(); // Gérer le téléchargement
        break;
  case 'showOrderForm':
        $orderController->showForm();
         break;     
 case 'handleOrder':
        
      $orderController->handleOrder();
        break;    
case 'manageUsers':
      $userController = new UserController();
      $userController->manageUsers();
      break; 
 case 'manageOrders':
      $orderController = new OrderController();
      $orderController->manageOrders();
      break;
 case 'viewOrderDetails':
      $orderController = new OrderController();
      $orderController->viewOrderDetails();  // Voir les détails d'une commande
      break;  
case 'addBook':
      $productControler->addBook();
            break;
 case 'showAddBookForm':
            $productControler->showAddBookForm();
            break;               
}
} else
$productControler->findAllProductAction();
?>