<?php
$title = 'Passer une Commande';
ob_start();
?>

<h2>Formulaire de Commande Client</h2>
<form action="index.php?action=handleOrder" method="POST">
    <!-- Nom -->
    <label for="first_name">Prénom :</label>
    <input type="text" id="first_name" name="first_name" required><br>

    <!-- Prénom -->
    <label for="last_name">Nom :</label>
    <input type="text" id="last_name" name="last_name" required><br>

    <!-- Adresse -->
    <label for="address">Adresse :</label>
    <input type="text" id="address" name="address" required><br>

    <!-- Téléphone -->
    <label for="phone">Numéro de Téléphone :</label>
    <input type="tel" id="phone" name="phone" pattern="[0-9]{8,12}" placeholder="Ex: 12345678" required><br>

    <!-- Email -->
    <label for="email">Email :</label>
    <input type="email" id="email" name="email" required><br>

    <!-- Bouton de soumission -->
    <button type="submit">Passer la Commande</button>
    
</form>

<?php
$content = ob_get_clean();
require_once('app/view/layout.php');
?>
