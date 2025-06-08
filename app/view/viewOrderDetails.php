<?php
$title = "Détails de la commande #" .htmlspecialchars($order['id']);
ob_start();
?>



<p><strong>Nom de client :</strong> <?= htmlspecialchars($order['first_name']) ?> <?= htmlspecialchars($order['last_name']) ?></p>

<h2>Articles de la commande :</h2>

    <?php
if (!empty($orderItems) ):  // Vérifier que c'est un tableau non vide
    foreach ($orderItems as $item):
?>
        <p>Produit : <?= htmlspecialchars($item['product_name']) ?></p>
        <p>Quantité : <?= htmlspecialchars($item['quantity']) ?></p>
        <p>Prix total : <?= htmlspecialchars($item['quantity'] * $item['price']) ?> TND</p>

    <?php endforeach; ?>
<?php else: ?>
    <p>Aucun article trouvé pour cette commande.</p>
<?php endif; ?>

    </tbody>


 <div style="text-align: center; margin-top: 20px;">
    <a class="btn btn-sm" href="index.php?action=manageOrders" style="background-color: #f5f5dc; color: black; padding: 10px 20px; border: 1px solid #ccc;">Retour à la gestion des commandes</a>
    <a class="btn btn-sm" href="index.php?action=adminDashboard" style="background-color: #f5f5dc; color: black; padding: 10px 20px; border: 1px solid #ccc;">Retour à la page d'admin</a>
</div>


<br>
<?php
$content = ob_get_clean();
require_once('app/view/layout.php');
?>
