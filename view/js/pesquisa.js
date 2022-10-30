$(document).ready(() => {
    $("#txt_Pesquisa").on("keypress", (e) => pesquisar(e));

    $("#btn_Pesquisar").on("click", () => pesquisar());
    $("#btn_InptPesquisar").on("click", () => pesquisar());

    $("#btn_PsqNovamente").on("click", () => psqNovamente());


    $('#mdl_AltDelete').on('hidden.bs.modal', () => {
        $('#mdl_AltDelete').data('tipo', 'null');

        $("#div_Load").css('opacity', '0');
        $("#div_Content").css('opacity', '0');
        $("#div_Msg").css('opacity', '0');

        setTimeout(() => {
            $("#mdl_Titulo b").html('');

            $("#div_Load").hide();
            $("#div_Content").hide();
            $("#div_Msg").hide();
        }, 300);
    })

    $('#btn_AlterarSubmit').on("click", () => {
        let frmAlterar = $('#frm_AlterarEmpresa');

        if (validarForm(frmAlterar.attr('id')))
        {
            $('#mdl_msgAlterar').css('opacity', '0');

            setTimeout(() => {
                $('#mdl_msgAlterar').css('display', 'none');
                
                $('#spn_msgConfirmacao').show();
                $('.mdl_buttons').css('display', 'flex');

                setTimeout(() => {
                    $('#spn_msgConfirmacao').css('opacity', '1');
                    $('.mdl_buttons').css('opacity', '1');
                }, 300);
            }, 800)
        }
        else 
        {
            alert('Preencha todos os campos para prosseguir!')
        }
    })

    $('#btn_Sim').on("click", () => {
        let tipo = $('#mdl_AltDelete').data('tipo');
        
        $("#mdl_Titulo b").css('opacity', '0');

        $('#div_Content').css('opacity', '0');

        setTimeout(() => {
            $('#div_Content').css('display', 'none');
            $("#mdl_Titulo b").html('');

            $("#div_Msg").css('display', 'flex');

            if (tipo == "alterar")
            {
                let mainForm = new FormData();

                $.each($('#mdl_AltDelete .campo'), function(idx, campo) {
                    mainForm.append(campo.name, campo.value);
                })

                $.ajax({
                    url: '../controller/alterarEmp.php',
                    type: 'POST',
                    data: mainForm,
                    processData: false,
                    contentType: false
                })
                .done((resultado) => {
                    let resposta = JSON.parse(resultado);

                    if (resposta['resultado'] == true)
                    {
                        $("#div_Msg ion-icon").attr('name', 'checkmark-outline');
                        $("#div_Msg span").html('Alteração realizada com sucesso!');
                        psqNovamente();
                    }
                    else
                    {
                        $("#div_Msg ion-icon").attr('name', 'close-outline');
                        $("#div_Msg span").html('Houve um erro ao realizar a alteração!');
                    }
                })
            }
            else if (tipo == "deletar")
            {
                let mainForm = new FormData();
                let spnCodUser = $('#spn_CodEmpresa');

                mainForm.append(spnCodUser.attr('id'), spnCodUser.html());

                $.ajax({
                    url: '../controller/deletarEmp.php',
                    type: 'POST',
                    data: mainForm,
                    processData: false,
                    contentType: false
                })
                .done((resultado) => {
                    let resposta = JSON.parse(resultado);

                    if (resposta['resultado'] == true)
                    {
                        $("#div_Msg ion-icon").attr('name', 'checkmark-outline');
                        $("#div_Msg span").html('Exclusão realizada com sucesso!');
                        psqNovamente();
                    }
                    else
                    {
                        $("#div_Msg ion-icon").attr('name', 'close-outline');
                        $("#div_Msg span").html('Houve um erro ao tentar excluir!');
                    }
                })
            }

            setTimeout(() => $("#div_Msg").css('opacity', '1'), 300);
        }, 800);
    })
});

function pesquisar(e)
{
    let txtPesquisaJQ = $("#txt_Pesquisa");

    if (!e || e.code == "Enter")
    {
        if(txtPesquisaJQ.val().length > 0)
        {
            let mainForm = new FormData();

            mainForm.append(txtPesquisaJQ.attr('name'), txtPesquisaJQ.val());
        
            $.ajax({
                url: '../controller/psqEmpresaNome.php',
                type: 'POST',
                data: mainForm,
                processData: false,
                contentType: false
            }).done((resultado) => {
                let pesquisa = JSON.parse(resultado);
                const userCod = $("#codUser").val();

                $('#div_pesquisa').css('opacity', '0');

                setTimeout(() => {
                    $('#div_pesquisa').hide();

                    $('#spn_pesquisado').html(txtPesquisaJQ.val());

                    $('#tb_empresas').html('');
                    $('#tb_empresas').css('display', 'contents');

                    if(pesquisa.length > 0)
                    {
                        pesquisa.forEach(empresa => {
                            const conteudoProprietario = `
                                <tr>
                                    <th>${empresa['Código']}</th>
                                    <td>${empresa['Nome']}</td>
                                    <td>${empresa['Email']}</td>
                                    <td>${empresa['Telefone']}</td>
                                    <td style="text-align: center">${empresa['Proprietário']}</td>
                                    <th><button type="button" class="btn btn-warning btnAlt" data-bs-toggle="modal" data-bs-target="#mdl_AltDelete" data-codigo="${empresa['Código']}">Alterar</button></th>
                                    <th><button type="button" class="btn btn-danger btnDel" data-bs-toggle="modal" data-bs-target="#mdl_AltDelete" data-codigo="${empresa['Código']}">Deletar</button></th>
                                </tr>
                            `;

                            const conteudoNaoProprietario = `
                                <tr>
                                    <th>${empresa['Código']}</th>
                                    <td>${empresa['Nome']}</td>
                                    <td>${empresa['Email']}</td>
                                    <td>${empresa['Telefone']}</td>
                                    <td style="text-align: center">${empresa['Proprietário']}</td>
                                    <th><button type="button" class="btn btn-secondary blockedButton">Alterar</button></th>
                                    <th><button type="button" class="btn btn-secondary blockedButton">Deletar</button></th>
                                </tr>
                            `;

                            (empresa['Proprietário'] == userCod) ? $('#tb_empresas').append(conteudoProprietario) :  $('#tb_empresas').append(conteudoNaoProprietario);
                        });

                        $(".blockedButton").on("click", () => alert("⚠ Atenção: Para modificar uma empresa você deve ser o Proprietário dela!"));

                        $(".btnAlt").on('click', (e) => btnAlterarClick(e));

                        $(".btnDel").on('click', (e) => btnDeletarClick(e));
                    }
                    else
                    {
                        $('#tb_empresas').css('display', 'table-caption');
                        $('#tb_empresas').append('<h1>Sem resultados!</h1>');
                    }

                    $("#div_resultado").css('display', 'flex');
                    
                    setTimeout(() => {$('#div_resultado').css('opacity', '1');}, 300)
                }, 800);
            });
        }
        else
        {
            alert('Insira o nome da empresa antes de pesquisá-la!');
        }
    }
}

function psqNovamente() 
{
    $('#div_resultado').css('opacity', '0')
                    
    setTimeout(() => {
        $("#div_resultado").css('display', 'none');
        $("#div_pesquisa").css('display', 'flex');

        setTimeout(() => { $('#div_pesquisa').css('opacity', '1'); }, 300);
    }, 800)
}

function btnAlterarClick(e) {
    $('#mdl_AltDelete').data('tipo', 'alterar');
    $("#mdl_Titulo").html('Alterar');

    let thisButton = e.target;

    let idEmp = thisButton.getAttribute('data-codigo');

    let mainForm = new FormData();

    mainForm.append('cod_empresa', idEmp);

    $.ajax({
        url: '../controller/psqEmpresaCod.php',
        type: 'POST',
        data: mainForm,
        processData: false,
        contentType: false
    }).done((resultado) => {
        let empresa = JSON.parse(resultado);

        $("#mdl_Titulo").html(`Alterar <b>#${empresa['Código']} ${empresa['Nome']}</b>`);

        $('#div_Load').css('opacity', '0');

        setTimeout(() => {
            $('#div_Load').hide();

            $('#spn_msgConfirmacao').hide();
            $('#mdl_msgDelete').hide();
            $('.mdl_buttons').hide();

            $('#spn_msgConfirmacao').css('opacity', '0');
            $('.mdl_buttons').css('opacity', '0');

            $('#mdl_msgAlterar').css('display', 'flex');
            $('#mdl_msgAlterar').css('opacity', '1');

            $('#txt_Codigo').val(empresa['Código']);
            $('#txt_NomeEmpresa').val(empresa['Nome']);
            $('#txt_EmailEmpresa').val(empresa['Email']);
            $('#txt_Telefone').val(empresa['Telefone']);
            $('#txt_Descricao').val(empresa['Descrição']);

            $('#spn_msgConfirmacao').html(`Você tem certeza que deseja alterar os dados da empresa <b>${empresa['Nome']}</b>?`);

            $('#div_Content').css('display', 'flex');
            setTimeout(() => {$('#div_Content').css('opacity', '1');}, 300);
        }, 800);
    });
}

function btnDeletarClick(e) {
    $('#mdl_AltDelete').data('tipo', 'deletar');
    $("#mdl_Titulo").html('Deletar');

    let thisButton = e.target;

    let idEmp = thisButton.getAttribute('data-codigo');

    let mainForm = new FormData();

    mainForm.append('cod_empresa', idEmp);

    $.ajax({
        url: '../controller/psqEmpresaCod.php',
        type: 'POST',
        data: mainForm,
        processData: false,
        contentType: false
    }).done((resultado) => {
        let empresa = JSON.parse(resultado);

        $("#mdl_Titulo").html(`Deletar <b>#${empresa['Código']} ${empresa['Nome']}</b>`);

        $('#div_Load').css('opacity', '0');

        setTimeout(() => {
            $('#div_Load').hide();

            $('#spn_msgConfirmacao').hide();
            $('#mdl_msgAlterar').hide();

            $('#spn_msgConfirmacao').show();
            $('#spn_msgConfirmacao').css('opacity', '1');

            $('.mdl_buttons').css('display', 'flex');
            $('.mdl_buttons').css('opacity', '1');

            $('#mdl_msgDelete').css('display', 'flex');
            $('#mdl_msgDelete').css('opacity', '1');

            $('#spn_CodEmpresa').html(empresa['Código']);
            $('#spn_NomeEmpresa').html(empresa['Nome']);
            $('#spn_EmailEmpresa').html(empresa['Email']);
            $('#spn_TelEmpresa').html(empresa['Telefone']);

            $('#spn_msgConfirmacao').html(`Você tem certeza que deseja deletar os dados da empresa <b>${empresa['Nome']}</b>?`);

            $('#div_Content').css('display', 'flex');
            setTimeout(() => {$('#div_Content').css('opacity', '1');}, 300);
        }, 800);
    });
}


function validarForm(form) {
    let formCampo = $(`#${form} .campo`);
    let validacao = [];
    
    formCampo.each(function(idx, campo) {
        if (campo.value == "")
        {
            validacao[idx] = false;
        }
        else
        {
            validacao[idx] = true;
        }
    });

    return (validacao.every(campo => campo == true)) ? true : false;
}