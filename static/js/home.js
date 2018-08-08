
console.log('home.js');

function deletarRegistro(btn) {
    console.log('btn: ', btn);
    btn = $(btn);
    var mensagem = btn.attr('data-delete-message');
    var url = btn.attr('data-delete-url');

    var modal = $('#modal-delete');
    modal.find('.modal-body').html(mensagem);
    modal.modal({ keyboard: false, show: true });
    modal.find('.btn-sim').on('click', function() { window.location.href = url; });
    modal.find('.btn-nao').on('click', function() { modal.modal('hide'); });
}
/*if( confirm(mensagem)  )
{
   window.location.href = url;
}*/

function trocarCidades() {
    //console.log("trocarCidades");
    var uf = $('#uf').val();
    var selectCidade = $('#cidade');
    selectCidade.val('');
    selectCidade.find('option').hide();
    if (uf) {
        selectCidade.find('option[data-uf=' + uf + ']').show();
    }
}


// Os codigos dentro do ready serão executados somente depois
// que a página carregar todo o html.
$(document).ready(function() {
    $('#uf').on('change', trocarCidades);
    trocarCidades();
});

/**
 * Parametros recebidos pelo option:
 * title,
 * icon,
 * message,
 * type,
 * delay
 */
function exibirAlerta(options) {
    $.notify({
        title: options.title,
        icon: options.icon,
        message: options.message
    }, {
        // settings
        type: options.type,
        delay: options.delay
    });
}