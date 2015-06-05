

var pessoaMinhaConta = {
    aplicarEventos: function () {
        pessoaMinhaConta.viewPessoa();
        pessoaMinhaConta.bindViewPessoa();
        pessoaMinhaConta.bindViewAlterarSenha();


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
    },

    viewAlterarSenha: function () {
        $.ajax({
            //data: {'filtro': "todos"},
            //type: 'POST',
            url:'/user/change-password',
            success: function (data) {
                $('#conteudo').html(data);
            }
        });
    },
    bindViewAlterarSenha: function () {
        //item da lista
        $('#alteraSenha').click(function () {
            pessoaMinhaConta.viewAlterarSenha();
        });
    }




};

$(document).ready(function () {
    pessoaMinhaConta.aplicarEventos();
});