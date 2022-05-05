<?php include_once('validarLogin.inc') ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bem-vindo!</title>

    <?php include_once('head.inc') ?>

    <link rel="stylesheet" href="css/index.css">
</head>
<body>
    <main>
        <?php include_once('navBar.php') ?>

        <div class="idx_lyt">
            <h1 class="idx_titulo">Bem-vindo <b><?=$user['Nome']?></b>!</h1>
        </div>
    </main>
</body>
</html>