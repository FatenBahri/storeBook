
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title; ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="inc/css/style.css" rel="stylesheet">

</head>
<body>
    <?php require "inc/header.php"; ?>
    <div class='container mt-2'>
    <!-- Centrer le titre avec Bootstrap -->
     <br>
    <h3 class="custom-title text-center my-3"><?php echo $title; ?></h3>
    <br>
    <?php echo $content ?>
</div>

    <?php require "inc/footer.php"; ?>
</body>
</html>
