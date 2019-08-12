$(function(){
	'use strict';
	/*click desde la btn*/
	$('#acceso').click(function(){
		acceso();
	});

	/*Enter  cuando este lleno el campo password del login*/
	$("#password_usu").keypress(function(event){
		var keycode = (event.keyCode ? event.keyCode : event.which);
	    if(keycode == '13'){
	    	acceso();   
	    }
	});



})