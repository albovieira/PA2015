/**
 * Created by Albo on 08/05/2015.
 */

var principal = {
    bindAjaxPreloader: function () {
        $(document).bind("ajaxSend", function(){
            $('#preloading').fadeIn('fast');
        }).bind("ajaxComplete", function(){
            $('#preloading').fadeOut('fast');
        });
    },
    ajustaRodape: function () {
            var mFoo = $("footer");
            if ((($(document.body).height() + mFoo.outerHeight()) < $(window).height() && mFoo.css("position") == "fixed") || ($(document.body).height() < $(window).height() && mFoo.css("position") != "fixed")) {
                mFoo.css({ position: "fixed", bottom: "0px" });
            } else {
                mFoo.css({ position: "static" });
            }
    },
    bindAjusteRodape: function () {
        $(window).scroll(principal.ajustaRodape());
        $(window).resize(principal.ajustaRodape());
        $(window).load(principal.ajustaRodape());
    },
    openModalLogin: function () {
        $('#btnLogin').click(function(event) {
            $.ajax({
                type: 'GET',
                url:'/user/login',
                success: function (data) {
                    $('.modal-body').html(data);
                    $('.form-signin').next('a').addClass('btn btn-lg btn-primary btn-block');
                    $(".modal").modal("show");
                }
            });
        });
    },

    //captura get da url
    getURLParam: function(qs){
        qs = qs.split("+").join(" ");
        var params = {},
            tokens,
            re = /[?&]?([^=]+)=([^&]*)/g;

        while (tokens = re.exec(qs)) {
            params[decodeURIComponent(tokens[1])]
                = decodeURIComponent(tokens[2]);
        }

        return params;
    },

    // funcao para callback de insercoes e atualizações
    testeAjaxAviso: function (url) {
        $.ajax({
            type: "GET",
            url: url,

            async: true,
            cache: false,
            timeout:50000,
            global:false,

            success: function(data){
                console.log(data);


                setTimeout(
                    principal.testeAjaxAviso(url),
                    5000
                );
            },
            error: function(data){
                console.log(data)
                setTimeout(
                    principal.testeAjaxAviso(url),
                    15000);
            }
        });
    },
    facebook: function (tipo) {
        $.ajaxSetup({ cache: true });
        $.getScript('//connect.facebook.net/pt_BR/sdk.js', function(){

                FB.init({
                    appId      : '822464164514417',
                    xfbml      : true,
                    version    : 'v2.3'
                });

        });

        if(tipo == 'post'){
            (function(d){
                var js, id = 'facebook-jssdk'; if (d.getElementById(id)) {return;}
                js = d.createElement('script'); js.id = id; js.async = true;
                js.src = "//connect.facebook.net/pt_BR/all.js";
                d.getElementsByTagName('head')[0].appendChild(js);
            }(document));
        }
        if(tipo == 'comentario'){
            (function(d, s, id) {
                var js, fjs = d.getElementsByTagName(s)[0];
                if (d.getElementById(id)) return;
                js = d.createElement(s); js.id = id;
                js.src = "//connect.facebook.net/pt_BR/sdk.js#xfbml=1&version=v2.3&appId=822464164514417";
                fjs.parentNode.insertBefore(js, fjs);
            }(document, 'script', 'facebook-jssdk'));
        }

    },

    //busca do topo do sistema , o ideal e ser uma busca generica, por enquanto implementar busca por instituicao no caso de pessoa
    autocompleteBuscaGenerica: function(){
        $('#busca-generica').autocomplete({
            minLength: 1,
            source: function (request, response) {
                var DTO = { "term": request.term };
                $.ajax({
                    global: false,
                    data: DTO,
                    type: 'GET',
                    url:'/pessoa/busca-generica',
                    success: function (data) {

                        var arrInstituicoes = [];
                        $.each( data, function( key, value ) {
                            //arrInstituicoes.push('<a href="/pessoa/instituicao-page?id=' + value.idInstituicao + '">' +value.nomeFantasia +'</a>');
                            arrInstituicoes.push(value.nomeFantasia);
                        });
                        console.log(response);
                        return response(arrInstituicoes);
                    }
                });
            }
        });
    }

};

$(document).ready(function () {
    principal.bindAjaxPreloader();
    principal.ajustaRodape();
    principal.bindAjusteRodape();
    principal.openModalLogin();
    principal.autocompleteBuscaGenerica()
});
