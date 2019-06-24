<?php
require_once('connection.php');
class Model_estados{
	protected $db; 
	public function __construct(){
		$this->db = DB();
	}
    #busqueda de registros de los estados 
    public function getEstados($id_est, $rol_usu){
        if ($rol_usu == 1 || $rol_usu == 2) {
            $query = $this->db->prepare( "SELECT * FROM estados" );
        }else{
            if ($rol_usu == 3) {
                $query = $this->db->prepare("SELECT id_est,  nombre_est FROM estados WHERE id_est=:id_est");
                $query->bindParam(":id_est", $id_est, PDO::PARAM_INT);
            }
        }    
        $valor = $query->execute();
        if ($valor) {   
            $data["success"] = true;
            $data["data"]["estados"] = array();
            while($row = $query->fetchAll(PDO::FETCH_ASSOC)){
                $data["data"]["estados"]  = $row;
            }
            return $data;   
        }else{
            return false;
        }
    }

}

