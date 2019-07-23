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
    public function acceso($correo,$password,$app){
        $query = $this->db->prepare("SELECT id_usuario, nombre, usuario, correo, password, status, id_app_fk,id_estado_fk, nombre_app
            FROM usuarios INNER JOIN apps 
            ON usuarios.id_app_fk = apps.id_app  WHERE correo =:correo AND password=:password AND id_app_fk=:app");
        $query->bindParam(":correo", $correo, PDO::PARAM_STR);
        $query->bindParam(":password", $password, PDO::PARAM_STR);
        $query->bindParam(":app", $app, PDO::PARAM_INT);
        $query->execute();
        $result = $query-> fetchAll();
        if ($result) {
            return $result;
        }else{
            return false;
        }
    }

    public function addAcciones(){
        #Write your code ...
    }

}
