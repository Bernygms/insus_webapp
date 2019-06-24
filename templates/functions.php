<?php 
 function estados($id_est){
	$estados = array(
		1 => 'AGUASCALIENTES', 
		2 => 'BAJA CALIFORNIA',
		3 => 'BAJA CALIFORNIA SUR', 
		4 => 'CAMPECHE', 
		5 => 'COAHUILA',
		7 => 'CHIAPAS',
		8 => 'CHIHUAHUA',
		9 =>'DISTRITO FEDERAL',
		10=>'DURANGO',
		11=>'GUANAJUATO',
		12=>'GUERRERO',
		13=>'HIDALGO',
		14=>'JALISCO',
		15=>'MÉXICO',
		16=>'MICHOACAN',
		17=>'MORELOS',
		18=>'NAYARIT',
		19=>'NUEVO LEON',
		20=>'OAXACA',
		21=>'PUEBLA',
		22=>'QUERETARO',
		23=>'QUINTANA ROO',
		24=>'SAN LUIS POTOSI',
		25=>'SINALOA',
		26=>'SONORA',
		27=>'TABASCO',
		28=>'TAMAULIPAS',
		29=>'TLAXCALA',
		30=>'VERACRUZ',
		31=>'YUCATAN',
		32=>'ZACATECAS');
	if ($id_est) {
		foreach ($estados as $key => $v) {
			if ($id_est == $key) {
				return $v;
			}
		}
	}else{
		return "Administrador";
	}
 }

?>