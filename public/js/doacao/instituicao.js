var instituicao = {
		open:function(){
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
		},
		desativa_donativo:function(id){
			$.ajax({
				url:'https://sisdo.com/donativo/desativar',
				type:'POST',
				dataType: 'json',
				data: {id:id},
				success:function(data,txt){
					alert('Donativo desativado!');
					window.location.reload();
				},
				error:function(xhr,txt){
					alert("Não foi possível desativar.");
				},
			});
		},
		exclui_donativo:function(id){
			$.ajax({
				url: 'https://sisdo.com/donativo/excluir',
				type: 'POST',
				dataType: 'json',
				data: {id:id},
				success:function(data,txt){
					alert('Donativo Excluído com sucesso!');
				},
				error:function(xhr,txt){
					alert("Não foi possível excluir!");
				}
			});
		}
};

var util = {
		dialog:function(type, msg){
			var modal = "";
			var classe = "";			
			switch(type){
			case 'error':
				classe = "alert-danger"; 
			break;
			case 'success':
				classe = "alert-success";
				break;
			}
			
			var modal = '<div role="alert" class="alert' + classe +' alert-dismissible fade in">' +
		      			'<button aria-label="Close" data-dismiss="alert" class="close" type="button"><span aria-hidden="true">×</span></button>' +
		      			msg + '</div>';
			
			return modal;
		}
}