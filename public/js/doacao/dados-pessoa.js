/**
 * Created by Albo on 11/05/2015.
 */
// gera o conteudo para dados pessoa via ajax
var dadosPessoa = {
    aplicarEventos: function () {
       dadosPessoa.bindPessoaForm();
    },
    bindPessoaForm: function () {
        $('#pessoa-form').submit(function (e) {
            e.preventDefault();
            //console.log($('#dados-pessoa').serialize());
            $.ajax({
                data: $('#pessoa-form').serialize(),
                type: 'POST',
                url:'/pessoa/dados-pessoa',
                success: function (retorno) {
                    $('#conteudo').html(retorno);
                }
            });
        })
    }
}

$(document).ready(function () {
    dadosPessoa.aplicarEventos();
});