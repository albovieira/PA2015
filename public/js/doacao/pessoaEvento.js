/**
 * Created by Albo on 11/05/2015.
 */
var pessoaEvento = {
    aplicarEventos: function () {
        this.autocomplete();

    },
    autocomplete: function(){
        $('#buscaPesquisa').autocomplete({

            minLength: 1,
            source: function (request, response) {
                var DTO = { "term": request.term };
                $.ajax({
                    global: false,
                    data: DTO,
                    type: 'GET',
                    url:'/evento/listar-autocomplete-evento',
                    success: function (data) {

                        var arrEventos = [];
                        $.each( data, function( key, value ) {
                            arrEventos.push(value.nomeFantasia);
                        });
                        console.log(arrEventos);
                        return response(arrEventos);
                    }
                });
            }
        });
    }

}

$(document).ready(function () {
    pessoaEvento.aplicarEventos();
});