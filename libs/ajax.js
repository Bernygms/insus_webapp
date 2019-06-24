/*Funcion ajax general json*/
function __Ajax_JSON(url, data){
	var ajax = $.ajax({
		url : url,
		data : data,
		type : 'POST',
		dataType : 'json'
	})
	return ajax;
}

/*Funcion ajax general json*/
function __Ajax(url, data){
	var ajax = $.ajax({
		url : url,
		data : data,
		type : 'POST',
		contentType: false,
		processData: false
	})
	return ajax;
}

/*Funcion ajax por FormData*/
function __Ajax_FormData(url,data){
	var ajax = $.ajax({
		url : url,
		data : data,
		type : 'POST',
		contentType: false,
		processData: false
	})
}
