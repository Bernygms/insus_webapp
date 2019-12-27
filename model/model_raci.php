<?php
require_once('connection.php');
class Model_raci{
	protected $db; 
	public function __construct(){
		$this->db = DB();
	}
    #Busqueda de estados en la bd 
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
    #Funcion para actualizar el total de contratados en raci
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
    #Funcion para ediatar los datos  de un poblado
    public function editRaci_Poblado($id_raci,$entidad_raci,$clave_insus_raci,$clave_inegi_raci,$modalidad_raci,$nombre_de_pob_raci,$municipio_raci,$superficie_de_pob_raci,$municipio_pro_raci,$fecha_ini_con_raci,$universo_de_lot_raci,$total_con_raci){
        try {
            $query = $this->db->prepare("UPDATE raci SET 
            entidad_raci=:entidad_raci,
            clave_insus_raci=:clave_insus_raci, 
            clave_inegi_raci=:clave_inegi_raci,
            modalidad_raci=:modalidad_raci,
            nombre_de_pob_raci=:nombre_de_pob_raci,
            municipio_raci=:municipio_raci,
            superficie_de_pob_raci=:superficie_de_pob_raci,
            municipio_pro_raci=:municipio_pro_raci,
            fecha_ini_con_raci=:fecha_ini_con_raci,
            universo_de_lot_raci=:universo_de_lot_raci,
            total_con_raci=:total_con_raci  WHERE id_raci = :id_raci");

            $query->bindParam(":entidad_raci", $entidad_raci, PDO::PARAM_INT);
            $query->bindParam(":clave_insus_raci", $clave_insus_raci, PDO::PARAM_STR);
            $query->bindParam(":clave_inegi_raci", $clave_inegi_raci, PDO::PARAM_STR);
            $query->bindParam(":modalidad_raci", $modalidad_raci, PDO::PARAM_STR);
            $query->bindParam(":nombre_de_pob_raci", $nombre_de_pob_raci, PDO::PARAM_STR);
            $query->bindParam(":municipio_raci", $municipio_raci, PDO::PARAM_STR);
            $query->bindParam(":superficie_de_pob_raci", $superficie_de_pob_raci, PDO::PARAM_STR);
            $query->bindParam(":municipio_pro_raci", $municipio_pro_raci, PDO::PARAM_STR);
            $query->bindParam(":fecha_ini_con_raci", $fecha_ini_con_raci, PDO::PARAM_STR);
            $query->bindParam(":universo_de_lot_raci", $universo_de_lot_raci, PDO::PARAM_INT);
            $query->bindParam(":total_con_raci", $total_con_raci, PDO::PARAM_INT);
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
    #Funcion para crear un nuevo poblado
    
    public function addRaci_Poblado($entidad_raci,$clave_insus_raci,$clave_inegi_raci,$modalidad_raci,$nombre_de_pob_raci,$municipio_raci,$superficie_de_pob_raci,$municipio_pro_raci,$fecha_ini_con_raci,$universo_de_lot_raci,$total_con_raci){
        try {
            $query =  $this->db->prepare("INSERT INTO raci(entidad_raci,clave_insus_raci,clave_inegi_raci,modalidad_raci,nombre_de_pob_raci,municipio_raci,superficie_de_pob_raci,municipio_pro_raci,fecha_ini_con_raci,universo_de_lot_raci,total_con_raci) VALUES (?,?,?,?,?,?,?,?,?,?,?)");
            $r = $query->execute(array($entidad_raci,$clave_insus_raci,$clave_inegi_raci,$modalidad_raci,$nombre_de_pob_raci,$municipio_raci,$superficie_de_pob_raci,$municipio_pro_raci,$fecha_ini_con_raci,$universo_de_lot_raci,$total_con_raci));
            
            if ($r == true) {
                return $r;
            }else{
                return $r;
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function deletePoblado($id_raci)
    {
        $queryCont = $this->db->prepare("SELECT * FROM contratos WHERE pk_id_raci=:id_raci");
        $queryCont->bindParam(":id_raci", $id_raci, PDO::PARAM_INT);
        $queryCont->execute();
        $result =  $queryCont->fetchAll();
        if (!empty($result)) {
            foreach ($result as  $contrato) { 
                if ($id_raci ==  (int) $contrato['pk_id_raci']) {
                    return 3;
                }
            }
        }else{
            
            $query = $this->db->prepare("DELETE FROM raci WHERE id_raci=:id_raci");
            $query->bindParam(":id_raci", $id_raci, PDO::PARAM_INT);
            $result = $query->execute();
            if($result){
                return 1;
            }else{
                return 2;
            }
           
        }

    }
}
