<?php
include_once('../model/usuario.php');

$u = new Usuario();

$user = $u->pesquisarCodigo($_SESSION['cod_user']);
?>

<link rel="stylesheet" href="css/navBar.css" />

<header>
    <nav>
        <a class="nav_logo" href="index.php">EMPRESAS</a>

        <ul class="nav_list">
            <li><a href="index.php">Início</a></li>
            <li><a href="pesquisa.php">Pesquisar</a></li>
            <li><a href="cadastrarEmpresa.php">Cadastrar empresa</a></li>
            <li><a href="../controller/logout.php">Sair</a></li>
        </ul>

        <div class="nav_user">
            <span class="nav_nomeUser"><?= $user['Nome'] ?></span>
            <ion-icon name="person-circle-outline"></ion-icon>
        </div>

        <div class="mobile_menu">
            <div class="line_1"></div>
            <div class="line_2"></div>
            <div class="line_3"></div>
        </div>
    </nav>

    <script src="js/navbar.js"></script>
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</header>