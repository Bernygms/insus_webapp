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
	function addBeneficiarios($data){
		if ($data) {
			try {
				$sql = "INSERT INTO  beneficiarios(nombre_ben,apellido_pat_ben,apellido_mat_ben,genero_ben,estado_ben,zona_ben,manazana_ben,lote_ben,superficie_ben,uso_ben,numero_con_ben,numero_con_compro_ben,pago_ben,apoyo_insus_ben,subsidio_ben,fecha_ben,pk_id_con) VALUES ".$data; 
				$query = $this->db->prepare($sql); 
				$result = $query->execute();
				if ($result) {
					return true;
				}else{
					return false;
				}
			} catch (PDOException $e) {
				echo $e->getMessage();
			}
		}else{
			return false;
		}
	}

}
