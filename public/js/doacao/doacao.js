/**
 * Created by Albo on 08/05/2015.
 */

var principal = {
    bindAjaxPreloader: function () {
        $(document).bind("ajaxSend", function(){
            $('#spinner').fadeIn('fast');
        }).bind("ajaxComplete", function(){
            $('#spinner').fadeOut('fast');

        });
    }
}

$(document).ready(function () {
    principal.bindAjaxPreloader();
});
