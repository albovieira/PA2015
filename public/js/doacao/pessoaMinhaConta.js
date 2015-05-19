

var pessoaMinhaConta = {
    aplicarEventos: function () {
        pessoaMinhaConta.viewPessoa();
        pessoaMinhaConta.bindViewPessoa();
    },
    viewPessoa: function () {
        $.ajax({
                //data: {'filtro': "todos"},
                type: 'POST',
                url:'/pessoa/dados-pessoa',
                success: function (data) {
                    $('#conteudo').html(data);
                }
            });
    },
    bindViewPessoa: function () {
        $('#dadosPessoa').click(function () {
            pessoaMinhaConta.viewPessoa();
        })
    }
}

$(document).ready(function () {
    pessoaMinhaConta.aplicarEventos();
});