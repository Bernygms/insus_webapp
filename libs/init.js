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