/**
 * Created by Albo on 08/05/2015.
 */
var pessoaInstituicao = {

    aplicarEventos: function () {
        this.bindFiltroTodos();
        this.bindFiltroMinhas();
        this.autocomplete();
        this.bindClickBuscaInstituicao();
    },

    template: function (objInstituicao, btn) {
        var html = '';
        for(var i in objInstituicao){
            //arrumar isso
            if(!isNaN(i)){
                html +="<div class='tile-large bg-lightBlue'> " +
                "<form class='tile-content slide-left-2' method='post'>"+
                "<div class='slide padding10'>" +
                "<input class='instituicaoID' type='hidden' name='id' value='"+objInstituicao[i].id +"'>" +
                "<img src="+ objInstituicao[i].foto + " class='img-circle pull-right img-profile'>" +
                "</div>" +
                "<div class='slide-over padding10'>" +
                "<p class='text-justify'>" +
                objInstituicao[i].descricao +
                "</p>" +
                "<a href=/pessoa/instituicao-page?id=" + objInstituicao[i].id + " class=button small-button info>Ver mais</a>" +
                "<input type='button' class='button alert btn-seguir' value='"+btn+"'>"+
                "</div>" +
                "<span class='tile-label'><h4>"+ objInstituicao[i].nomeFantasia +"</h4></span>"+
                "</form>"+
                "</div>";
            }
        }

        return html;
    },

    bindFiltroTodos: function (){
        $('#todos').click(function () {

            $.ajax({
                data: {'filtro': "todos"},
                type: 'GET',
                url:'/pessoa/instituicao',
                success: function (data) {

                    var html = pessoaInstituicao.template(data.instituicoes, 'Seguir');
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

                    var html = pessoaInstituicao.template(data.instituicoes, 'Parar de Seguir');
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

                    var html = pessoaInstituicao.template(data.instituicoes, 'Seguir');
                    //html
                    $('#containerInstituicao').html(html);
                    pessoaInstituicao.aplicaSeguir();

                }
            });


        });

    },
    
    limpaModal: function () {
        
    },

    getDonativos: function(){
        //cap   tura paramentro da url
        var $_GET = principal.getURLParam(document.location.search);

        var idInstituicao = {'id' : $_GET};
        $.ajax({
            data: idInstituicao,
            type: 'GET',
            url:'/donativo/get-donativos',
            success: function (data) {
                var html = '<h4 style="margin-left: 15px;width: 93%;">Donativos cadastrados</h4>';
                if(data.length > 0){
                    $.each( data, function( key, donativo) {
                            console.log(donativo);
                            html += "" +
                                "<div class='col-xs-12'>" +
                                "<div class='list-group'>" +
                                "<input class='id-donativo' type='hidden' value='"+ donativo.id +"' />" +
                                "<a href='#' class='list-group-item '>" +
                                "<h4 class='list-group-item-heading'>"+donativo.titulo+"</h4>" +
                                "<p class='list-group-item-text'>"+ donativo.descricao+"</p><br>" +
                                "<p class='list-group-item-text'><strong class='text-danger'>Doação disponivel até: "+ donativo.dataDesa +"</strong></p><br>" +
                                "<button class='btn btn-primary btn-doar'>Doar</button>" +
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
                pessoaInstituicao.bindDoar();
            }
        });
    },
    
    bindDoar: function () {
        $('.btn-doar').each(function (index,elemento) {
            $(elemento).click(function (e) {
                $.ajax({
                    data: {'idDonativo': $(elemento).parents('.list-group').children('.id-donativo').val()},
                    type: 'POST',
                    url:'/transacao/nova-transacao',
                    success: function (data) {
                        $('.modal-body').html(data);
                        $('#doacaoModal').modal('show');
                        pessoaInstituicao.bindConfirmarDoacao();

                        if($("input[name=idTransacao]").val() != ''){
                            var p = "<p class='text-danger'>* Doação ainda pendente de finalização pela instituicao</p>";
                            $('.resumo-donativo').prepend(p);
                        }

                        pessoaInstituicao.showConversa();
                    }
                });
            });
        });
    },

    bindConfirmarDoacao: function(){
        $('#donativo').submit(function (e) {
            e.preventDefault();
            $.ajax({
                data: $('#donativo').serialize(),
                type: 'POST',
                url:'/transacao/nova-transacao',
                success: function (data) {
                    $('#doacaoModal').modal('hide');
                }
            });
        });
    },
        
    bindOferecerDoar: function () {
        $('#btn-oferecer').click(function () {
            $.ajax({
                //data: {'idDonativo': $(elemento).parents('.list-group').children('.id-donativo').val()},
                type: 'POST',
                url:'/transacao/oferecer-doacao',
                success: function (data) {
                    $('.modal-body').html(data);
                    $('#doacaoModal').modal('show');

                    pessoaInstituicao.bindConfirmarDoacao();
                }
            });
        })  
    },
    showConversa: function () {
        $('#ver-historico').click(function () {

            if(!$('.historico').hasClass('down')){
                $('.historico').slideDown();
                $('.historico').addClass('down');
            }else{
                $('.historico').slideUp();
                $('.historico').removeClass('down');
            }
        })
    }


}

$(document).ready(function () {
    pessoaInstituicao.aplicarEventos();
    pessoaInstituicao.aplicaSeguir();
});

