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
	#Validacion de numero de contratos de cada benef ... 
	function valNumContratoBenef($numero_con_ben,$numero_con_compro_ben){ 
		if ($numero_con_ben) {
			#var_dump($numero_con_ben);
			$query = $this->db->prepare("SELECT id_ben FROM beneficiarios  WHERE  numero_con_ben=:numero_con_ben");
			$query->bindParam(":numero_con_ben",$numero_con_ben, PDO::PARAM_STR);
		}else{
			if ($numero_con_compro_ben) {
				# code...
				$query = $this->db->prepare("SELECT * FROM beneficiarios  WHERE  numero_con_compro_ben=:numero_con_compro_ben ");
				$query->bindParam(":numero_con_compro_ben",$numero_con_compro_ben, PDO::PARAM_STR);
			}
		}
        $query->execute();
        $result = $query-> fetch();
        if (!empty($result)) {
        	$retorno = true;
        }else{
            $retorno = false;
        }
        return $retorno;
	}

}
