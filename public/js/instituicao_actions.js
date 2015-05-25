$(function(){
    $('#formdonativos').submit(function(event){
    	var dataSerial = $('form').serialize();
    	$.ajax({
    		url : 'https://sisdo.com/donativo/validaajax',
    		type: 'POST',
    		dataType: 'json',
    		async: true,
    		data: dataSerial,
    		success: function(data,textStatus){
    			if(data.success == 1){
    				alert('Donativo cadastrado com sucesso');
    			};
    		},
    		error: function(xhr,txt){
    			alert("Não foi possível validar a requisição.");
    		}
    		
    	});
    	return false;
    });
});