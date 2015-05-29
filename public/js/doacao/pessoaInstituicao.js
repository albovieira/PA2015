/**
 * Created by Albo on 08/05/2015.
 */
var pessoaInstituicao = {

    aplicarEventos: function () {
        this.bindFiltroTodos();
        this.bindFiltroMinhas();
        this.autocomplete();
        this.bindClickBuscaInstituicao();
        this.instituicaoVerMais();
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
                        "<div class='panel-heading'><a href='/pessoa/instituicao-page?id="+data.instituicoes[i].id + "' class='pull-right'>Ver mais</a> <h4>"+ data.instituicoes[i].nomeFantasia +"</h4></div>"+
                        "<div class='panel-body'>" +
                        "<p>" + data.instituicoes[i].descricao +
                        "<img src="+ data.instituicoes[i].foto + " class='img-circle pull-right img-profile'> <a href='#'></a></p>"+
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
                    pessoaInstituicao.aplicaSeguir();
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
                        "<div class='panel-heading'><a href='/pessoa/instituicao-page?id="+data.instituicoes[i].id + "' class='pull-right'>Ver mais</a> <h4>"+ data.instituicoes[i].nomeFantasia +"</h4></div>"+
                        "<div class='panel-body'>" +
                        "<p>" + data.instituicoes[i].descricao +
                        "<img src="+ data.instituicoes[i].foto + " class='img-circle pull-right img-profile'> <a href='#'></a></p>"+
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
                    pessoaInstituicao.aplicaSeguir();

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
                    url:'/pessoa/listar-autocomplete-instituicao',
                    success: function (data) {

                        var arrInstituicoes = [];
                        $.each( data, function( key, value ) {
                            arrInstituicoes.push(value.nomeFantasia);
                        });
                        return response(arrInstituicoes);
                    }
                });
            }
        });
    },

    bindClickBuscaInstituicao: function () {
        $('#pesquisar').submit(function (event) {
            event.preventDefault();
            var desc = {'descricao' : $('#buscaPesquisa').val()};
            $.ajax({
                data: desc,
                type: 'GET',
                url:'/pessoa/pesquisar-instituicao',
                success: function (data) {
                    console.log(data);
                    //return response(data);
                    var html = "";

                    for(var i in data.instituicoes){

                        html +="<div class='col-md-4 col-sm-6'> " +
                        "<form class='formSeguir' method='post'>"+
                        "<input class='instituicaoID' type='hidden' name='id' value='"+data.instituicoes[i].id +"'>" +
                        "<div class='panel panel-default'>"+
                        "<div class='panel-heading'><a href='#' class='pull-right'>Ver mais</a> <h4>"+ data.instituicoes[i].nomeFantasia +"</h4></div>"+
                        "<div class='panel-body'>" +
                        "<p>" + data.instituicoes[i].descricao +
                        "<img src="+data.instituicoes[i].foto +  " class='img-circle pull-right img-profile'> <a href='#'></a></p>"+
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
                    pessoaInstituicao.aplicaSeguir();



                }
            });


        });

    },
    
    limpaModal: function () {
        
    },

    instituicaoVerMais: function(){
        //captura paramentro da url
        var $_GET = principal.getURLParam(document.location.search);

        var idInstituicao = {'id' : $_GET};
        $.ajax({
            data: idInstituicao,
            type: 'GET',
            url:'/donativo/get-donativos',
            success: function (data) {
                var html = '';

                if(data.length > 0){
                    $.each( data, function( key, donativo) {

                            html += "" +
                                "<div class='col-xs-12'>" +
                                "<div class='list-group'>" +
                                "<a href='#' class='list-group-item '>" +
                                "<h4 class='list-group-item-heading'>"+donativo.titulo+"</h4>" +
                                "<p class='list-group-item-text'>"+ donativo.descricao+"</p><br>" +
                                "<p class='list-group-item-text'><strong>Doação disponivel até: "+ donativo.dataDesa +"<strong></strong></p><br>" +
                                "<button class='btn btn-primary'>Doar</button>" +
                                "</a>" +
                                "</div>" +
                                "</div>";
                        });
                }
                else{
                    html = "<div class='col-xs-12'>" +
                    "<div class='list-group'>" +
                    "<p class='list-group-item '>" +
                     "Não há donativos cadastrados" +
                    "</p>" +
                    "</div>" +
                    "</div>";
                }

                $('#donativoConteudo').html(html);
            }
        });
    }

}

$(document).ready(function () {
    pessoaInstituicao.aplicarEventos();
    pessoaInstituicao.aplicaSeguir();
});

