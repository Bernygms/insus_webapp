$(function(){
	'use strict';
	//Ocultamos contenido al iniciar el sistema web 
	$("#div_raci").hide();
	$("#div_pro_benef").hide();
	$("#addaction").hide();
	//funcion init()  se obtine del script insus_app.js
	init();
	
	//Funcion de JQuery para la busqueda de estados en la tabla estados
	$("#buscar").keyup(function(){
	 		var _this = this;
	 		console.log(_this);
	 		// Show only matching TR, hide rest of them
			$.each($("#tabla tbody tr"), function() {
				if($(this).text().toLowerCase().indexOf($(_this).val().toLowerCase()) === -1)
					 $(this).hide();
	 			else
					 $(this).show();
	 		});
	});
	var nombre_usu = $("#nombre_usu").val();
	var apellidos_usu = $("#apellidos_usu").val();
	//Agregamos el nombre perfil
	$("#perfil_name").html(MaysInit(nombre_usu + " " + apellidos_usu));

	// Modal -

	$("#btn_next_1").click(function(){
		$("#div_datos_poblado").hide();
		$("#div_accion_y_programa").show();
		$("#nav1").removeClass("active");
		$("#nav2").addClass("active");
		//$("#nav3").addClass("active"); 
		//$("#nav4").addClass("active");
	});

	$("#btn_before_2").click(function(){
		$("#div_datos_poblado").show();
		$("#div_accion_y_programa").hide();
		$("#div_beneficiarios").hide();
		$("#nav1").addClass("active");
		$("#nav2").removeClass("active");
		$("#nav3").removeClass("active");
	});

	$("#btn_next_2").click(function(){
		//Variables para contratos
		var pk_id_pro = $("#pk_id_pro").val();

		var accion_con = $("#accion_con").val();
		var pago_ben_con = $("#pago_ben_con").val();
		var apoyo_insus_con = $("#apoyo_insus_con").val();
		var subsidio_con = $("#subsidio_con").val();
		//var mes_con = $("#").val();
		//var anno_con = $("#").val();
		//var fecha_con = $("#").val();
		//var fecha_edi_con = $("#").val();
		//var pk_id_raci = $("#").val();
		//Variables de apoyo de raci
		var pk_id_raci = $("#id_raci").val();
		var universo_de_lot_raci = $("#universo_de_lot_raci").val();
		var total_con_raci = $("#total_con_raci").val();
		if (pk_id_pro == 1) {
			toastrError("Regla 1 OK ","Regla 1");
			r = validarPrograma();

			

		}else if(pk_id_pro == 2){
			toastrError("Regla 2 OK ","Regla 2");
		}else if(pk_id_pro == 3){
			toastrError("Regla 3 OK ","Regla 3");
		}else if(pk_id_pro == 4){
			toastrError("PMU  OK ","PMU");
		}else if(pk_id_pro == 5){
			toastrError("PRAH  OK ","PRAH");
		}
		else if(pk_id_pro == 6){
			toastrError("PASPRAH  OK ","PASPRAH");
		}else if(pk_id_pro == 7){
			toastrError("OTROS  OK ","OTROS");
		}else{

		}
		
		
	});

	$("#btn_before_3").click(function(){
		$("#div_datos_poblado").hide();
		$("#div_accion_y_programa").show();
		$("#div_beneficiarios").hide();
		$("#nav2").addClass("active");
		$("#nav3").removeClass("active");
	});
});


/*Convertidor de texto mayusculas al inicio*/
function MaysInit(intoText){
	return intoText.toLowerCase()
            .trim()

            .split(' ')
            .map( v => v[0].toUpperCase() + v.substr(1) )
            .join(' '); 
}
//Libreria de JQuery DataTable() + Lenguage Espanol 
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
/*Navegacion para el modal  siguiente y anterior */
function next_and_before(argument) {
  // body...
  if (argument == 1) { 

   };
}

/*Navegacion para la  pagina siguiente y anterior */
function nextPage(){
	navigation++;
	console.log('' + navigation + '' );
}

function beforePage(){
	navigation--;
}
