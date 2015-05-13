$(function(){
    $('form').submit(function(event){
    	var dataSerial = $(':input').serialize();
    	$.ajax({
    		url : $('form').attr('action'),
    		dataType : 'json',
    		type: 'POST',
    		data: dataSerial,
    		success: function(data,textStatus){
    			alert(textStatus);
    		}
    		
    	});
    	
    	event.preventDefault;
    	return true;
    });
});