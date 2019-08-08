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

	//next en la primera btn del modal add
	$("#btn_next_1").click(function(){
		$("#div_datos_poblado").hide();
		$("#div_accion_y_programa").show();
		$("#nav1").removeClass("active");
		$("#nav2").addClass("active");
		//$("#nav3").addClass("active"); 
		//$("#nav4").addClass("active");
		$('#pk_id_pro').prop('selectedIndex',0);
		hideInput();
	});
	//Btn regresar a la seccion  Datos del poblado.
	$("#btn_before_2").click(function(){
		$("#div_datos_poblado").show();
		$("#div_accion_y_programa").hide();
		$("#div_beneficiarios").hide();
		$("#nav1").addClass("active");
		$("#nav2").removeClass("active");
		$("#nav3").removeClass("active");
	});
	//Validar onblur
	$("#accion_con").blur(function(){
		valAcciones();
	});
	//Btn para guardar las acciones
	$("#btn_next_2").click(function(){
		//Variables para contratos
		addAcciones();
	});
	$("#btn_input_benef").click(function(){
		$("#div_beneficiarios").show();
		$("#btn_input_benef").show();
	}); 
	$("#btn_omit").click(function(){
		funcFinalizar();
	}); 
	$("#btn_save_ben").click(function(){
		addBeneficiarios();
	});
	$("#btn_next_ben").click(function(){
		vaciarCamposAccBenef();
		funcFinalizar();
	});
	$("#btn_finalizar").click(function(){
	hideInput();
	$("#form_DatosPoblado")[0].reset();
	$("#myModalAddAcciones").modal('hide');
	});
	$("#btn_cancel_2").click(function(){
		$("#myModalAddAcciones").modal('hide');
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
