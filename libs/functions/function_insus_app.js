var url = '../controller/controller_insus_app.php';
function AppInsus(){
	console.log("Ïnit the AppInsus");
}
AppInsus.prototype.getEstado = function(id_est){
		var data = {
			op: "estados",
			id_est: id_est
		}
		__Ajax_JSON(url,data).done(function(response){
			var datos = response;
		})
		console.log(response);
	}

