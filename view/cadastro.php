<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar</title>

    <?php include_once('head.inc'); ?>

    <link rel="stylesheet" href="css/index.css">
    <link rel="stylesheet" href="css/cadastro.css">
</head>
<body id="pg_cadastro">
    <main>
        <div class="idx_lyt">
            <span id="spn_titulo" class="cad_titulo">Cadastrar-se</span>

            <section class="cad_empresa" id="div_Empresa">
                <form id="frm_Empresa" class="row g-3">
                    <div class="col-12 cad_campo">
                        <label for="txt_NomeEmpresa" class="form-label">Nome da Empresa</label>
                        <input type="text" class="form-control campo" id="txt_NomeEmpresa" name="txt_NomeEmpresa" placeholder="Nome Empresarial"required>
                    </div>

                    <div class="col-md-6 cad_campo">
                        <label for="txt_Email" class="form-label">E-mail Empresarial</label>
                        <input type="email" class="form-control campo" id="txt_EmailEmpresa" name="txt_EmailEmpresa" placeholder="Endereço de e-mail empresarial" required>
                    </div>

                    <div class="col-md-6 cad_campo">
                        <label for="txt_Telefone" class="form-label">Telefone Empresarial</label>
                        <input type="text" class="form-control campo" id="txt_Telefone" name="txt_Telefone" placeholder="Telefone Empresarial" maxlength="15" required>
                    </div>

                    <div class="col-12 cad_campo">
                        <label for="txt_Descricao" class="form-label">Descrição da Empresa</label>
                        <textarea class="form-control campo" id="txt_Descricao" name="txt_Descricao" placeholder="Descrição da Empresa" required></textarea>
                    </div>

                    <div class="col-12 cad_campo">
                        <button type="button" class="idx_button" id="btn_Proximo">Próximo</button>
                    </div>
                </form>

                <span class="cad_link">Já possui cadastro? Faça seu login <a href="login.php">clicando aqui</a></span>
            </section>

            <section class="cad_usuario" id="div_Usuario">
                <form id="frm_Usuario" class="row g-3">
                    <div class="col-12 cad_campo">
                        <label for="txt_NomeUser" class="form-label">Nome de Usuário</label>
                        <input type="text" class="form-control campo" id="txt_NomeUser" name="txt_NomeUser" placeholder="Insira um nome de usuário" required>  
                    </div>

                    <div class="col-12 cad_campo">
                        <label for="txt_Email" class="form-label">E-mail de Usuário</label>
                        <input type="email" class="form-control campo" id="txt_EmailUser" name="txt_EmailUser" placeholder="Insira um endereço de e-mail" required>
                    </div>

                    <div class="col-12 cad_campo">
                        <label for="txt_Senha" class="form-label">Senha</label>
                        <input type="password" class="form-control campo" id="txt_Senha" name="txt_Senha" placeholder="Insira uma senha" required>
                    </div>

                    <div class="col-12 cad_campo">
                        <button type="button" class="idx_button" id="btn_Submit">Cadastrar</button>
                    </div>
                </form>
            </section>

            <section class="cad_msg" id="div_Msg">
                <ion-icon name=""></ion-icon>
                <span></span>
            </section> 
        </div>
    </main>

    <script src="js/cadastrar.js"></script>
    <script src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/3/jquery.inputmask.bundle.js"></script>
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>
</html>