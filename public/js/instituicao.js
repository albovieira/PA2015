$(function(){
    $('#modal-item').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);            // Button that triggered the modal
        var item_url = button.data('item-url');    // Extract info from data-* attributes
        
        var modal = $(this);
        modal.
            find('.modal-body').        // localizar corpo modal
            html('Carregando...').      // colocar html caso a requição demore
            load(item_url);           // inserir conteudo html AJAX
    });
});