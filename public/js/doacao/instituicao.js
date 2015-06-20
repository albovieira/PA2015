var instituicao = {
		open:function(){
			$('#modal-item').on('show.bs.modal', function (event) {
		        var button = $(event.relatedTarget);            // Button that triggered the modal
		        var item_url = button.data('item-url');    // Extract info from data-* attributes
		        
		        var modal = $(this);
		        modal.
		            find('.modal-body').        // localizar corpo modal
		            html("<center><span class='icon mif-spinner mif-ani-pulse mif-4x fg-lightBlue'></span></center>").// colocar html caso a requição demore
		            load(item_url);           // inserir conteudo html AJAX
		    });
		},
		desativa_donativo:function(id){
			if(confirm("Desativar donativo?")) {
				$.ajax({
					url: 'https://sisdo.com/donativo/desativar',
					type: 'POST',
					dataType: 'json',
					data: {id: id},
					success: function (data, txt) {
						alert('Donativo desativado!');
						window.location.reload();
					},
					error: function (xhr, txt) {
						alert("Não foi possível desativar.");
					}
				});
			}
		},
		exclui_donativo:function(id){

			if(confirm('Confirma exclusão do donativo?')){
				$.ajax({
					url: 'https://sisdo.com/donativo/excluir',
					type: 'POST',
					dataType: 'json',
					data: {id: id},
					success: function (data, txt) {
						util.dialog(util.SUCCESS,'Êxito!','Donativo excluído com suceesso!');
						setTimeout(function(){window.location.reload()},3000)
					},
					error: function (xhr, txt) {
						alert("Não foi possível excluir!");
					}
				});
			}
		},
		ativa_donativo:function(id){
			if(confirm("Desbloquear donativo?")) {
				$.ajax({
					url: 'https://sisdo.com/donativo/ativar',
					type: 'POST',
					dataType: 'json',
					data: {id: id},
					success: function (data, txt) {
						alert('Donativo desbloqueado!');
						window.location.reload();
					},
					error: function (xhr, txt) {
						alert("Não foi possível desbloquear.");
						var dialog = $('#dialog').data('dialog');
					}
				});
			}
		}
};

var util = {
		SUCCESS:'success',
		ERROR: 'alert',
		WARNING: 'warning',
		INFO: 'info',
		dialog:function(CONSTANT_TYPE, titulo, msg){
			//Cria o contexto de invocação
			var identity = $('#dialog');
			$().attr('data-type',CONSTANT_TYPE);
			identity.attr('class',"padding20 " + CONSTANT_TYPE + " dialog");
			identity.children('span#dialog-body').html(msg);
			identity.children('h3#titulo').html(titulo);
			var dialog = identity.data('dialog');
			dialog.open();

		},
		dialogPut:function(){
			//Cria o elemento dialog na página
			var divCustom = "<div class='dialog padding20 ' data-role='dialog' id='dialog' data-close-button='true' " +
				"data-overlay='true'>" +
				"<h3 id='titulo'></h3>"+
				"<span id='dialog-body'></span>" +
				"</div>";
			$('body').append(divCustom);
		}
};

var transacao = {
	confirmar:function(id){
		if(confirm("Este donativo foi entregue pelo doador?")){
			$.ajax({
				url:'/transacao/confirmarecebimento',
				data:{id:id},
				dataType:'json',
				type:'POST',
				success:function(data,txt){
					if(data.data == 1){
						util.dialog(util.SUCCESS,'Êxito','Transação recebida com sucesso!');
						setInterval($('#dialog').close(),3000);
					}else{
						util.dialog(util.SUCCESS,'Êxito','Transação recebida com sucesso!');
					}
				},
				error:function(){
					util.dialog(util.ERROR,'Erro','Ocorreu erro ao contactar o serviço');
				}
			})
		}
	},
	pendentes:function(){
		$('#transacoes').load('/transacao/pendentes');
	},
	efetivados:function(){
		$('#transacoes').load('/transacao/efetivados');
	},
	index:function(o,l){
		$.ajax({
			url:'/transacao/pendentes',
			data:{offset:o,limit:l},
			type:'POST',
			success:function(data,txt){
				$('#transacoes-index').html(data);
			},
			error:function(){
				util.dialog(util.ERROR,"Erro",'Ocorreu erro ao contactar o serviço')
			}
		})
	},
	totais:function(){
		setInterval(function(){
			$.ajax({
				url:'/instituicao/totais',
				dataType: 'json',
				success:function(data,txt){
					$('#arrecadados').html(data.totais.recebidos);
					$('#finalizados').html(data.totais.finalizados);
					$('#pendentes').html(data.totais.pendentes);
					$('#pedidos').html(data.totais.donativos);
				}
			})
		},10000)
	}
}

var init = {
	components:function(){
		util.dialogPut();
		transacao.index(0,3);
		transacao.totais();
	}
};

$(document).ready(function(){
	init.components();
});
