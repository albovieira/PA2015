/**
 * Created by Albo on 08/05/2015.
 */
var pessoaPrincipal = {

    aplicarEventos: function () {
        this.atualizaPaginaAjax();
        pessoaInstituicao.showConversa();
    },

    atualizaPaginaAjax: function () {
        principal.testeAjaxAviso('/pessoa/solicitacao-ajax');
    }
    
}

$(document).ready(function () {
    pessoaPrincipal.aplicarEventos();
});

