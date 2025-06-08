<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Téléchargement du livre</title>
</head>
<body>
    <h1>Téléchargement et Lecture en ligne</h1>

    <?php if (isset($downloadLink) && isset($onlineReadLink)): ?>
        <p>Pour télécharger :</p>
        <a href="<?= $downloadLink ?>" download>Télécharger le PDF</a><br><br>
        
        <p>Lire en ligne :</p>
        <a href="<?= $onlineReadLink ?>" target="_blank">Lire en ligne</a>
    <?php else: ?>
        <p>Les liens ne sont pas disponibles.</p>
    <?php endif; ?>
</body>
</html>
