<?php
require_once('connection.php');
class Model_contratos{
	protected $db; 
	public function __construct(){
		$this->db = DB();
	}
    #Val contratos por mes, año y programa 
    public function getContratos($mes, $anno,$pk_id_pro){
        $query = $this->db->prepare("SELECT * FROM contratos WHERE mes_con=:mes AND anno_con=:anno AND pk_id_pro=:pk_id_pro");
        $query->bindParam(":mes", $mes, PDO::PARAM_STR); 
        $query->bindParam(":anno", $anno, PDO::PARAM_STR); 
        $query->bindParam(":pk_id_pro", $pk_id_pro, PDO::PARAM_INT);
        $valor = $query->execute();
        if ($valor) {   
            $data["success"] = true;
            $data["data"]["contratos"] = array();
            while($row = $query->fetch(PDO::FETCH_ASSOC)){
                $data["data"]["contratos"]  = $row;
            }
            return $data;   
        }else{
            return false;
        }
    }

}
