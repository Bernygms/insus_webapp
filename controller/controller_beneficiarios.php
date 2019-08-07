<?php
if (isset($_POST['op'])) {
    header('Content-type: application/json; charset=utf-8');
    $data["success"] = false;
    require_once('../model/model_beneficiarios.php'); 
    #Dato para la consulta de de cada case 
    $op =  (isset($_POST['op']) ? $_POST['op'] : NULL);
    #Variables de entrada contratos                                                      
    //$id_ben =  (isset($_POST['id_ben']) ? $_POST['id_ben'] : NULL);
    $nombre_ben =  (isset($_POST['nombre_ben']) ? $_POST['nombre_ben'] : NULL);
    $apellido_pat_ben =  (isset($_POST['apellido_pat_ben']) ? $_POST['apellido_pat_ben'] : NULL);
    $apellido_mat_ben =  (isset($_POST['apellido_mat_ben']) ? $_POST['apellido_mat_ben'] : NULL);
    $genero_ben =  (isset($_POST['genero_ben']) ? $_POST['genero_ben'] : NULL);
    $estado_ben =  (isset($_POST['estado_ben']) ? $_POST['estado_ben'] : NULL);
    $zona_ben =  (isset($_POST['zona_ben']) ? $_POST['zona_ben'] : NULL);
    $manazana_ben =  (isset($_POST['manazana_ben']) ? $_POST['manazana_ben'] : NULL);
    $lote_ben =  (isset($_POST['lote_ben']) ? $_POST['lote_ben'] : NULL);
    $superficie_ben =  (isset($_POST['superficie_ben']) ? $_POST['superficie_ben'] : NULL);
    $uso_ben =  (isset($_POST['uso_ben']) ? $_POST['uso_ben'] : NULL);
    $numero_con_ben =  (isset($_POST['numero_con_ben']) ? $_POST['numero_con_ben'] : NULL);
    $numero_con_compro_ben =  (isset($_POST['numero_con_compro_ben']) ? $_POST['numero_con_compro_ben'] : NULL);
    $pago_ben =  (isset($_POST['pago_ben']) ? $_POST['pago_ben'] : NULL);
    $apoyo_ben =  (isset($_POST['apoyo_ben']) ? $_POST['apoyo_ben'] : NULL);
    $fecha_ben =  (isset($_POST['fecha_ben']) ? $_POST['fecha_ben'] : NULL);
    $pk_id_con =  (isset($_POST['pk_id_con']) ? $_POST['pk_id_con'] : NULL);
    #Variable de apoyo donde guardamos una cadena  de datos que seran enviados a la bd 
    $cadena_beneficiarios = "";
    #Instancia a la funcion modelo beneficiarios 
    $objBeneficiarios = new Model_beneficiarios();
    switch ($op) {
        case 'benef':
            for ($i=0; $i < count($pk_id_con); $i++) { 
                $cadena_beneficiarios.="'".$nombre_ben[$i]."','".$apellido_pat_ben[$i]."','".$apellido_mat_ben[$i]."'";
            }
            $data["success"] = true;
            $data["data"]["mensaje"] = $cadena_beneficiarios;
            echo json_encode($data);
            break;
        
        default:
            $data["data"]["mensaje"] = "Datos incompletos, respuesta default.";
            echo json_encode($data);
            break;
    }
}else{
    $data["data"]["mensaje"] = "Datos incompletos, respuesta default reporta la falla con el quipo de sistemas.";
    echo json_encode($data);
}
