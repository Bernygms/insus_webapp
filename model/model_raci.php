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
    #Funcion de apoyo en controlador, para agrgar aciones y editar en raci editRaciPoblado()
    public function getIdRaci($id_raci){
        $query = $this->db->prepare("SELECT * FROM raci WHERE id_raci=:id_raci");
        $query->bindParam(":id_raci", $id_raci, PDO::PARAM_INT);
        $query->execute();
        $result = $query-> fetchAll();
        if ($result) {
            return $result;
        }else{
            return false;
        }
    }

    public function editRaciPoblado($id_raci, $new_total_cont_raci){
        try {
            $query = $this->db->prepare("UPDATE raci SET  total_con_raci=:total_con_raci  WHERE id_raci = :id_raci");
            $query->bindParam(":total_con_raci", $new_total_cont_raci, PDO::PARAM_STR);
            $query->bindParam(":id_raci", $id_raci, PDO::PARAM_INT);
            $r = $query->execute();
            if ($r == true) {
                return $r;
            }else{
                return $r;
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
}
