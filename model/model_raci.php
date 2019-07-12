<?php
require_once('connection.php');
class Model_raci{
	protected $db; 
	public function __construct(){
		$this->db = DB();
	}
    #busqueda de registros de los estados 
    public function getRaci($entidad_raci){
        if ($entidad_raci ) {
            $query = $this->db->prepare("SELECT * FROM raci WHERE entidad_raci=:entidad_raci");
            $query->bindParam(":entidad_raci", $entidad_raci, PDO::PARAM_INT);
            $valor = $query->execute();
            if ($valor) {   
                $data["success"] = true;
                $data["data"]["raci"] = array();
                while($row = $query->fetchAll(PDO::FETCH_ASSOC)){
                    $data["data"]["raci"]  = $row;
                }
                return $data;   
            }else{
                return false;
            }
        }else{
            return false;                      
        }        
        
    }

    public function addAcciones(){
        #Write your code ...
    }

}
