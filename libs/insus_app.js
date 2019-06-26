
var url = '../controller/controller_insus_app.php';
var navigation = 0;
var estadosArray = ['undefined','AGUASCALIENTES','BAJA CALIFORNIA','BAJA CALIFORNIA SUR','CAMPECHE','COAHUILA','COLIMA','CHIAPAS','CHIHUAHUA','DISTRITO FEDERAL','DURANGO','GUANAJUATO','GUERRERO','HIDALGO','JALISCO','MÉXICO','MICHOACAN','MORELOS','NAYARIT','NUEVO LEON','OAXACA','PUEBLA','QUERETARO','QUINTANA ROO','SAN LUIS POTOSI','SINALOA','SONORA','TABASCO','TAMAULIPAS','TLAXCALA','VERACRUZ','YUCATAN','ZACATECAS'];
var rol_usu = $("#rol_usu").val();
var id_estado = $("#pk_id_est").val();

//mandamos a llamar la funcion  que regresa la informacion de raci
function init(){
	if (rol_usu == "" ||  id_estado == "") {
		$("#estados").html("<p>No termino de cargar la pagina, revisa tu coneccion de internet.</p>");
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
				console.log(response);
				html_est += '<table id="tabla" class="table  table-hover"><thead><tr><th>#</th><th>Nombre</th></tr></thead>';
				html_est += '<caption>Lista de estados.</caption></thead><tbody>';
				$.each(response.data.estados, function(key,value){
					//console.log(value['nombre_est']);
					html_est += '<tr>';
					html_est +='<td>'+value['id_est']+'</td>';
					html_est +='<td>'+MaysInit(value['nombre_est'])+'</td>';
					html_est +='<td><button onClick="javascript:getRaci(' + value['id_est'] +')" class="badge badge-primary" ><i class="mdi mdi-book-open-page-variant"></i>Abrir</button></td>';
					html_est += '</tr>';
					total_estados = total_estados + key;
				});
				html_est += '</tbody></table>';
				$("p#titulo_est").html("Estados");
				$("div#estados").html(html_est);
				navigation = 1;
		    });
		}else{
			alert("No se encontro ningun resultado.");
		}
			
	}
}


function getRaci(entidad_raci){
	console.log("ID de entidad: " + entidad_raci);
	$("div#search_raci").html('<input id="busca" type="text" class="form-control" placeholder="Buscar ahora" aria-label="search" aria-describedby="search">');
	var html_raci = "";
	if (entidad_raci) {
		$("div#div_est").hide();
		$("div#search_est").hide();
		if (rol_usu==1 || rol_usu == 2) {
			$("p#nombre_estado").html('&nbsp;/&nbsp;'+ MaysInit(estadosArray[entidad_raci]));
		};
		var data = {op: "raci",entidad_raci: entidad_raci}
		__Ajax_JSON(url,data).done(function(response){
				console.log(response);
				html_raci += '<table id="raci" class="table table-hover mytable"><thead><tr><th>Entidad</th><th>Cv.INSUS</th><th>Cv.INEGI</th><th>Modalidad</th><th>Poblado</th><th>Municipio</th><th>Superficie</th><th>Municipio</th><th>Contrataciòn</th><th>Lotes</th><th>Contratados</th><th>Pendientes</th></tr></thead>';
				html_raci += '</thead><tbody>';
				$.each(response.data.raci, function(key,value){
					//console.log(value['nombre_est']);
					var pend_contratar = value['universo_de_lot_raci'] - value['total_con_raci']; 
					html_raci +='<tr data-toggle="collapse" href="#Estados'+value['clave_insus_raci']+'"  >';
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
					//html_raci +='<td><button class="badge badge-primary"><i class="mdi mdi-book-open-page-variant"></i>Abrir</button></td>';
					//html_raci +='<td><button class="badge badge-primary"><i class="mdi mdi-book-open-page-variant"></i>Abrir</button></td>';
					html_raci +='</tr>';
					/*html_raci +='<tr>';
					html_raci +='<td colspan="12" class="hiddenRow">';
					
					html_raci +='<div class="accordian-body collapse text-center mt-2 mb-2" id="Estados'+value['clave_insus_raci']+'">';
					if(rol_usu == 1 && value['universo_de_lot_raci'] == value['total_con_raci']) html_raci +='<button class="badge badge-primary" ><i class="mdi mdi-pencil"></i>Editar </button>';
					html_raci +='<button class="badge badge-success" ><i class="mdi mdi-note-plus"></i>Agregar acciones</button>';
					html_raci +='<button class="badge badge-success" ><i class="mdi mdi-magnify"></i>Consultas y edicion</button>';
					html_raci +='</div>';

					html_raci +='</td>';
					html_raci +='</tr>';*/
				});
				html_raci += '</tbody></table>';
				$("p#titulo_raci").html("Raci");
				$("div#contenedor").html(html_raci);
				$("div#div_raci").show();
				//$("#raci").DataTable();
				DataTable('.mytable');
				navigation = 2;
			});		
	}else{
		console.log('no ok');
	}
	
}

/*Convertidor de texto mayusculas al inicio*/
function MaysInit(intoText){
	return intoText.toLowerCase()
            .trim()
            .split(' ')
            .map( v => v[0].toUpperCase() + v.substr(1) )
            .join(' '); 
}

/**/

/*Vamos a buscar la pagina, ya visitada*/
function nextPage(){
	navigation++;
	console.log('' + navigation + '' );
}

function beforePage(){
	navigation--;
}

function DataTable(IdOrClass){
	$(IdOrClass).DataTable({
		language: {
				    "sProcessing":     "Procesando...",
				    "sLengthMenu":     "Mostrar _MENU_ registros",
				    "sZeroRecords":    "No se encontraron resultados",
				    "sEmptyTable":     "Ningún dato disponible en esta tabla",
				    "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
				    "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
				    "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
				    "sInfoPostFix":    "",
				    "sSearch":         "Buscar:",
				    "sUrl":            "",
				    "sInfoThousands":  ",",
				    "sLoadingRecords": "Cargando...",
				    "oPaginate": {
				        "sFirst":    "Primero",
				        "sLast":     "Último",
				        "sNext":     "Siguiente",
				        "sPrevious": "Anterior"
				    },
				    "oAria": {
				        "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
				        "sSortDescending": ": Activar para ordenar la columna de manera descendente"
				    }
				}
	});
}

