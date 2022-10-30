$(document).ready(() => {
    const form = (window.location.pathname.includes("cadastrarUser.php")) ? $("#frm_Usuario") : $("#frm_Empresa");

    $('#btn_Submit').on('click', () => {
        if (validarForm(form.attr('id')))
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

            const url = (window.location.pathname.includes("cadastrarUser.php")) ? "../controller/cadastrarUser.php" : "../controller/cadastrarEmpresa.php";

            $.ajax({
                url,
                type: 'POST',
                data: mainForm,
                processData: false,
                contentType: false
            })
            .done((resultado) => {
                let resposta = JSON.parse(resultado);

                form.parent().css('opacity', '0');
                $('#spn_titulo').css('opacity', '0');

                setTimeout(() => {
                    form.parent().hide();
                    $('#spn_titulo').hide();

                    if(resposta['resultado'] != false && resposta['resultado'] != null)
                    {
                        $('#div_Msg ion-icon').attr('name', 'checkmark-outline');
                        $('#div_Msg span').html('Cadastro realizado com sucesso!');

                        setTimeout(() => {
                            const nextPage = (window.location.pathname.includes("cadastrarUser.php")) ? "login.php" : "index.php";

                            window.location.replace(nextPage)
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