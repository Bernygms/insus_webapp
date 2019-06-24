
var url = '../controller/controller_usuarios.php';

	/*login*/
function  acceso(){
	var correo_usu =  document.getElementById('correo_usu').value;
	var password_usu =  document.getElementById('password_usu').value;
	if (correo_usu == "") {
		toastrLogin('Ingresa tu nombre de usuario o correo electronico.','Acceso');
	}else if(password_usu == ""){
		toastrLogin('Ingresa tu contraseña.','Acceso');
	}else{
		var data = new FormData($("#fromlogin")[0]);
		__Ajax(url,data).done(function(response){
			if (response == 1) {
				toastrExito('Estamos accediendo al sistema  ....', 'Acceso correcto');
				window.location.href = 'insus.php';
			}else{
				toastrLogin(response,'Acceso denegado');
			}
		})
				
	}
}

	/**/

	/**/

	/**/