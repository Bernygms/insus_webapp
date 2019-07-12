 var url = '../controller/controller_insus_app.php';
 var navigation = 0;
 var estados = []; 
 var raci = [];
 var estadosArray = ['undefined','AGUASCALIENTES','BAJA CALIFORNIA','BAJA CALIFORNIA SUR','CAMPECHE','COAHUILA','COLIMA','CHIAPAS','CHIHUAHUA','DISTRITO FEDERAL','DURANGO','GUANAJUATO','GUERRERO','HIDALGO','JALISCO','MÉXICO','MICHOACAN','MORELOS','NAYARIT','NUEVO LEON','OAXACA','PUEBLA','QUERETARO','QUINTANA ROO','SAN LUIS POTOSI','SINALOA','SONORA','TABASCO','TAMAULIPAS','TLAXCALA','VERACRUZ','YUCATAN','ZACATECAS'];

 var rol_usu = $("#rol_usu").val();
 var id_estado = $("#pk_id_est").val();

 //Cosulta de estados 
function init(){
	if (rol_usu == "" ||  id_estado == "") {
		$("#tab_est").html("<p>No termino de cargar la pagina, revisa tu coneccion de internet.</p>");
	}else{
		var html_est = "";
		var total_estados = 0;
		if (rol_usu==1 || rol_usu == 2 || rol_usu == 3) {	
		$("div#search_est").html('<input id="buscar" type="text" class="form-control" placeholder="Buscar ahora" aria-label="search" aria-describedby="search">');	
		
		if (rol_usu==1 || rol_usu == 2) {
			$("p#name_user").html('&nbsp;/&nbsp; Administrador');
		}else{
			$("p#nombre_estado").html('&nbsp;/&nbsp;'+ MaysInit(estadosArray[id_estado]));
		};
			var data = {op: "estados", id_est: id_estado, rol_usu: rol_usu}
			__Ajax_JSON(url,data).done(function(response){
				estados = response; 
				//console.log(response);
				html_est += '<table id="tabla" class="table  table-hover "><thead><tr><th>#</th><th>Nombre</th></tr></thead>';
				html_est += '<caption>Lista de estados.</caption><tbody>';
				$.each(response.data.estados, function(key,value){
					//console.log(value['nombre_est']);
					html_est += '<tr>';
					html_est +='<td>'+value['id_est']+'</td>';
					html_est +='<td>'+MaysInit(value['nombre_est'])+'</td>';
					html_est +='<td><button type="button" onClick="javascript:getIdEstados(' + value['id_est'] +')" class="btn btn-inverse-primary btn-rounded mdi mdi-magnify btn-sm" data-toggle="tooltip" data-placement="right" title="Cunsultar poblados" ></td>';
					html_est += '</tr>';
					total_estados = total_estados + key;
				});
				html_est += '</tbody></table>';
				$("p#titulo_est").html("Estados");
				$("div#tab_est").html(html_est);
				navigation = 1;
		    });
		}else{
			alert("No se encontro ningun resultado.");
		}	
	}
}

//Consulta de raci
function getIdEstados(entidad_raci){
	console.log("ID de entidad: " + entidad_raci);
	$("#buscador").hide();
	var html_raci = "";
	if (entidad_raci) {
		$("div#div_est").hide();
		$("#buscador_estados").hide();
		if (rol_usu == 1 || rol_usu == 2) {
			$("p#nombre_estado").html('&nbsp;/&nbsp;'+ MaysInit(estadosArray[entidad_raci]));
		};
		var data = {op: "raci",entidad_raci: entidad_raci}
		__Ajax_JSON(url,data).done(function(response){
				raci = response;
				//console.log(response);
				html_raci += '<table id="raci" class="table table-hover mytable"><thead><tr><th>Entidad</th><th>Cv.INSUS</th><th>Cv.INEGI</th><th>Modalidad</th><th>Poblado</th><th>Municipio</th><th>Superficie</th><th>Municipio</th><th>Contrataciòn</th><th>Lotes</th><th>Contratados</th><th>Pendientes</th><th>Accion</th></tr>';
				html_raci += '</thead><tbody>';
				$.each(response.data.raci, function(key,value){
					//console.log(value['nombre_est']);
					var pend_contratar = value['universo_de_lot_raci'] - value['total_con_raci']; 
					html_raci +='<tr>';
					html_raci +='<td><i class="mdi mdi-plus text-muted"></i>'+value['entidad_raci']+'</td>';
					html_raci +='<td>'+value['clave_insus_raci']+'</td>';
					html_raci +='<td>'+value['clave_inegi_raci']+'</td>';
					html_raci +='<td>'+value['modalidad_raci']+'</td>';
					html_raci +='<td>'+value['nombre_de_pob_raci']+'</td>';
					html_raci +='<td>'+value['municipio_raci']+'</td>';
					html_raci +='<td>'+value['superficie_de_pob_raci']+'</td>';
					html_raci +='<td>'+value['municipio_pro_raci']+'</td>';
					html_raci +='<td>'+value['fecha_ini_con_raci']+'</td>';
					html_raci +='<td>'+value['universo_de_lot_raci']+'</td>';
					html_raci +='<td>'+value['total_con_raci']+'</td>';
					html_raci +='<td>'+pend_contratar+'</td>';
					html_raci +='<td>';
					if(rol_usu == 1 || rol_usu == 2 ) html_raci +='<button type="button" class="btn btn-inverse-primary btn-rounded mdi mdi-grease-pencil" data-toggle="tooltip" data-placement="right" title="Actualizar universo de lotes" ></button>&nbsp;&nbsp;';
					if (value['universo_de_lot_raci'] == value['total_con_raci'] ) {
						html_raci +='<button type="button" class="btn  btn-inverse-danger btn-rounded mdi mdi-account-multiple-plus" data-toggle="tooltip" data-placement="right" title="Acciones completadas"  ></button>&nbsp;&nbsp;';
					}else{
						html_raci +='<button type="button" onClick="getIdRaci('+ value['id_raci'] +')" class="btn  btn-inverse-success btn-rounded mdi mdi-account-multiple-plus data-toggle="tooltip" data-placement="right" title="Agregar nuevas acciones"></button>&nbsp;&nbsp;';
					}
					html_raci +='<button type="button"  class="btn btn-md btn-inverse-info btn-rounded mdi mdi-magnify data-toggle="tooltip" data-placement="right" title="Consultar acciones"></button>&nbsp;&nbsp;';
					html_raci +='</td>';
					html_raci +='</tr>';
				});
				html_raci += '</tbody></table>';
				$("p#titulo_raci").html("Raci");
				$("div#tab_raci").html(html_raci);
				$("div#div_raci").show();
				//$("#table_raci").DataTable();
				DataTable('.mytable');
				navigation = 2;
			});		
	}else{
		console.log('no ok');
	}
	
} 

function getIdRaci(id_raci){
	var status = false;
	console.log(id_raci);
	console.log(raci);
	for (var i in raci.data.raci) {
		if (raci.data.raci[i].id_raci == id_raci) {
			$("#id_raci").val(raci.data.raci[i].id_raci);
			$("#entidad_raci").val(raci.data.raci[i].entidad_raci);
			$("#clave_insus_raci").val(raci.data.raci[i].clave_insus_raci);
			$("#clave_inegi_raci").val(raci.data.raci[i].clave_inegi_raci);
			$("#modalidad_raci").val(raci.data.raci[i].modalidad_raci);
			$("#nombre_de_pob_raci").val(raci.data.raci[i].nombre_de_pob_raci);
			$("#municipio_raci").val(raci.data.raci[i].municipio_raci);
			$("#superficie_de_pob_raci").val(raci.data.raci[i].superficie_de_pob_raci);
			$("#municipio_pro_raci").val(raci.data.raci[i].municipio_pro_raci);
			$("#fecha_ini_con_raci").val(raci.data.raci[i].fecha_ini_con_raci);
			$("#universo_de_lot_raci").val(raci.data.raci[i].universo_de_lot_raci);
			$("#total_con_raci").val(raci.data.raci[i].total_con_raci);
			status = true;
			console.log(status);
		}
	}
	if (status ==true) {
		$("#div_datos_poblado").show();
		$("#div_accion_y_programa").hide();
		$("#div_beneficiarios").hide();
		$("#myModalAddAcciones").modal('show');
		$('#myModalAddAcciones').modal({backdrop: 'static', keyboard: false});
		$("#nav1").removeClass("active");
		$("#nav2").removeClass("active");
		$("#nav3").removeClass("active");
		$("#nav1").addClass("active");
	}
	
}


function addAcciones(uno,dos){
	toastrExito(uno + dos , 'response');
	$("#div_datos_poblado").hide();
	$("#div_accion_y_programa").hide();
	$("#div_beneficiarios").show();
	$("#nav2").removeClass("active");
	$("#nav3").addClass("active");
	//$("#nav3").addClass("active"); 
	//$("#nav4").addClass("active");

}

function validarPrograma(data){
	var respuesta = "";
	__Ajax_JSON(url,data).done(function(response){
		console.log("------------------------")
		console.log(response);
		respuesta = response;
		console.log("------------------------")
	});
	return respuesta;
}