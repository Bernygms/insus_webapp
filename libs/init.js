$(function(){
	'use strict';
	
	$("#div_raci").hide();
	init();

	$('.accordian-body').on('show.bs.collapse', function () {
    	$(this).closest("table")
        .find(".collapse.in")
        .not(this)
        .collapse('toggle')
   });
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

});
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