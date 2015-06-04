

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
    },

    bindTabEndereco: function () {
        $('#btn-busca-cep').click(function (e) {
            e.preventDefault();
            $.ajax({
                type: 'GET',
                data: '',
                url:'http://cep.correiocontrol.com.br/' + $('#cep').val() + '.json',
                success: function (data) {
                    $('#rua').val(data.logradouro);
                    $('#bairro').val(data.bairro);
                    $('#estado').val(data.uf);
                    $('#cidade').val(data.localidade);
                }
            });
        });
    }


};

$(document).ready(function () {
    pessoaMinhaConta.aplicarEventos();
});