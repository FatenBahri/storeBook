    <?php
    $title = "Votre Panier";
    ob_start();

    if (!empty($cart_items)): 
    ?>
        
    
        <?php foreach ($_SESSION['cart'] as $id => $item): ?>
    <div>
        <h3><?php echo htmlspecialchars($item['title'] ?? 'Titre inconnu'); ?></h3>
        <p>Quantité : <?php echo $item['quantity'] ?? 0; ?></p>
        <p>Prix : <?php echo number_format($item['price'] ?? 0, 2) . ' TND'; ?></p>
    </div>
<?php endforeach; ?>
        
        <h3>Total : <?= number_format((new Cart())->getTotalPrice(), 2) ?> TND</h3>
        <button><a class="btn btn-sm" href="index.php?action=showOrderForm">Commander</a></button>

    <?php else: ?>
      <p>Votre panier est vide.</p>
    <?php endif; ?>

    <?php
    $content = ob_get_clean();
    require_once('app/view/layout.php');
    ?>
