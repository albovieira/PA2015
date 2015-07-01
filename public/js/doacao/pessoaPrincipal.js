/**
 * Created by Albo on 08/05/2015.
 */
var pessoaPrincipal = {

    aplicarEventos: function () {
        //this.atualizaPaginaAjax();
        pessoaInstituicao.showConversa();
        this.show('.down-doacao');
        this.show('.down-evento');
        this.show('.down-doacao-finalizada');
    },

    atualizaPaginaAjax: function () {
       // principal.testeAjaxAviso('/pessoa/solicitacao-ajax');
        $.ajax({
            type: "GET",
            url: '/pessoa/solicitacao-ajax',

            async: true,
            cache: false,
            timeout:50000,
            global:false,

            success: function(data){
                console.log(data);
                //$('#conteudo-atualizacao')
                //"<a href='pessoa/instituicao-page?id={$transacao->getInstituicao()->getId()}'><h5><img class='foto-perfil-feed img' src={$transacao->getInstituicao()->getFoto()} /><strong> Instituicao {$transacao->getInstituicao()->getNomeFantasia()} - <span class='text-success'>Doação:{$transacao->getDonativo()->getTitulo()}</span></strong></h5></a>"
                var html = '';
                $.each( data, function( key, value ) {
                    console.log(value);
                    html = '<div class="well">'+(value.nomeFantasia) +
                    '';
                });
                //$('#conteudo-atualizacao').append(html);

                setTimeout(
                    pessoaPrincipal.atualizaPaginaAjax,
                    5000
                );
            },
            error: function(data){
                console.log(data)
                setTimeout(
                    pessoaPrincipal.atualizaPaginaAjax,
                    15000);
            }
        });

    },

    // passar isso para doacao.js
    show: function (elemento) {
        $(elemento).click(function () {
            var div = $(elemento).parent().find('.div-slide');
            if(!div.hasClass('down')){
                $(elemento).children().removeClass('glyphicon glyphicon-plus');
                $(elemento).children().addClass('glyphicon glyphicon-minus');
                div.slideDown();
                div.addClass('down');
            }else{
                $(elemento).children().removeClass('glyphicon glyphicon-minus');
                $(elemento).children().addClass('glyphicon glyphicon-plus');
                div.slideUp();
                div.removeClass('down');
            }
        });
    }
    
};

$(document).ready(function () {
    pessoaPrincipal.aplicarEventos();
});

