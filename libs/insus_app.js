  /******************************************************/
	 var url = '../controller/controller_insus_app.php';
	 var navigation = 0;
	 var estados = []; 
	 var raci = [];
	 var estadosArray = ['undefined','AGUASCALIENTES','BAJA CALIFORNIA','BAJA CALIFORNIA SUR','CAMPECHE','COAHUILA','COLIMA','CHIAPAS','CHIHUAHUA','DISTRITO FEDERAL','DURANGO','GUANAJUATO','GUERRERO','HIDALGO','JALISCO','MÉXICO','MICHOACAN','MORELOS','NAYARIT','NUEVO LEON','OAXACA','PUEBLA','QUERETARO','QUINTANA ROO','SAN LUIS POTOSI','SINALOA','SONORA','TABASCO','TAMAULIPAS','TLAXCALA','VERACRUZ','YUCATAN','ZACATECAS'];
	 var meses = new Array ("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
	 var total_nuevo_con = null;
	 var fecha = null;
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
		data = {op: "raci",entidad_raci: entidad_raci}
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
		$("#ac1").hide();
		$("#ac2").hide();
		$("#ac3").hide();
		$("#ac4").hide();
		$("#ac5").hide();
		$("#ac6").hide();
		$("#btn_next_2").hide(); //Btn
		$('#myModalAddAcciones').modal({backdrop: 'static', keyboard: false});
		$("#myModalAddAcciones").modal('show');
		$("#nav1").removeClass("active");
		$("#nav2").removeClass("active");
		$("#nav3").removeClass("active");
		$("#nav1").addClass("active");
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
			data = {op: "pro", mes_con: mes_con, anno_con:anno_con, pk_id_pro: pk_id_pro, pk_id_raci:pk_id_raci};
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
					$("#btn_next_2").show(); //Btn
				}else{
					toastrError("Ya existe un resgitro de este mes de "+ mes_con+", ve a consulta para editar.","Regla 1");
					hideInput();
					$("#btn_next_2").hide(); //Btn
				}
			});
			
		}else if(pk_id_pro == 2){
			data = {op: "pro", mes_con: mes_con, anno_con:anno_con, pk_id_pro: pk_id_pro, pk_id_raci:pk_id_raci};
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
					$("#btn_next_2").show(); //Btn
				}else{
					toastrError("Ya existe un resgitro de este mes de "+ mes_con+", ve a consulta para editar.","Regla 2");
					hideInput();
					$("#btn_next_2").hide(); //Btn
				}
			});
		}else if(pk_id_pro == 3){
			data = {op: "pro", mes_con: mes_con, anno_con:anno_con, pk_id_pro: pk_id_pro, pk_id_raci:pk_id_raci};
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
					$("#btn_next_2").show(); //Btn
				}else{
					toastrError("Ya existe un resgitro de este mes de "+ mes_con+", ve a consulta para editar.","Regla 3");
					hideInput();
					$("#btn_next_2").hide(); //Btn
				}
			});
		}else if(pk_id_pro == 4){
			data = {op: "pro", mes_con: mes_con, anno_con:anno_con, pk_id_pro: pk_id_pro, pk_id_raci:pk_id_raci};
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
					$("#btn_next_2").show(); //Btn
				}else{
					toastrError("Ya existe un resgitro de este mes de "+ mes_con+", ve a consulta para editar.","PMU");
					hideInput();
					$("#btn_next_2").hide(); //Btn
				}
			});
		}else if(pk_id_pro == 5){
			data = {op: "pro", mes_con: mes_con, anno_con:anno_con, pk_id_pro: pk_id_pro, pk_id_raci:pk_id_raci};
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
					$("#btn_next_2").show(); //Btn
				}else{
					toastrError("Ya existe un resgitro de este mes de "+ mes_con+", ve a consulta para editar.","PRAH");
					hideInput();
					$("#btn_next_2").hide(); //Btn
				}
			});
		}else if(pk_id_pro == 6){
			data = {op: "pro", mes_con: mes_con, anno_con:anno_con, pk_id_pro: pk_id_pro, pk_id_raci:pk_id_raci};
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
					$("#btn_next_2").show(); //Btn
				}else{
					toastrError("Ya existe un resgitro de este mes de "+ mes_con+", ve a consulta para editar.","PASPRAH");
					hideInput();
					$("#btn_next_2").hide(); //Btn
				}
			});
		}else if(pk_id_pro == 7){
			data = {op: "pro", mes_con: mes_con, anno_con:anno_con, pk_id_pro: pk_id_pro, pk_id_raci:pk_id_raci};
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
					$("#btn_next_2").show(); //Btn
				}else{
					toastrError("Ya existe un resgitro de este mes de "+ mes_con+", ve a consulta para editar.","OTROS RECTIFICACIONES");
					hideInput();
					$("#btn_next_2").hide(); //Btn
				}
			});	
		}else{
			toastrError("Selecciona un programa ","Programas");
			hideInput();
			$("#btn_next_2").hide(); //Btn
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
			toastrExito("Se valido con exito, posdemos agregar las acciones indicadas.", "Validación");
		}else{
			toastrError("La suma total de acciones, supera el universo de lotes.", "Vuelve a intentar");
			$("#accion_con").val("");
		}

	}
}

function addAcciones(){
	
	accion_con = $("#accion_con").val();
	pago_ben_con = $("#pago_ben_con").val();
	apoyo_insus_con = $("#apoyo_insus_con").val();
	subsidio_con = $("#subsidio_con").val();
	rectificaciones_con = $("#rectificaciones_con").val();
	otros_con = $("#otros_con").val();
	mes_con = meses[fecha.getMonth()];
	anno_con = fecha.getFullYear();
	pk_id_pro = $("#pk_id_pro").val();

	//Variables de apoyo de raci
	pk_id_raci = $("#id_raci").val();
	universo_de_lot_raci = $("#universo_de_lot_raci").val();
	total_con_raci = $("#total_con_raci").val();
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
		if (accion_con == "") {
			toastrError("El campo acción, es obligatorio.","Acción");
		}else if (pago_ben_con == "") {
			toastrError("El campo Pago Beneficiario, es obligatorio.","Pago Beneficiario");
		}else if (apoyo_insus_con == "") {
			toastrError("El campo Apoyo INSUS, es obligatorio.","Apoyo INSUS");
		}else{
			__Ajax_JSON(url,data).done(function(response){

			});
		}
	}else if (pk_id_pro == 2) {
		if (accion_con == "") {
			toastrError("El campo acción, es obligatorio.","Acción");
		}else if (pago_ben_con == " ") {
			toastrError("El campo Pago Beneficiario, es obligatorio.","Pago Beneficiario");
		}else{
			__Ajax_JSON(url,data).done(function(response){

			});
		}
	}else if (pk_id_pro == 3) {
		if (accion_con == " ") {
			toastrError("El campo acción, es obligatorio.","Acción");
		}else if (pago_ben_con == "") {
			toastrError("El campo Pago Beneficiario, es obligatorio.","Pago Beneficiario");
		}else{
			__Ajax_JSON(url,data).done(function(response){

			});
		}
	}else if (pk_id_pro == 4) {
		if (accion_con == "") {
			toastrError("El campo acción, es obligatorio.","Acción");
		}else if (pago_ben_con == "") {
			toastrError("El campo Pago Beneficiario, es obligatorio.","Pago Beneficiario");
		}else if (subsidio_con == "") {
			toastrError("El campo Subsidio, es obligatorio.","Subsidio");
		}else{
			__Ajax_JSON(url,data).done(function(response){

			});
		}

	}else if (pk_id_pro == 5) {
		if (accion_con == "") {
			toastrError("El campo acción, es obligatorio.","Acción");
		}else if (pago_ben_con == "") {
			toastrError("El campo Pago Beneficiario, es obligatorio.","Pago Beneficiario");
		}else if (subsidio_con == "") {
			toastrError("El campo Subsidio, es obligatorio.","Subsidio");
		}else{
			__Ajax_JSON(url,data).done(function(response){

			});
		}

	}else if (pk_id_pro == 6) {
		if (accion_con == "") {
			toastrError("El campo acción, es obligatorio.","Acción");
		}else if (apoyo_insus_con == "") {
			toastrError("El campo Apoyo INSUS, es obligatorio.","Apoyo INSUS");
		}else if (subsidio_con == "") {
			toastrError("El campo Subsidio, es obligatorio.","Subsidio");
		}else{
			__Ajax_JSON(url,data).done(function(response){

			});
		}

	}else if (pk_id_pro == 7) {
		if (rectificaciones_con == "" || rectificaciones_con == null) {
			toastrError("El campo Rectificaciones, es obligatorio.","Rectificaciones");
		}else if (otros_con == "" || otros_con == null) {
			toastrError("El campo Otros, es obligatorio.","Otros");
		}else{
			__Ajax_JSON(url,data).done(function(response){

			});
		}
	}else{
		toastrError("No exist el programa.","Programa");
	}
}