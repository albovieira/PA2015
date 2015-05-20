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
            $.get("/user/login", function(data) {
                $('.modal-body').html(data);
                $('.form-signin').next('a').addClass('btn btn-lg btn-primary btn-block');
            });
        });

    }
}

$(document).ready(function () {
    principal.bindAjaxPreloader();

    principal.ajustaRodape();
    principal.bindAjusteRodape();
    principal.openModalLogin();
});
