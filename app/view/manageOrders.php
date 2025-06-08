<?php
$title = "Gestion des Commandes";
ob_start();
?>


<table border="1" cellpadding="10">
    <thead>
        <tr>
            <th>ID</th>
            <th>Utilisateur</th>
            <th>Date de Commande</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($orders as $order): ?>
        <tr>
            <td><?= htmlspecialchars($order['id']) ?></td>
            <td><?= htmlspecialchars($order['first_name']) ?> <?= htmlspecialchars($order['last_name']) ?></td>
            <td><?= htmlspecialchars($order['created_at']) ?></td>
            <td>
                <a href="index.php?action=viewOrderDetails&id=<?= $order['id'] ?>">Voir Détails</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<div style="text-align: center; margin-top: 20px;">
    <a class="btn btn-sm" href="index.php?action=adminDashboard" style="background-color: #f5f5dc; color: black; padding: 10px 20px; border: 1px solid #ccc;">Retour à la page d'admin</a>
</div><br>
<?php
$content = ob_get_clean();
require_once('app/view/layout.php');
?>
