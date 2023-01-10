<?php include_once("../model/conexao.php") ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>

    <?php include_once('head.inc') ?>

    <link rel="stylesheet" href="css/index.css">
    <link rel="stylesheet" href="css/cadastro.css">
</head>

<body id="pg_login">
    <?php
    $c = new Conexao();
    $conexaoValida = $c->validarConexao();
    ?>

    <?php
    if ($conexaoValida) { ?>
        <script>
            alert('✅ A conexão com o banco de dados foi um sucesso! Faça login para acessar!');
        </script>
    <?php
    } else { ?>
        <script>
            alert('❌ Conexao com o banco de dados falhou, tente acessar mais tarde!');
        </script>
    <?php
    } ?>
    <main>
        <div class="idx_lyt">
            <span id="spn_titulo" class="cad_titulo">Login de Usuário</span>

            <section id="div_Login">
                <form id="frm_Login" class="lgn_login">
                    <div class="cad_campo">
                        <label for="txt_Nome" class="form-label">E-mail</label>
                        <input type="email" class="form-control campo" id="txt_Email" name="txt_Email" placeholder="Insira o endereço de e-mail cadastrado">
                    </div>

                    <div class="cad_campo">
                        <label for="txt_Nome" class="form-label">Senha</label>
                        <input type="password" class="form-control campo" id="txt_Senha" name="txt_Senha" placeholder="Insira a senha cadastrada">
                    </div>

                    <div class="cad_campo">
                        <button type="button" class="idx_button" id="btn_Submit">Enviar</button>
                    </div>

                    <span class="cad_link">Ainda não possui cadastro? Faça-o <a href="cadastrarUser.php">clicando aqui</a></span>
                </form>
            </section>

            <section class="cad_msg" id="div_Msg">
                <ion-icon name=""></ion-icon>
                <span></span>
                <button type="button" class="idx_button" id="btn_Ok">Ok</button>
            </section>
        </div>
    </main>

    <script src="js/login.js"></script>

    <script src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/3/jquery.inputmask.bundle.js"></script>
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>

</html>