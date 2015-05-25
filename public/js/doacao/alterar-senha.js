/**
 * Created by Albo on 11/05/2015.
 */
// responsavel pela geracao da tela alterar senha via ajax

var alterarSenha = {
    aplicarEventos: function () {
       alterarSenha.bindAlterarSenhaForm();
    },
    bindAlterarSenhaForm: function () {
        $('#change-form').submit(function (e) {
            e.preventDefault();
            $.ajax({
                //data: {'filtro': "todos"},
                type: 'POST',
                url:'/user/change-password',
                success: function (data) {
                    $('#conteudo').html(data);
                }
            });
        });
    }
}

$(document).ready(function () {
    alterarSenha.aplicarEventos();
});