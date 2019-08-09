  /******************************************************/ 
  	
  	var navigation = 0;/*1:estados, 2: Raci,  3:Acciones y beneficiarios.*/
  	var count = 0;
	var estados = []; 
	var raci = [];
	var estadosArray = ['undefined','AGUASCALIENTES','BAJA CALIFORNIA','BAJA CALIFORNIA SUR','CAMPECHE','COAHUILA','COLIMA','CHIAPAS','CHIHUAHUA','DISTRITO FEDERAL','DURANGO','GUANAJUATO','GUERRERO','HIDALGO','JALISCO','MÉXICO','MICHOACAN','MORELOS','NAYARIT','NUEVO LEON','OAXACA','PUEBLA','QUERETARO','QUINTANA ROO','SAN LUIS POTOSI','SINALOA','SONORA','TABASCO','TAMAULIPAS','TLAXCALA','VERACRUZ','YUCATAN','ZACATECAS'];
	var meses = new Array ("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
	var total_nuevo_con = null;
	var fecha = null;
	var language = null;
	var data = {};
 /******************************************************/
 /******************************************************/
    //Variable de entrada para la tabla estados 
    var id_est =  0;
    var nombre_est =  null;
 /******************************************************/
 /******************************************************/
    //variables de entrada para la tabla raci
    var id_raci =  null;
    var entidad_raci = null;
    var clave_insus_raci =  null;
    var clave_inegi_raci =  null;
    var modalidad_raci =  null;
    var nombre_de_pob_raci =  null;
    var municipio_raci =  null;
    var superficie_de_pob_raci =  null;
    var municipio_pro_raci =  null;
    var fecha_ini_con_raci =  null;
    var universo_de_lot_raci =  null;
    var total_con_raci = null;
    //variable para validar la consultas por roles
    var rol_usu =  0;
    //Variables de entrada contratos
    var id_con =  0;
    var accion_con =  null;
    var pago_ben_con =  null;
    var apoyo_insus_con =  null;
    var subsidio_con=  null;
    var mes_con =  null;
    var anno_con =  null;
    var fecha_con =  null;
    var fecha_edi_con =  null;
    var pk_id_raci =  null;
    var pk_id_pro =  null;
    var url = "../controller/controller_insus_app.php";
    var urlBenef = "../controller/controller_beneficiarios.php";

    var idioma_espanol = {
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
			"oPaginate":{
			"sFirst":    "Primero",
			"sLast":     "Último",
			"sNext":     "Siguiente",
			"sPrevious": "Anterior"
			},
			"oAria":{
				"sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
				"sSortDescending": ": Activar para ordenar la columna de manera descendente"
			}
		};

 //Cosulta de estados 
function init(){
	rol_usu = $("#rol_usu").val();
	id_est = $("#pk_id_est").val();
	if (rol_usu == "" ||  id_est == "") {
		$("#tab_est").html("<p>No termino de cargar la pagina, revisa tu coneccion de internet.</p>");
	}else{
		var html_est = "";
		var total_estados = 0;
		if (rol_usu==1 || rol_usu == 2 || rol_usu == 3) {	
		$("div#search_est").html('<input id="buscar" type="text" class="form-control" placeholder="Buscar ahora" aria-label="search" aria-describedby="search">');	
		
		if (rol_usu==1 || rol_usu == 2) {
			$("p#name_user").html('&nbsp;/&nbsp; Administrador');
		}else{
			$("p#nombre_estado").html('&nbsp;/&nbsp;'+ MaysInit(estadosArray[id_est]));
		};
			data = {op: "estados", id_est: id_est, rol_usu: rol_usu}
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
				count = 1;
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
		data = {op: "raci",entidad_raci: entidad_raci}
		__Ajax_JSON(url,data).done(function(response){
				raci = response;
				//console.log(response);
				html_raci += '<table id="raci" class="table table-hover mytable"><thead><tr><!--<th>#</th>--><th>Cv.INSUS</th><th>Cv.INEGI</th><th>Tipo</th><th>Poblado</th><th>Municipio</th><th>Superficie</th><!--<th>Municipio</th><th>Contrataciòn</th>--><th>Lotes</th><th>Contratados</th><th>Pendientes</th><th>Accion</th></tr>';
				html_raci += '</thead><tbody>';
				$.each(response.data.raci, function(key,value){
					//console.log(value['nombre_est']);
					var pend_contratar = value['universo_de_lot_raci'] - value['total_con_raci']; 
					html_raci +='<tr>';
					//html_raci +='<td><i class="mdi mdi-plus text-muted"></i>'+value['entidad_raci']+'</td>';
					html_raci +='<td>'+value['clave_insus_raci']+'</td>';
					html_raci +='<td>'+value['clave_inegi_raci']+'</td>';
					html_raci +='<td>'+value['modalidad_raci']+'</td>';
					html_raci +='<td>'+value['nombre_de_pob_raci']+'</td>';
					html_raci +='<td>'+value['municipio_raci']+'</td>';
					html_raci +='<td>'+value['superficie_de_pob_raci']+'</td>';
					/*html_raci +='<td>'+value['municipio_pro_raci']+'</td>';
					html_raci +='<td>'+value['fecha_ini_con_raci']+'</td>';*/
					html_raci +='<td>'+value['universo_de_lot_raci']+'</td>';
					html_raci +='<td>'+value['total_con_raci']+'</td>';
					html_raci +='<td>'+pend_contratar+'</td>';
					html_raci +='<td>';
					if(rol_usu == 1 || rol_usu == 2 ) html_raci +='<button type="button" class="btn btn-inverse-primary btn-rounded mdi mdi-grease-pencil" data-toggle="tooltip" data-placement="right" title="Actualizar universo de lotes" ></button>&nbsp;&nbsp;';
					if (value['universo_de_lot_raci'] == value['total_con_raci'] || value['universo_de_lot_raci'] < value['total_con_raci'] ) {
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
				$(".mytable").DataTable({
					"language": idioma_espanol
				});
				count = 2;
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
		$("#div_finalizar").hide();
		$("#ac1").hide();
		$("#ac2").hide();
		$("#ac3").hide();
		$("#ac4").hide();
		$("#ac5").hide();
		$("#ac6").hide();
		$("#btn_before_2").show(); 
		$("#btn_next_2").hide(); 
		$("#btn_input_benef").hide(); 
		$("#btn_omit").hide();
		$("#btn_next_ben").hide();

		$('#myModalAddAcciones').modal({backdrop: 'static', keyboard: false});
		$("#myModalAddAcciones").modal('show');
		$("#nav1").removeClass("active");
		$("#nav2").removeClass("active");
		$("#nav3").removeClass("active");
		$("#nav4").removeClass("active");
		$("#nav1").addClass("active");
		$("#pk_id_pro").attr("disabled", false);
		$("#msg_exito_acciones").hide();
	}
	
}

/*Validamos programas, REGLA 1 , REGLA 2 , REGLA 3, PMU, PRH, PASPRAH, OTROS*/
function valProgramas(){
	fecha = new Date();
	mes_con = meses[fecha.getMonth()];
	anno_con = fecha.getFullYear();
	pk_id_pro = 0;
	pk_id_pro = $("#pk_id_pro").val();
	pk_id_raci = $("#id_raci").val();
		if(pk_id_pro == 1) {
			data = {op: "programa", mes_con: mes_con, anno_con:anno_con, pk_id_pro: pk_id_pro, pk_id_raci:pk_id_raci};
			console.log(mes_con,anno_con, pk_id_pro);
			__Ajax_JSON(url,data).done(function(response){
				if ($.isEmptyObject(response.data.contratos) == true) {
					hideInput();
					toastrExito("Bienvenido a la ventana de agregar nuevas acciones.","Regla 1");
					$("#ac1").show(); //accion
					$("#ac2").show(); //pago beneficiario
					$("#ac3").show(); //Apoyo insus 
					$("#ac4").hide(); //Subsidio
					$("#ac5").hide(); //Rectificacion
					$("#ac6").hide(); //Otros
					enabledBtnAddAcciones();
				}else{
					toastrError("Ya existe un resgitro de este mes de "+ mes_con+", ve a consulta para editar.","Regla 1");
					hideInput();
				}
			});
			
		}else if(pk_id_pro == 2){
			data = {op: "programa", mes_con: mes_con, anno_con:anno_con, pk_id_pro: pk_id_pro, pk_id_raci:pk_id_raci};
			console.log(mes_con,anno_con, pk_id_pro);
			__Ajax_JSON(url,data).done(function(response){
				hideInput();
				if ($.isEmptyObject(response.data.contratos) == true) {
					toastrExito("Bienvenido a la ventana de agregar nuevas acciones.","Regla 2");
					$("#ac1").show();
					$("#ac2").show();
					$("#ac3").hide();
					$("#ac4").hide();
					$("#ac5").hide();
					$("#ac6").hide();
					enabledBtnAddAcciones();
				}else{
					toastrError("Ya existe un resgitro de este mes de "+ mes_con+", ve a consulta para editar.","Regla 2");
					hideInput();
				}
			});
		}else if(pk_id_pro == 3){
			data = {op: "programa", mes_con: mes_con, anno_con:anno_con, pk_id_pro: pk_id_pro, pk_id_raci:pk_id_raci};
			console.log(mes_con,anno_con, pk_id_pro);
			__Ajax_JSON(url,data).done(function(response){
				hideInput();
				if ($.isEmptyObject(response.data.contratos) == true) {
					toastrExito("Bienvenido a la ventana de agregar nuevas acciones.","Regla 3");
					$("#ac1").show();
					$("#ac2").show();
					$("#ac3").hide();
					$("#ac4").hide();
					$("#ac5").hide();
					$("#ac6").hide();
					enabledBtnAddAcciones();
				}else{
					toastrError("Ya existe un resgitro de este mes de "+ mes_con+", ve a consulta para editar.","Regla 3");
					hideInput();
				}
			});
		}else if(pk_id_pro == 4){
			data = {op: "programa", mes_con: mes_con, anno_con:anno_con, pk_id_pro: pk_id_pro, pk_id_raci:pk_id_raci};
			console.log(mes_con,anno_con, pk_id_pro);
			__Ajax_JSON(url,data).done(function(response){
				hideInput();
				if ($.isEmptyObject(response.data.contratos) == true) {
					toastrExito("Bienvenido a la ventana de agregar nuevas acciones.","PMU");
					$("#ac1").show();
					$("#ac2").show();
					$("#ac3").hide();
					$("#ac4").show();
					$("#ac5").hide();
					$("#ac6").hide();
					enabledBtnAddAcciones();
				}else{
					toastrError("Ya existe un resgitro de este mes de "+ mes_con+", ve a consulta para editar.","PMU");
					hideInput();
				}
			});
		}else if(pk_id_pro == 5){
			data = {op: "programa", mes_con: mes_con, anno_con:anno_con, pk_id_pro: pk_id_pro, pk_id_raci:pk_id_raci};
			console.log(mes_con,anno_con, pk_id_pro);
			__Ajax_JSON(url,data).done(function(response){
				hideInput();
				if ($.isEmptyObject(response.data.contratos) == true) {
					toastrExito("Bienvenido a la ventana de agregar nuevas acciones.","PRAH");
					$("#ac1").show();
					$("#ac2").show();
					$("#ac3").hide();
					$("#ac4").show();
					$("#ac5").hide();
					$("#ac6").hide();
					enabledBtnAddAcciones();
				}else{
					toastrError("Ya existe un resgitro de este mes de "+ mes_con+", ve a consulta para editar.","PRAH");
					hideInput();
				}
			});
		}else if(pk_id_pro == 6){
			data = {op: "programa", mes_con: mes_con, anno_con:anno_con, pk_id_pro: pk_id_pro, pk_id_raci:pk_id_raci};
			console.log(mes_con,anno_con, pk_id_pro);
			__Ajax_JSON(url,data).done(function(response){
				hideInput();
				if ($.isEmptyObject(response.data.contratos) == true) {
					toastrExito("Bienvenido a la ventana de agregar nuevas acciones.","PASPRAH");
					$("#ac1").show();
					$("#ac2").hide();
					$("#ac3").show();
					$("#ac4").show();
					$("#ac5").hide();
					$("#ac6").hide();
					enabledBtnAddAcciones();
				}else{
					toastrError("Ya existe un resgitro de este mes de "+ mes_con+", ve a consulta para editar.","PASPRAH");
					hideInput();
				}
			});
		}else if(pk_id_pro == 7){
			data = {op: "programa", mes_con: mes_con, anno_con:anno_con, pk_id_pro: pk_id_pro, pk_id_raci:pk_id_raci};
			console.log(mes_con,anno_con, pk_id_pro);
			__Ajax_JSON(url,data).done(function(response){
				hideInput();
				if ($.isEmptyObject(response.data.contratos) == true) {
					toastrExito("Bienvenido a la ventana de agregar nuevas acciones.","OTROS");
					$("#ac1").hide();
					$("#ac2").hide();
					$("#ac3").hide();
					$("#ac4").hide();
					$("#ac5").show();
					$("#ac6").show();
					enabledBtnAddAcciones();
				}else{
					toastrError("Ya existe un resgitro de este mes de "+ mes_con+", ve a consulta para editar.","OTROS RECTIFICACIONES");
					hideInput();
				}
			});	
		}else{
			toastrError("Debes de seleccionar al menos un programa.","Programas");
			hideInput();
			
		}

}
//Ocultamos campos por grupo , en modal programas y acciones
function hideInput(){
	$("#ac1").hide(); //accion
	$("#ac2").hide(); //pago beneficiario
	$("#ac3").hide(); //Apoyo insus 
	$("#ac4").hide(); //Subsidio
	$("#ac5").hide(); //Rectificacion
	$("#ac6").hide(); //Otros
	//Vaciamos los campos cuando se cambia el programa.
	$("#accion_con").val("");
	$("#pago_ben_con").val("") ;
	$("#apoyo_insus_con").val("");
	$("#subsidio_con").val("");
	$("#rectificaciones_con").val("");
	$("#otros_con").val("");

	$("#btn_next_2").hide(); //Btn
    $("#btn_cancel_2").hide();
}
 // Validacion del campo accion 
function valAcciones(){
	accion_con = $("#accion_con").val();
	universo_de_lot_raci = $("#universo_de_lot_raci").val();
	total_con_raci = $("#total_con_raci").val();
	total_nuevo_con = parseInt(total_con_raci) + parseInt(accion_con);
	console.log(accion_con);
	console.log(universo_de_lot_raci);
	console.log(total_con_raci);
	console.log(total_nuevo_con);
	if (accion_con == "") { 
		toastrError("El campo Acción es obligatorio.", "Acción")
	}else{
		if (total_nuevo_con <= universo_de_lot_raci){
			toastrExito("Se valido con exito, posdemos agregar las acciones indicadas.", "Acción");
		}else{
			toastrError("La suma total de acciones, supera el universo de lotes.", "Acción");
			$("#accion_con").val("");
		}

	}
}
function desabledBtnAddAcciones(){
		$('#btn_next_2').attr("disabled", true);
		$('#btn_before_2').attr("disabled", true);
		$('#btn_cancel_2').attr("disabled", true);
		$("#pk_id_pro").attr("disabled", true);
		$("#accion_con").attr("disabled", true);
		$("#pago_ben_con").attr("disabled", true);
		$("#apoyo_insus_con").attr("disabled", true);
		$("#subsidio_con").attr("disabled", true);
		$("#rectificaciones_con").attr("disabled", true);
		$("#otros_con").attr("disabled", true);
}
function enabledBtnAddAcciones(){
		$("#btn_next_2").show(); //Btn
		$("#btn_cancel_2").show(); //Btn

		$('#btn_next_2').attr("disabled", false);
		$('#btn_before_2').attr("disabled", false);
		$('#btn_cancel_2').attr("disabled", false);
		$("#pk_id_pro").attr("disabled", false);
		$("#accion_con").attr("disabled", false);
		$("#pago_ben_con").attr("disabled", false);
		$("#apoyo_insus_con").attr("disabled", false);
		$("#subsidio_con").attr("disabled", false);
		$("#rectificaciones_con").attr("disabled", false);
		$("#otros_con").attr("disabled", false);
}

function hideBtnAndShowNavBenef(){
			$("#btn_before_2").hide();
			$("#btn_next_2").hide();
			$("#btn_cancel_2").hide();
			$("#nav2").removeClass("active");
			$("#nav3").addClass("active");
			$("#msg_exito_acciones").show();
			//$("#div_beneficiarios").show();
			$("#btn_input_benef").show();
			$("#btn_omit").show();
}
function addAcciones(){
	accion_con = $("#accion_con").val().trim();
	pago_ben_con = $("#pago_ben_con").val().trim();
	apoyo_insus_con = $("#apoyo_insus_con").val().trim();
	subsidio_con = $("#subsidio_con").val().trim();
	rectificaciones_con = $("#rectificaciones_con").val().trim();
	otros_con = $("#otros_con").val().trim();
	mes_con = meses[fecha.getMonth()];
	anno_con = fecha.getFullYear();
	pk_id_pro = $("#pk_id_pro").val().trim();

	//Variables de apoyo de raci
	pk_id_raci = $("#id_raci").val().trim();
	universo_de_lot_raci = $("#universo_de_lot_raci").val().trim();
	total_con_raci = $("#total_con_raci").val().trim();
	entidad_raci = $("#entidad_raci").val().trim();
	data = {
			op: "insert", 
			accion_con: accion_con,
			pago_ben_con: pago_ben_con,
			apoyo_insus_con: apoyo_insus_con,
			subsidio_con: subsidio_con,
			rectificaciones_con: rectificaciones_con,
			otros_con: otros_con,
			mes_con: mes_con,
			anno_con:anno_con,
			pk_id_raci: pk_id_raci,
			pk_id_pro: pk_id_pro,
			universo_de_lot_raci: universo_de_lot_raci,
			total_con_raci: total_con_raci
		  };

	if (pk_id_pro == 1) {
		if (accion_con == "" ||  accion_con == 0 || !$.isNumeric(accion_con)) {
			toastrError("El campo acción, es obligatorio.","Acción");
		}else if (pago_ben_con == "" || pago_ben_con == 0 || !$.isNumeric(pago_ben_con)) {
			toastrError("El campo Pago Beneficiario, es obligatorio.","Pago Beneficiario");
		}else if (apoyo_insus_con == "" || apoyo_insus_con == 0 || !$.isNumeric(apoyo_insus_con)) {
			toastrError("El campo Apoyo INSUS, es obligatorio.","Apoyo INSUS");
		}else{
			desabledBtnAddAcciones();
			__Ajax_JSON(url,data).done(function(response){
				if (response.success == true) {
					if (accion_con == 1) {
						$("#msg_exito_acciones").html('<div class="alert alert-success" role="alert"><strong>Bien hecho!&nbsp;</strong>Una acción agregada con éxito, para continuar puedes agregar los datos del beneficiario dando click en continuar o dar click en omitir para terminar el proceso de registro.</div>');
					}else{
						$("#msg_exito_acciones").html('<div class="alert alert-success" role="alert"><strong>Bien hecho!&nbsp;</strong>'+accion_con+' Acciones agregadas con éxito, para continuar puedes agregar los datos de los beneficiarios dando click en continuar o dar click en omitir para terminar el proceso de registro.</div>');
					}
					hideBtnAndShowNavBenef();
					getIdEstados(entidad_raci);
					autoCreateInputBenef(accion_con, response.data.contrato.id_con);
				}else if(response.success == false){
					toastrError(response.data.mensaje);
					enabledBtnAddAcciones();
				}
			});
		}
	}else if (pk_id_pro == 2) {
		if (accion_con == "" || accion_con == 0) {
			toastrError("El campo acción, es obligatorio.","Acción");
		}else if (pago_ben_con == "" || pago_ben_con == 0) {
			toastrError("El campo Pago Beneficiario, es obligatorio.","Pago Beneficiario");
		}else{
			desabledBtnAddAcciones();
			__Ajax_JSON(url,data).done(function(response){
				if (response.success == true) {
					if (accion_con == 1) {
						$("#msg_exito_acciones").html('<div class="alert alert-success" role="alert"><strong>Bien hecho!&nbsp;</strong>Una acción agregada con éxito, para continuar puedes agregar los datos del beneficiario dando click en continuar o dar click en omitir para terminar el proceso de registro.</div>');
					}else{
						$("#msg_exito_acciones").html('<div class="alert alert-success" role="alert"><strong>Bien hecho!&nbsp;</strong>'+accion_con+' Acciones agregadas con éxito, para continuar puedes agregar los datos de los beneficiarios dando click en continuar o dar click en omitir para terminar el proceso de registro.</div>');
					}
					hideBtnAndShowNavBenef();
					getIdEstados(entidad_raci);
					autoCreateInputBenef(accion_con, response.data.contrato.id_con);
				}else if(response.success == false){
					toastrError(response.data.mensaje);
					enabledBtnAddAcciones();
				}
			});
		}
	}else if (pk_id_pro == 3) {	
		if (accion_con == " " || accion_con == 0) {
			toastrError("El campo acción, es obligatorio.","Acción");
		}else if (pago_ben_con == "" || pago_ben_con == 0) {
			toastrError("El campo Pago Beneficiario, es obligatorio.","Pago Beneficiario");
		}else{
			desabledBtnAddAcciones();
			__Ajax_JSON(url,data).done(function(response){
				if (response.success == true) {
					if (accion_con == 1) {
						$("#msg_exito_acciones").html('<div class="alert alert-success" role="alert"><strong>Bien hecho!&nbsp;</strong>Una acción agregada con éxito, para continuar puedes agregar los datos del beneficiario dando click en continuar o dar click en omitir para terminar el proceso de registro.</div>');
					}else{
						$("#msg_exito_acciones").html('<div class="alert alert-success" role="alert"><strong>Bien hecho!&nbsp;</strong>'+accion_con+' Acciones agregadas con éxito, para continuar puedes agregar los datos de los beneficiarios dando click en continuar o dar click en omitir para terminar el proceso de registro.</div>');
					}
					hideBtnAndShowNavBenef();
					getIdEstados(entidad_raci);
					autoCreateInputBenef(accion_con, response.data.contrato.id_con);
				}else if(response.success == false){
					toastrError(response.data.mensaje);
					enabledBtnAddAcciones();
				}
			});
		}
	}else if (pk_id_pro == 4) {
		if (accion_con == "" || accion_con == 0) {
			toastrError("El campo acción, es obligatorio.","Acción");
		}else if (pago_ben_con == "" || pago_ben_con == 0) {
			toastrError("El campo Pago Beneficiario, es obligatorio.","Pago Beneficiario");
		}else if (subsidio_con == "" || subsidio_con == 0) {
			toastrError("El campo Subsidio, es obligatorio.","Subsidio");
		}else{
			desabledBtnAddAcciones();
			__Ajax_JSON(url,data).done(function(response){
				if (response.success == true) {
					if (accion_con == 1) {
						$("#msg_exito_acciones").html('<div class="alert alert-success" role="alert"><strong>Bien hecho!&nbsp;</strong>Una acción agregada con éxito, para continuar puedes agregar los datos del beneficiario dando click en continuar o dar click en omitir para terminar el proceso de registro.</div>');
					}else{
						$("#msg_exito_acciones").html('<div class="alert alert-success" role="alert"><strong>Bien hecho!&nbsp;</strong>'+accion_con+' Acciones agregadas con éxito, para continuar puedes agregar los datos de los beneficiarios dando click en continuar o dar click en omitir para terminar el proceso de registro.</div>');
					}
					hideBtnAndShowNavBenef();
					getIdEstados(entidad_raci);
					autoCreateInputBenef(accion_con, response.data.contrato.id_con);
				}else if(response.success == false){
					toastrError(response.data.mensaje);
					enabledBtnAddAcciones();
				}
			});
		}

	}else if (pk_id_pro == 5) {
		if (accion_con == "" || accion_con == 0) {
			toastrError("El campo acción, es obligatorio.","Acción");
		}else if (pago_ben_con == "" || pago_ben_con == 0) {
			toastrError("El campo Pago Beneficiario, es obligatorio.","Pago Beneficiario");
		}else if (subsidio_con == "" || subsidio_con == 0) {
			toastrError("El campo Subsidio, es obligatorio.","Subsidio");
		}else{
			desabledBtnAddAcciones();
			__Ajax_JSON(url,data).done(function(response){
				if (response.success == true) {
					if (accion_con == 1) {
						$("#msg_exito_acciones").html('<div class="alert alert-success" role="alert"><strong>Bien hecho!&nbsp;</strong>Una acción agregada con éxito, para continuar puedes agregar los datos del beneficiario dando click en continuar o dar click en omitir para terminar el proceso de registro.</div>');
					}else{
						$("#msg_exito_acciones").html('<div class="alert alert-success" role="alert"><strong>Bien hecho!&nbsp;</strong>'+accion_con+' Acciones agregadas con éxito, para continuar puedes agregar los datos de los beneficiarios dando click en continuar o dar click en omitir para terminar el proceso de registro.</div>');
					}
					hideBtnAndShowNavBenef();
					getIdEstados(entidad_raci);
					autoCreateInputBenef(accion_con, response.data.contrato.id_con);
				}else if(response.success == false){
					toastrError(response.data.mensaje);
					enabledBtnAddAcciones();
				}
			});
		}

	}else if (pk_id_pro == 6) {
		if (accion_con == "") {
			toastrError("El campo acción, es obligatorio.","Acción");
		}else if (apoyo_insus_con == "" || apoyo_insus_con == 0) {
			toastrError("El campo Apoyo INSUS, es obligatorio.","Apoyo INSUS");
		}else if (subsidio_con == "" || subsidio_con == 0) {
			toastrError("El campo Subsidio, es obligatorio.","Subsidio");
		}else{
			desabledBtnAddAcciones();
			__Ajax_JSON(url,data).done(function(response){
				if (response.success == true){
					if (accion_con == 1) {
						$("#msg_exito_acciones").html('<div class="alert alert-success" role="alert"><strong>Bien hecho!&nbsp;</strong>Una acción agregada con éxito, para continuar puedes agregar los datos del beneficiario dando click en continuar o dar click en omitir para terminar el proceso de registro.</div>');
					}else{
						$("#msg_exito_acciones").html('<div class="alert alert-success" role="alert"><strong>Bien hecho!&nbsp;</strong>'+accion_con+' Acciones agregadas con éxito, para continuar puedes agregar los datos de los beneficiarios dando click en continuar o dar click en omitir para terminar el proceso de registro.</div>');
					}
					hideBtnAndShowNavBenef();
					getIdEstados(entidad_raci);
					autoCreateInputBenef(accion_con, response.data.contrato.id_con);
				}else if(response.success == false){
					toastrError(response.data.mensaje);
					enabledBtnAddAcciones();
				}
				
			});
		}

	}else if (pk_id_pro == 7) {
		if (rectificaciones_con == "" || rectificaciones_con == 0) {
			toastrError("El campo Rectificaciones, es obligatorio.","Rectificaciones");
		}else if (otros_con == "" || otros_con == 0) {
			toastrError("El campo Otros, es obligatorio.","Otros");
		}else{
			desabledBtnAddAcciones();
			__Ajax_JSON(url,data).done(function(response){ 
				if (response.success == true) {
					funcFinalizar();	
				}else if(response.success == false){
					toastrError(response.data.mensaje);
					enabledBtnAddAcciones();
				}
			});
		}
	}else{
		toastrError("Debes de seleccionar al menos un programa.","Programa");
	}
}

function funcFinalizar(){
		$("#nav1").removeClass("active");
		$("#nav2").removeClass("active");
		$("#nav3").removeClass("active");
		$("#nav4").addClass("active");
		$("#div_accion_y_programa").hide();
		$("#div_beneficiarios").hide();
		$("#div_finalizar").show();
}

function autoCreateInputBenef(acciones, id_con){
	//$("#btn_input_benef").hide();
	//$("#btn_omit").hide();
	console.log(acciones +"--- ok ---"+id_con)
	var inputAcc = "";
	inputAcc +='<form action="" id="form_addBeneficiarios">';
	inputAcc +='<input type="text" hidden="true" id="op" name="op" value="benef" class="border border-primary">';
	for (var i = 1; i <= acciones; i++) { 
		inputAcc +='<h5 class="text-center">Beneficiario &nbsp;'+i+'</h5>'; 
		inputAcc +='<table id="tabla" class=""><thead><tr><th>#&nbsp;&nbsp;&nbsp;&nbsp; </th><th>---Tipo--- </th><th>---- Columna ----</th><th>----Valor----</th></tr></thead>';
		inputAcc +='<tr  width="1">';
		inputAcc +='<td>'+ 1 +'</td>';
		inputAcc +='<td><label>Texto</label></td>';
		inputAcc +='<td><label>Nombre(s)</label></td>';
		inputAcc +='<td><input type="text" id="nombre_ben" name="nombre_ben[]" class="border border-primary"></td>';
		inputAcc +='</tr>';
		inputAcc +='<tr>';
		inputAcc +='<td>'+ 2 +'</td>';
		inputAcc +='<td><label>Texto</label></td>';
		inputAcc +='<td><label>Apellido Parterno</label></td>';
		inputAcc +='<td><input type="text" id="apellido_pat_ben" name="apellido_pat_ben[]" class="border border-primary"></td>';
		inputAcc +='</tr>';
		inputAcc +='<tr>';
		inputAcc +='<td>'+ 3 +'</td>';
		inputAcc +='<td><label>Texto</label></td>';
		inputAcc +='<td><label>Apellido Materno</label></td>';
		inputAcc +='<td><input type="text" id="apellido_mat_ben" name="apellido_mat_ben[]" class="border border-primary"></td>';
		inputAcc +='</tr>';
		inputAcc +='<tr>';
		inputAcc +='<td>'+ 4 +'</td>';
		inputAcc +='<td><label>Automático</label></td>';
		inputAcc +='<td><label>Genero</label></td>';
		inputAcc +='<td>';
		inputAcc +='<select id="genero_ben" name="genero_ben" class="border border-primary">';
            inputAcc +='<option selected>Selecciona el genero</option>';
            inputAcc +='<option value="1">Hombre</option>';
            inputAcc +='<option value="2">Mujer</option>';
            inputAcc +='<option value="3">Otro</option>';
        inputAcc +='</select>';
        inputAcc +='</td>';
		inputAcc +='</tr>';
		inputAcc +='<td>'+ 5 +'</td>';
		inputAcc +='<td><label>Automático</label></td>';
		inputAcc +='<td><label>Estado Civil</label></td>';
		inputAcc +='<td>';
		inputAcc +='<select id="estado_ben" name="estado_ben" class="border border-primary">';
            inputAcc +='<option selected>Selecciona el estado civil</option>';
            inputAcc +='<option value="Soltero">Soltero</option>';
            inputAcc +='<option value="Soltera">Soltera</option>';
            inputAcc +='<option value="Casado">Casado</option>';
            inputAcc +='<option value="Casada">Casada</option>';
            inputAcc +='<option value="Viudo">Viudo</option>';
            inputAcc +='<option value="Viuda">Viuda</option>';
            inputAcc +='<option value="Divorciado">Divorciado</option>';
            inputAcc +='<option value="Divorciada">Divorciada</option>';
        inputAcc +='</select>';
        inputAcc +='</td>';
		inputAcc +='</tr>'; 
		inputAcc +='<tr>';
		inputAcc +='<td>'+ 6 +'</td>';
		inputAcc +='<td><label>Numerico</label></td>';
		inputAcc +='<td><label>Zona</label></td>';
		inputAcc +='<td><input type="text" id="zona_ben" name="zona_ben[]" class="border border-primary"></td>';
		inputAcc +='</tr>';
		inputAcc +='<tr>';
		inputAcc +='<td>'+ 7 +'</td>';
		inputAcc +='<td><label>Numerico</label></td>';
		inputAcc +='<td><label>Manzana</label></td>';
		inputAcc +='<td><input type="text" id="manazana_ben" name="manazana_ben[]" class="border border-primary"></td>';
		inputAcc +='</tr>';
		inputAcc +='<tr>';
		inputAcc +='<td>'+ 8 +'</td>';
		inputAcc +='<td><label>Numerico</label></td>';
		inputAcc +='<td><label>Lote</label></td>';
		inputAcc +='<td><input type="text" id="lote_ben" name="lote_ben[]" class="border border-primary"></td>';
		inputAcc +='</tr>';
		inputAcc +='<tr>';
		inputAcc +='<td>'+ 9 +'</td>';
		inputAcc +='<td><label>Numerico</label></td>';
		inputAcc +='<td><label>Superficie Mts&sup2;</label></td>';
		inputAcc +='<td><input type="text" id="superficie_ben" name="superficie_ben[]" class="border border-primary"></td>';
		inputAcc +='</tr>';
		inputAcc +='<tr>';
		inputAcc +='<td>'+ 10 +'</td>';
		inputAcc +='<td><label>Automático</label></td>';
		inputAcc +='<td><label>Uso</label></td>';
		inputAcc +='<td>';
		inputAcc +='<select id="uso_ben" name="uso_ben[]" class="border border-primary">';
            inputAcc +='<option selected>Selecciona el tipo de uso</option>';
            inputAcc +='<option value="D">D</option>';
            inputAcc +='<option value="CH">CH</option>';
            inputAcc +='<option value="EC">EC</option>';
        inputAcc +='</select>';
        inputAcc +='</td>';
		inputAcc +='</tr>';
		inputAcc +='<tr>';
		inputAcc +='<td>'+ 11 +'</td>';
		inputAcc +='<td><label>Letras y Número&nbsp;&nbsp;</label></td>';
		inputAcc +='<td><label>Número de contrato (DJ 1)&nbsp;&nbsp;</label></td>';
		inputAcc +='<td><input type="text" id="numero_con_ben" name="numero_con_ben[]" class="border border-primary"></td>';
		inputAcc +='</tr>';
		inputAcc +='<tr>';
		inputAcc +='<td>'+ 12+'</td>';
		inputAcc +='<td><label>Letras y Número&nbsp;&nbsp; </label></td>';
		inputAcc +='<td><label>Número de contrato (DJ 2)&nbsp;&nbsp; </label></td>';
		inputAcc +='<td><input type="text" id="numero_con_compro_ben" name="numero_con_compro_ben[]" class="border border-primary"></td>';
		inputAcc +='</tr>';
		inputAcc +='<tr>';
		inputAcc +='<td>'+ 13+'</td>';
		inputAcc +='<td><label>Fecha</label></td>';
		inputAcc +='<td><label>Fecha de contrato</label></td>';
		inputAcc +='<td><input type="date" id="fecha_ben" name="fecha_ben[]" class="border border-primary"></td>';
		inputAcc +='</tr>';
		inputAcc +='<tr>';
		inputAcc +='<td>'+ 14+'</td>';
		inputAcc +='<td><label>Numerico</label></td>';
		inputAcc +='<td><label>Pago Beneficiario</label></td>';
		inputAcc +='<td><input type="text" id="pago_ben" name="pago_ben[]" class="border border-primary"></td>';
		inputAcc +='</tr>';
		inputAcc +='<tr>';
		inputAcc +='<td>'+ 15+'</td>';
		inputAcc +='<td><label>Numerico</label></td>';
		inputAcc +='<td><label>Apoyo Beneficiario</label></td>';
		inputAcc +='<td><input type="text" id="apoyo_ben" name="apoyo_ben[]" class="border border-primary"></td>';
		inputAcc +='</tr>';
		inputAcc +='<tr>';
		inputAcc +='<td><input type="text" hidden="true" id="pk_id_con" name="pk_id_con[]" value="'+id_con+'"> </td>';
		inputAcc +='</tr>';
	    inputAcc +='</tbody></table>';
    } 
    inputAcc +='</form>'; 
	$("#inputBeneficiarios").html(inputAcc);
}

/*Funcion para agregar*/
function addBeneficiarios(){
	data = new FormData($("#form_addBeneficiarios")[0]);
	__Ajax_FormData(urlBenef,data).done(function(response){
		if (response.success == true) {
			toastrExito(response.data.mensaje,"Beneficiario´s");
			$("#btn_omit").hide();
			$("#btn_input_benef").hide();
			$("#btn_save_ben").hide();
			$("#btn_next_ben").show();
		}else if(response.success == false){
			toastrExito(response.data.mensaje,"Beneficiario´s");
		}
	}).fail(function(resp){
		console.log(resp);
	});
}
/*Funcion para vaciar las variables y compos que se utilizaron para agregar acciones y beneficiariosx*/
function vaciarCamposAccBenef(){
	hideInput();
	$("#form_DatosPoblado")[0].reset();
	$("#form_addBeneficiarios")[0].reset();
}

/*Convertidor de texto mayusculas al inicio*/
function MaysInit(intoText){
	return intoText.toLowerCase()
            .trim()
            .split(' ')
            .map( v => v[0].toUpperCase() + v.substr(1) )
            .join(' '); 
} 

/*Navegacion para el modal  siguiente y anterior */
function next_and_before(argument) {

  	if (argument == 1) { 
	  	console.log("estads");	
	  	$("#div_est").show();
	  	$("#div_raci").hide();
		$("#div_pro_benef").hide();
		
	   }else if(argument == 2){
	   	console.log("raci");
	   	$("#div_est").hide();
	  	$("#div_raci").show();
		$("#div_pro_benef").hide();
	   }else if(argument == 3){
	   	console.log("acciones y beneficiarios");
	   	$("#div_est").hide();
	  	$("#div_raci").hide();
		$("#div_pro_benef").show();
		
	   }else{
	   	console.log("estados por defecto");
	   }
}