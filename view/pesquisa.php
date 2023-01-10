<?php include_once('validarLogin.inc'); ?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pesquisa</title>

    <?php include_once('head.inc'); ?>

    <link rel="stylesheet" href="css/index.css">
    <link rel="stylesheet" href="css/cadastro.css">
    <link rel="stylesheet" href="css/pesquisa.css">
    <link rel="stylesheet" href="css/psqModal.css">
</head>

<body>
    <main>
        <?php include_once('navBar.php') ?>

        <div class="idx_lyt">
            <section id="div_pesquisa">
                <h1 class="psq_tituloPsq">Pesquisa</h1>

                <div class="psq_pesquisaLyt">
                    <div class="psq_iconPsq" id="btn_InptPesquisar"><img src="img/pesq-icon.jpg" alt=""></div>
                    <input class="psq_pesquisa form-control" type="text" name="txt_Pesquisa" id="txt_Pesquisa" placeholder="Pesquise o NOME da empresa (Nike, Adidas, Mizuno...)">
                    <input type="hidden" id="codUser" value="<?= $_SESSION['cod_user'] ?>">
                </div>

                <button type="button" class="idx_button" id="btn_Pesquisar">Pesquisar</button>
            </section>

            <section id="div_resultado">
                <span class="psq_tituloRst">
                    <h2>Você pesquisou pela empresa:</h2>
                    <h1 id="spn_pesquisado"></h1>
                </span>

                <div class="psq_rstBorder">
                    <div class="psq_rstLyt">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Nome</th>
                                    <th scope="col">E-mail</th>
                                    <th scope="col">Telefone</th>
                                    <th scope="col">Proprietário</th>
                                    <th style="text-align: center" scope="col">Alterar</th>
                                    <th style="text-align: center" scope="col">Deletar</th>
                                </tr>
                            </thead>

                            <tbody id="tb_empresas">
                            </tbody>
                        </table>
                    </div>
                </div>

                <button type="button" class="idx_button" id="btn_PsqNovamente">Pesquisar Novamente</button>
            </section>
        </div>

        <div class="modal fade" id="mdl_AltDelete" tabindex="-1" aria-hidden="true" data-tipo="null">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="mdl_lyt">
                        <div class="modal-header">
                            <h5 id="mdl_Titulo" class="mdl_titulo">Teste</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>

                        <section id="div_Load">
                            <div class="spinner-border" role="status">
                                <span class="visually-hidden">Carregando...</span>
                            </div>
                        </section>

                        <section id="div_Content">
                            <span id="spn_msgConfirmacao" class="mdl_msgConfirmacao">Você tem certeza que teste?</span>

                            <span id="mdl_msgDelete" class="mdl_msgDelete">
                                <div>
                                    <span>Código:</span>
                                    <span>Nome:</span>
                                    <span>E-mail:</span>
                                    <span>Telefone:</span>
                                </div>

                                <div>
                                    <span id="spn_CodEmpresa">1</span>
                                    <span id="spn_NomeEmpresa">teste</span>
                                    <span id="spn_EmailEmpresa">email</span>
                                    <span id="spn_TelEmpresa">1190000-0000</span>
                                </div>
                            </span>

                            <span id="mdl_msgAlterar" class="mdl_msgAlterar">
                                <form id="frm_AlterarEmpresa" class="row g-3">
                                    <div class="col-12 cad_campo">
                                        <label for="txt_Codigo" class="form-label">Código da Empresa</label>
                                        <input type="text" style="text-align: center" class="form-control campo" id="txt_Codigo" name="txt_Codigo" placeholder="Código" readonly>
                                    </div>

                                    <div class="col-12 cad_campo">
                                        <label for="txt_NomeEmpresa" class="form-label">Nome da Empresa</label>
                                        <input type="text" class="form-control campo" id="txt_NomeEmpresa" name="txt_NomeEmpresa" placeholder="Nome Empresarial" required>
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
                                        <button type="button" class="idx_button" id="btn_AlterarSubmit">Alterar</button>
                                    </div>
                                </form>
                            </span>

                            <div class="mdl_buttons">
                                <button type="button" id="btn_Nao" class="idx_button psq" data-bs-dismiss="modal">Cancelar</button>
                                <button type="button" id="btn_Sim" class="idx_button psq">Sim</button>
                            </div>
                        </section>

                        <section class="cad_msg" id="div_Msg">
                            <ion-icon name=""></ion-icon>
                            <span></span>
                        </section>
                    </div>
                </div>
            </div>
        </div>
    </main>
</body>

<script src="js/pesquisa.js"></script>

</html>