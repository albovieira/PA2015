$(function(){
    $('#modal-item').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);            // Button that triggered the modal
        var item_url = button.data('item-url');    // Extract info from data-* attributes
        
        var modal = $(this);
        modal.
            find('.modal-body').        // localizar corpo modal
            html("<div><b class='affix center-block'>Carregando formulário...</b>" +
            		"<img src='/img/progress_bar.gif' class='center-block' /></div>").      // colocar html caso a requição demore
            load(item_url);           // inserir conteudo html AJAX
    });
   
});

function desativa_donativo(id){
	
	$.ajax({
		url: 'https://sisdo.com/donativo/desativar',
		type: 'POST',
		dataType: 'json',
		data: {id:id},
		success: function(data,textStatus){
			alert('Donativo desativado!');
			window.location.reload();
		},
		error: function(xhr,txt){
			alert("Não foi possível desativar.");
		},
	});
};