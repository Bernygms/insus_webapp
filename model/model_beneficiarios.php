<?php 
#import coneccion 
require_once('connection.php');
class Model_beneficiarios{
	protected $db;
	#inicializamos la base de datos en el contructor
	public function __construct(){
		$this->db = DB();
	}
	#agregamos los beneficiarios. 
	function addBeneficiarios(){
			
	}

}
