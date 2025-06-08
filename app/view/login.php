<?php
$title = 'Connexion';
ob_start();
?>

    <div class="container mt-5">
        
        <?php if (isset($error)): ?>
            <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
        <?php endif; ?>
        <form method="POST" action="index.php?action=login">
            <div class="mb-3">
                <label for="username" class="form-label">Nom d'utilisateur</label>
                <input type="text" class="form-control" id="username" name="username" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Mot de passe</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <button type="submit" class="btn" style="background-color: #f5f5dc; color: black;">Se connecter</button>
            </form>
    </div>
<?php
$content = ob_get_clean();
require_once('app/view/layout.php');
?>
