<?php
require_once('connection.php');
class Model_contratos{
	protected $db; 
	public function __construct(){
		$this->db = DB();
	}
    #Val contratos por mes, año y programa 
    public function getContratos($mes, $anno,$pk_id_pro, $pk_id_raci){
        $query = $this->db->prepare("SELECT * FROM contratos WHERE mes_con=:mes AND anno_con=:anno AND pk_id_pro=:pk_id_pro AND pk_id_raci=:pk_id_raci");
        $query->bindParam(":mes", $mes, PDO::PARAM_STR); 
        $query->bindParam(":anno", $anno, PDO::PARAM_STR); 
        $query->bindParam(":pk_id_pro", $pk_id_pro, PDO::PARAM_INT);
        $query->bindParam(":pk_id_raci", $pk_id_raci, PDO::PARAM_INT);
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
    #Funcion para agregar nuevo contrato o accion 
    public function addContratos($accion_con, $pago_ben_con, $apoyo_insus_con, $subsidio_con, $rectificaciones_con, $otros_con, $mes_con, $anno_con, $fecha_con, $fecha_edi_con, $pk_id_raci, $pk_id_pro){
        try {
            $query =  $this->db->prepare("INSERT INTO contratos(accion_con,pago_ben_con,apoyo_insus_con,subsidio_con,rectificaciones_con,otros_con,mes_con,anno_con,fecha_con,fecha_edi_con,pk_id_raci,pk_id_pro) VALUES (?,?,?,?,?,?,?,?,?,?,?,?)");
            $result = $query->execute(array($accion_con, $pago_ben_con, $apoyo_insus_con, $subsidio_con, $rectificaciones_con, $otros_con, $mes_con, $anno_con, $fecha_con, $fecha_edi_con, $pk_id_raci, $pk_id_pro));
            if ($result == true) {
                $data["success"] = true;
                $datos = [
                            'id_con' =>$this->db->LastInsertId(),
                             'accion_con' =>$accion_con, 
                             'pago_ben_con' =>$pago_ben_con,
                             'apoyo_insus_con' =>$apoyo_insus_con,
                             'subsidio_con' =>$subsidio_con,
                             'rectificaciones_con' =>$rectificaciones_con,
                             'otros_con' =>$otros_con,
                             'mes_con' =>$mes_con,
                             'anno_con' =>$anno_con,
                             'fecha_con' =>$fecha_con,
                             'fecha_edi_con' =>$fecha_edi_con,
                             'pk_id_raci' =>$pk_id_raci,
                             'pk_id_pro' =>$pk_id_pro
                        ];
                $data["data"]["contrato"] = $datos;
                return json_encode($data);
            }else{
                return false;
            }
        } catch(PDOException $e) {
            echo $e->getMessage();
        }
        
    }
    #Consulta de acciones + beneficiarios in process 
    #Integrasr en el objeto  contratos, 
    
    public function consultaContratos($anno, $pk_id_raci){
        #select * from contratos where pk_id_raci = 1 and anno_con=2019
        $query0 = $this->db->prepare("SELECT * FROM contratos c  WHERE c.anno_con=:anno AND c.pk_id_raci=:pk_id_raci");
        $query0->bindParam(":anno", $anno, PDO::PARAM_INT); 
        $query0->bindParam(":pk_id_raci", $pk_id_raci, PDO::PARAM_INT);
        $valor_c = $query0->execute();

        #Consulta de contratos con beneficiarios asignados
        $query = $this->db->prepare("SELECT * FROM contratos c INNER JOIN beneficiarios b ON c.id_con = b.pk_id_con WHERE c.anno_con=:anno AND c.pk_id_raci=:pk_id_raci");
        $query->bindParam(":anno", $anno, PDO::PARAM_INT); 
        $query->bindParam(":pk_id_raci", $pk_id_raci, PDO::PARAM_INT);
        $valor = $query->execute();

        if ($valor == true && $valor_c ==  true) {   
            $data["success"] = true;
            $data["data"]["contratos0"] = array();
            $cadena=[];
            $cadena_otros=[];
            $rows = $query0->fetchAll(PDO::FETCH_ASSOC);
            $total_r = count($rows);

            for($i = 0; $i < $total_r; $i++ ){
                $id_send = 0;
                if ($rows[$i]['pk_id_pro'] == 7) {
                    # code...

                }else{ 
                    $id_send =  $rows[$i]['id_con'];
                    if( true == $this->valExist($id_send)){   
                        $data["data"]["prueba_error"]=  $i;
                    }else{
                        $cadena[] = $rows[$i];
                    }
                    $data["data"]["contratos0"] = $cadena;
                }
                #Regresa obj de otros rectificaciones
                if ($rows[$i]['pk_id_pro'] == 7) {
                    $cadena_otros[] = $rows[$i];
                }
                $data["data"]["contratos00"] = $cadena_otros;
            }
            #Contratos funcional, no tocal 
            $data["data"]["contratos"] = array();
            while($row = $query->fetchAll(PDO::FETCH_ASSOC)){
                $data["data"]["contratos"]  = $row;
            }
            return $data;   
        }else{
            return false;
        }
    }

    public function valExist($id_con){
        $data = 0;
        $query = $this->db->prepare("SELECT pk_id_con FROM beneficiarios  WHERE pk_id_con=:id_con");
        $query->bindParam(":id_con", $id_con, PDO::PARAM_INT);
        $result = $query->execute();
        $rows = $query->fetchAll(PDO::FETCH_ASSOC);
        #var_dump($result);
        if ($result) {
            $val = count($rows); 
            for ($i=0; $i < $val; $i++) { 
                if ($rows[$i]['pk_id_con'] == $id_con) {
                    $data = 1;
                }else{
                    $data = 0;
                }
            }
        }else{
            $data = 0;
        }
        return $data;
    }
}
