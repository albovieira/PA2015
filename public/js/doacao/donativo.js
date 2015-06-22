$(function(){
	$('form#formdonativos').submit(function(){
		var dataSerial = $('form').serialize();
		$.ajax({
			url : '/donativo/insere',
			type: 'POST',
			dataType: 'json',
			data: dataSerial,
			success: function(data,textStatus){

				if(data.data == '"success"'){
					util.dialog(util.SUCCESS,'Êxito!','Você cadastrou um novo donativo com sucesso');
					setTimeout(function(){
						window.location.reload();
					},3000)
				}else{
					util.dialog(util.ERROR,"Erro!",data.data);
				};
			},
			error: function(xhr,txt){
				util.dialog(util.ERROR,'Erro!',xhr + txt);
			}
		});
		return false;
	});
	return false;
});