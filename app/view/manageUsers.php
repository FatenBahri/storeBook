<?php
$title = "Gestion des Utilisateurs";
ob_start();
?>

<h1>Gestion des Utilisateurs</h1>

<table border="1" cellpadding="10">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nom d'utilisateur</th>
            <th>Email</th>
            <th>Rôle</th>
            
        </tr>
    </thead>
    <tbody>
        <?php foreach ($users as $user): ?>
        <tr>
            <td><?= htmlspecialchars($user['id']) ?></td>
            <td><?= htmlspecialchars($user['username']) ?></td>
            <td><?= htmlspecialchars($user['email']) ?></td>
            <td><?= htmlspecialchars($user['role']) ?></td>
            
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
