$(function(){
	$('form#formdonativos').submit(function(){
		var dataSerial = $('form').serialize();
		$.ajax({
			url : 'https://sisdo.com/donativo/validaajax',
			type: 'POST',
			dataType: 'json',
			data: dataSerial,
			success: function(data,textStatus){
				if(data){
					alert('Donativo cadastrado com sucesso');
				};
				window.location.reload();
			},
			error: function(xhr,txt){
				alert("Não foi possível validar a requisição.");
				$('#modal').close();
			},
		});
		return false;
	});
	return false;
});