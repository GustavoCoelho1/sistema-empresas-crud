$(document).ready(() => {
    let frmLogin = $('#frm_Login');

    $('#btn_Submit').on('click', () => {
        if(validarForm(frmLogin.attr('id')))
        {
            let mainForm = new FormData();

            $.each($('.campo'), function(idx, campo) {
                mainForm.append(campo.name, campo.value);
            })

            $.ajax({
                url: '../controller/login.php',
                type: 'POST',
                data: mainForm,
                processData: false,
                contentType: false
            })
            .done((resultado) => {
                let resposta = JSON.parse(resultado);

                $('#div_Login').css('opacity', '0');
                $('#spn_titulo').css('opacity', '0');

                setTimeout(() => {
                    $('#div_Login').hide();
                    $('#spn_titulo').hide();
                    $('#btn_Ok').hide();

                    console.log(resposta['teste']);

                    if(resposta['resultado'] != false)
                    {
                        $('#div_Msg ion-icon').attr('name', 'checkmark-outline');
                        $('#div_Msg span').html('Login realizado com sucesso!');

                        setTimeout(() => {
                            window.location.replace("index.php");
                        }, 3000)
                    }
                    else
                    {
                        $('#div_Msg ion-icon').attr('name', 'close-outline');
                        $('#div_Msg span').html('Confira os dados de e-mail e/ou senha!');
                        $('#btn_Ok').show();
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

    $('#btn_Ok').on('click', () => {
        $('#div_Msg').css('opacity', '0')
                    
        setTimeout(() => {
            $.each($('.campo'), function(idx, campo) {
                campo.value = "";
            })

            $("#div_Msg").css('display', 'none');
            $("#div_Login").css('display', 'flex');
            $("#spn_titulo").show();
            $("#spn_titulo").css('opacity', '1');

            setTimeout(() => { $('#div_Login').css('opacity', '1'); }, 300);
        }, 800)
    })
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