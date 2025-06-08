<!-- app/view/addBookForm.php -->
<?php
$title =" Ajouter un Livre";
ob_start();
?>

<form action="index.php?action=addBook" method="POST" enctype="multipart/form-data">
    <div>
        <label for="title">Titre du livre :</label>
        <input type="text" name="title" id="title" required>
    </div>
    <div>
        <label for="author">Auteur :</label>
        <input type="text" name="author" id="author" required>
    </div>
    <div>
        <label for="description">Description :</label>
        <textarea name="description" id="description" required></textarea>
    </div>
    <div>
        <label for="price">Prix :</label>
        <input type="number" name="price" id="price" step="0.01" required>
    </div>
    <div>
        <label for="stock">Stock :</label>
        <input type="number" name="stock" id="stock" required>
    </div>
    <div>
        <label for="image">Image :</label>
        <input type="file" name="image" id="image" accept="image/*" required>
    </div>
    <input type="submit" value="Ajouter le Livre">
</form>
<?php
$content = ob_get_clean();
require_once('app/view/layout.php');
?>