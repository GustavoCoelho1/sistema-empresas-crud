$(document).ready(() => {
    let frmUser = $("#frm_Usuario");
    let frmEmpresa = $("#frm_Empresa");

    $('#btn_Proximo').on('click', () => {
        if (validarForm(frmEmpresa.attr('id')))
        {
            $('#div_Empresa').css('opacity', '0');

            setTimeout(() => {
                $('#div_Empresa').hide();
                $('#div_Usuario').css('display', 'flex');
                setTimeout(() => {$('#div_Usuario').css('opacity', '1');}, 300)
            }, 800);
        }
        else
        {
            alert('Preencha todos os campos para prosseguir!');
        }
    });

    $('#btn_Submit').on('click', () => {
        if (validarForm(frmUser.attr('id')))
        {
            $('#btn_Submit').html(`
                <div class="spinner-border text-light" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>
            `)

            $('#btn_Submit').attr('disabled', 'disabled');

            let mainForm = new FormData();

            $.each($('.campo'), function(idx, campo) {
                mainForm.append(campo.name, campo.value);
            })

            $.ajax({
                url: '../controller/cadastrar.php',
                type: 'POST',
                data: mainForm,
                processData: false,
                contentType: false
            })
            .done((resultado) => {
                let resposta = JSON.parse(resultado);

                $('#div_Usuario').css('opacity', '0');
                $('#spn_titulo').css('opacity', '0');

                setTimeout(() => {
                    $('#div_Usuario').hide();
                    $('#spn_titulo').hide();

                    if(resposta['resultado'] != false && resposta['resultado'] != null)
                    {
                        $('#div_Msg ion-icon').attr('name', 'checkmark-outline');
                        $('#div_Msg span').html('Cadastro realizado com sucesso!');

                        setTimeout(() => {
                            window.location.replace("login.php");
                        }, 3000)
                    }
                    else
                    {
                        $('#div_Msg ion-icon').attr('name', 'close-outline');
                        $('#div_Msg span').html('Houve um erro ao realizar o cadastro!');
                    }

                    $('#div_Msg').css('display', 'flex');
                    setTimeout(() => {$('#div_Msg').css('opacity', '1');}, 300)
                }, 800);
            });
        }
        else
        {
            alert('Preencha todos os campos para prosseguir!');
        }
    });

    $(":input").inputmask();

    $("#txt_Telefone").inputmask({"mask": "(99) 99999-9999"});
})

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