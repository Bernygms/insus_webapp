$(function(){
	'use strict';
	//Ocultamos contenido al iniciar el sistema web 
	$("#div_raci").hide();
	$("#div_pro_benef").hide();
	$("#addaction").hide();
	//funcion init()  se obtine del script insus_app.js
	init();
	//Funcion de JQuery para la busqueda de estados en la tabla estados
	deshabilitaRetroceso();
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
	/*Inicia validacion del modal add acciones y beneficiarios*/
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
		$("#btn_save_ben").show();
	}); 
	$("#btn_omit").click(function(){
		funcFinalizar();
	}); 
	$("#btn_save_ben").click(function(){
		//No funcional siguiente linea de codigo 
		//valArrayInputsBenef();
		//La siguiente funcion , es encargado de registrar los beneficiarios envia datos en formato tipo array 
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
		$("#form_DatosPoblado")[0].reset();
		$("#myModalAddAcciones").modal('hide');
	});	
	/*Finaliza validacion del modal add acciones y beneficiarios*/
	/*before  and next */
	$("#btn_nextPage").click(function(){ 		
		if (count >= 1 && count < 3) {
			count++;
			next_and_before(count);
		}else{
			next_and_before(count);
			if (count == 3) {
				$("#btn_nextPage").css("color", "#9b9b9b");
				$('#btn_nextPage').attr("disabled", true);
				$('#btn_beaforPage').attr("disabled", false);
			}
		}
		console.log(count);
	});
	$("#btn_beaforPage").click(function(){
		if (count > 1 && count <= 3) {
			count--;
			next_and_before(count);
		}else{
			next_and_before(count);
			if (count == 1) {
				$("#btn_beaforPage").css("color", "#9b9b9b");
				$('#btn_nextPage').attr("disabled", false);
				$('#btn_beaforPage').attr("disabled", true);
			}
		} 
		console.log(count);
	}); 
	
	$('.botonF1').hover(function(){
		$('.btn-pers').addClass('animacionVer');
	})
	$('.contenedor').mouseleave(function(){
		$('.btn-pers').removeClass('animacionVer');
	});
	
	/*Validar la btn mas*/
	$('#mas1').click(function(){
		$("p#titulo_prog_benef").html("Acciones y Beneficiarios");
		$('.btn-pers').removeClass('animacionVer');
	});
	$('#mas2').click(function(){
		$("p#titulo_prog_benef").html("Acciones");
	});
	$('#mas3').click(function(){
		$("p#titulo_prog_benef").html("Otros Rectificaciones");
	});


}); 