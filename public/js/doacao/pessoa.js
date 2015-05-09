/**
 * Created by Albo on 08/05/2015.
 */

var pessoa = {

    aplicarEventos: function () {
        this.bindFiltroTodos();
        this.bindFiltroMinhas();
    },
    bindFiltroTodos: function (){
        $('#todos').click(function () {

            $.ajax({
                data: {'filtro': "todos"},
                type: 'GET',
                url:'/pessoa/instituicao',
                success: function (data) {
                    var html="";
                    for(var i in data.instituicoes){
                        html +="<div class='col-md-4 col-sm-6'> " +
                        "<form class='formSeguir' method='post'>"+
                        "<input class='instituicaoID' type='hidden' name='id' value='"+data.instituicoes[i].id +"'>" +
                        "<div class='panel panel-default'>"+
                        "<div class='panel-heading'><a href='#' class='pull-right'>Ver mais</a> <h4>"+ data.instituicoes[i].nomeFantasia +"</h4></div>"+
                        "<div class='panel-body'>" +
                        "<p>" + data.instituicoes[i].descricao +
                        "<img src='//placehold.it/150x150' class='img-circle pull-right'> <a href='#'></a></p>"+
                        "<div class='clearfix'></div>"+
                        "<hr>"+
                        "<input type='button' class='btn btn-primary btn-seguir' value='Seguir'>"+
                        "</div>"+
                        "</div>"+
                        "</form>"+
                        "</div>";
                    }
                    //html
                    $('#containerInstituicao').html(html);
                    pessoa.aplicaSeguir();
                }
            });
        });
    },
    bindFiltroMinhas: function () {
        $('#minhas').click(function () {
            $.ajax({
                data: {'filtro': "minhas"},
                type: 'GET',
                url:'/pessoa/instituicao',
                success: function (data) {

                    var html = "";
                    for(var i in data.instituicoes){
                        //console.log(data.instituicoes[i]);
                        html +="<div class='col-md-4 col-sm-6'> " +
                        "<form class='formSeguir' method='post'>"+
                        "<input class='instituicaoID' type='hidden' name='id' value='"+data.instituicoes[i].id +"'>" +
                        "<div class='panel panel-default'>"+
                        "<div class='panel-heading'><a href='#' class='pull-right'>Ver mais</a> <h4>"+ data.instituicoes[i].nomeFantasia +"</h4></div>"+
                        "<div class='panel-body'>" +
                        "<p>" + data.instituicoes[i].descricao +
                        "<img src='//placehold.it/150x150' class='img-circle pull-right'> <a href='#'></a></p>"+
                        "<div class='clearfix'></div>"+
                        "<hr>"+
                        "<input type='button' class='btn btn-danger btn-seguir' value='Parar de Seguir'>"+
                        "</div>"+
                        "</div>"+
                        "</form>"+
                        "</div>";
                    }
                    //html
                    $('#containerInstituicao').html(html);
                    pessoa.aplicaSeguir();

                }
            });


        });
    },
    aplicaSeguir: function (){
        $('.btn-seguir').each(function (index,elemento) {
            $(elemento).attr('id', 'btn-seguir'+index);

            var el = "#"+ $(elemento).attr('id');
            $(el).click(function (e) {
                var idInstituicao = $(el).parents('form').find('input[name="id"]').val();
                console.log(idInstituicao);
                $.ajax({
                    data: {'idInstituicao': idInstituicao},
                    type: 'POST',
                    url:'/pessoa/seguir',
                    success: function (data) {
                        var div = $('#btn-seguir'+index).parents('form').parent();
                        div.fadeOut('1000');
                    }
                });

            });

        });
    }


}


$(document).ready(function () {
    pessoa.aplicarEventos();
    pessoa.aplicaSeguir();
});
