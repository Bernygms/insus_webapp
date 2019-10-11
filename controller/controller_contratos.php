<?php
if (isset($_POST['op'])) {
    require_once('../model/model_contratos.php');
    require_once('../model/model_raci.php'); 

    $op =  (isset($_POST['op']) ? $_POST['op'] : NULL);#Dato para la consulta de de cada case 

    #variables de entrada para la tabla raci
    $id_raci =  (isset($_POST['id_raci']) ? $_POST['id_raci'] : NULL);
    $universo_de_lot_raci =  (isset($_POST['universo_de_lot_raci']) ? $_POST['universo_de_lot_raci'] : NULL);
    $total_con_raci =  (isset($_POST['total_con_raci']) ? $_POST['total_con_raci'] : NULL);

    #Variables de entrada contratos
    $id_con =  (isset($_POST['id_con']) ? $_POST['id_con'] : NULL);
    $accion_con =  trim((isset($_POST['accion_con']) ? $_POST['accion_con'] : NULL));
    $pago_ben_con =  trim((isset($_POST['pago_ben_con']) ? $_POST['pago_ben_con'] : NULL));
    $apoyo_insus_con =  trim((isset($_POST['apoyo_insus_con']) ? $_POST['apoyo_insus_con'] : NULL));
    $subsidio_con=  trim((isset($_POST['subsidio_con']) ? $_POST['subsidio_con'] : NULL));
    $rectificaciones_con =  trim((isset($_POST['rectificaciones_con']) ? $_POST['rectificaciones_con'] : NULL));
    $otros_con =  trim((isset($_POST['otros_con']) ? $_POST['otros_con'] : NULL));
    $mes_con =  (isset($_POST['mes_con']) ? $_POST['mes_con'] : NULL);
    $anno_con =  (isset($_POST['anno_con']) ? $_POST['anno_con'] : NULL);
    $fecha_con=  (isset($_POST['fecha_con']) ? $_POST['fecha_con'] : NULL);
    $fecha_edi_con =  (isset($_POST['fecha_edi_con']) ? $_POST['fecha_edi_con'] : NULL);
    $pk_id_raci =  (isset($_POST['pk_id_raci']) ? $_POST['pk_id_raci'] : NULL);
    $pk_id_pro =  (isset($_POST['pk_id_pro']) ? $_POST['pk_id_pro'] : NULL);

    #Varible para el manego de errores. 
    $new_total_cont_raci = 0;

    $objContratos = new Model_contratos();
    $objRaci = new Model_raci();
    header('Content-type: application/json; charset=utf-8');
    $data["success"] = false;

    switch($op) {
        case 'programa':
            # code...
            $response = $objContratos->getContratos($mes_con, $anno_con,$pk_id_pro,$pk_id_raci);
            if (!empty($response)) {
                header('Content-type: application/json; charset=utf-8');
                echo json_encode($response);
            }else{
                if ($response == false) {
                    $data["data"]["mensaje"] = "Lo sentimos, no encontramos resultados.";
                    echo json_encode($data);
                }
            }
            break;
        case 'insert':
            if ($pk_id_pro == 1) {
                if($accion_con == '' || $accion_con == 0 || !is_numeric($accion_con)){
                    $data["data"]["mensaje"] = "Algo salio mal, llena el campo Acción";
                    echo json_encode($data);
                } elseif ($pago_ben_con == '' || $pago_ben_con == 0 || !is_numeric($pago_ben_con)){
                    $data["data"]["mensaje"] = "Algo salio mal, llena el campo Pago Beneficiarios";
                    echo json_encode($data);
                } elseif ($apoyo_insus_con == '' || $apoyo_insus_con == 0 || !is_numeric($apoyo_insus_con) ){
                    $data["data"]["mensaje"] = "Algo salio mal, llena el campo Apoyo INSUS";
                    echo json_encode($data);
                }else{
                    $responseRaci = $objRaci->getIdRaci($pk_id_raci);
                    if ($responseRaci==false) {#If init / consulta de raci
                        $data["data"]["mensaje"] = "Algo salio mal intentalo de nuevo.";
                        echo json_encode($data);
                    }else{ 
                        foreach ($responseRaci as  $raci) {                       
                            if ($pk_id_raci == $raci['id_raci'] && $universo_de_lot_raci == $raci['universo_de_lot_raci'] && $total_con_raci == $raci['total_con_raci'] ) {
                                $new_total_cont_raci =  $total_con_raci+$accion_con;
                                if ($new_total_cont_raci <= $universo_de_lot_raci) {
                                    $response_contratos = $objContratos->addContratos($accion_con, $pago_ben_con, $apoyo_insus_con, 0, 0, 0, $mes_con, $anno_con,date("Y-m-d"),date("Y-m-d"), $pk_id_raci, $pk_id_pro);
                                    if (!empty($response_contratos)) {
                                        $responseUpdate = $objRaci->editRaciPoblado($pk_id_raci, $new_total_cont_raci);
                                        if ($responseUpdate ==  true) {
                                            #echo $responseUpdate;
                                            echo $response_contratos; 
                                        }
                                    }else{
                                        if($response_contratos == false){ 
                                            $data["data"]["mensaje"] = "No se pudo agregar, revice su conección.";
                                            echo json_encode($data);
                                        } 
                                    }
                                }else{
                                    $data["data"]["mensaje"] = "Verifica cuantas acciones o contratos puedes agregar, de acuerdo al universo de lotes."; 
                                    echo json_encode($data);
                                }
                                
                            } else {
                                $data["data"]["mensaje"] = "Algo salio mal intentalo con una nueva conección, recarga tu navegador web."; 
                                echo json_encode($data);
                            }
                        }
                   } #If end / consulta de raci
                }   
            }else if ($pk_id_pro == 2) {
                if($accion_con == '' || $accion_con == 0 || !is_numeric($accion_con)){
                    $data["data"]["mensaje"] = "Algo salio mal, llena el campo Acción";
                } elseif ($pago_ben_con == '' || $pago_ben_con == 0 || !is_numeric($pago_ben_con)){
                    $data["data"]["mensaje"] = "Algo salio mal, llena el campo Pago Beneficiarios";
                }else{
                    $responseRaci = $objRaci->getIdRaci($pk_id_raci);
                    if ($responseRaci==false) {#If init / consulta de raci
                        $data["data"]["mensaje"] = "Algo salio mal intentalo de nuevo.";
                    }else{ 
                        foreach ($responseRaci as  $raci) {                       
                            if ($pk_id_raci == $raci['id_raci'] && $universo_de_lot_raci == $raci['universo_de_lot_raci'] && $total_con_raci == $raci['total_con_raci'] ) {
                                $new_total_cont_raci =  $total_con_raci+$accion_con;
                                if ($new_total_cont_raci <= $universo_de_lot_raci) {
                                    $response_contratos = $objContratos->addContratos($accion_con, $pago_ben_con, 0, 0, 0, 0, $mes_con, $anno_con,date("Y-m-d"),date("Y-m-d"), $pk_id_raci, $pk_id_pro);
                                    if (!empty($response_contratos)) {
                                        $responseUpdate = $objRaci->editRaciPoblado($pk_id_raci, $new_total_cont_raci);
                                        if ($responseUpdate ==  true) {
                                            #echo $responseUpdate;
                                            echo $response_contratos; 
                                        }
                                    }else{
                                        if($response_contratos == false){   
                                            $data["data"]["mensaje"] = "No se pudo agregar, revice su conección."; 
                                            echo json_encode($data);
                                        } 
                                    }
                                }else{
                                    $data["data"]["mensaje"] = "Verifica cuantas acciones o contratos puedes agregar, de acuerdo al universo de lotes."; 
                                    echo json_encode($data); 
                                }
                                
                            } else {
                                $data["data"]["mensaje"] = "Algo salio mal intentalo con una nueva conección, recarga tu navegador web."; 
                                echo json_encode($data);
                            }
                        }
                   } #If end / consulta de raci
                }  
            }else if ($pk_id_pro == 3) {
                if($accion_con == '' || $accion_con == 0 || !is_numeric($accion_con)){
                    $data["data"]["mensaje"] = "Algo salio mal, llena el campo Acción";
                } elseif ($pago_ben_con == '' || $pago_ben_con == 0 || !is_numeric($pago_ben_con)){
                    $data["data"]["mensaje"] = "Algo salio mal, llena el campo Pago Beneficiarios";
                }else{
                    $responseRaci = $objRaci->getIdRaci($pk_id_raci);
                    if ($responseRaci==false) {#If init / consulta de raci
                        $data["data"]["mensaje"] = "Algo salio mal intentalo de nuevo.";
                    }else{ 
                        foreach ($responseRaci as  $raci) {                       
                            if ($pk_id_raci == $raci['id_raci'] && $universo_de_lot_raci == $raci['universo_de_lot_raci'] && $total_con_raci == $raci['total_con_raci'] ) {
                                $new_total_cont_raci =  $total_con_raci+$accion_con;
                                if ($new_total_cont_raci <= $universo_de_lot_raci) {
                                    $response_contratos = $objContratos->addContratos($accion_con, $pago_ben_con, 0, 0, 0, 0, $mes_con, $anno_con,date("Y-m-d"),date("Y-m-d"), $pk_id_raci, $pk_id_pro);
                                    if (!empty($response_contratos)) {
                                        $responseUpdate = $objRaci->editRaciPoblado($pk_id_raci, $new_total_cont_raci);
                                        if ($responseUpdate ==  true) {
                                            #echo $responseUpdate;
                                            echo $response_contratos; 
                                        }
                                    }else{
                                        if($response_contratos == false){
                                            $data["data"]["mensaje"] = "No se pudo agregar, revice su conección."; 
                                            echo json_encode($data);
                                        } 
                                    }
                                }else{
                                    $data["data"]["mensaje"] = "Verifica cuantas acciones o contratos puedes agregar, de acuerdo al universo de lotes."; 
                                    echo json_encode($data);

                                }
                                
                            } else {
                                $data["data"]["mensaje"] = "Algo salio mal intentalo con una nueva conección, recarga tu navegador web."; 
                                echo json_encode($data);
                            }
                        }
                   } #If end / consulta de raci
                }  
            }else if ($pk_id_pro == 4) {
                if($accion_con == '' || $accion_con == 0 || !is_numeric($accion_con)){
                    $data["data"]["mensaje"] = "Algo salio mal, llena el campo Acción";
                } elseif ($pago_ben_con == '' || $pago_ben_con == 0 || !is_numeric($pago_ben_con)){
                    $data["data"]["mensaje"] = "Algo salio mal, llena el campo Pago Beneficiarios";
                } elseif ($subsidio_con == '' || $subsidio_con == 0 || !is_numeric($subsidio_con)){
                    $data["data"]["mensaje"] = "Algo salio mal, llena el campo Subsidio";
                }else{
                    $responseRaci = $objRaci->getIdRaci($pk_id_raci);
                    if ($responseRaci==false) {#If init / consulta de raci
                        $data["data"]["mensaje"] = "Algo salio mal intentalo de nuevo.";
                    }else{ 
                        foreach ($responseRaci as  $raci) {                       
                            if ($pk_id_raci == $raci['id_raci'] && $universo_de_lot_raci == $raci['universo_de_lot_raci'] && $total_con_raci == $raci['total_con_raci'] ) {
                                $new_total_cont_raci =  $total_con_raci+$accion_con;
                                if ($new_total_cont_raci <= $universo_de_lot_raci) {
                                    $response_contratos = $objContratos->addContratos($accion_con, $pago_ben_con, 0,$subsidio_con, 0, 0, $mes_con, $anno_con,date("Y-m-d"),date("Y-m-d"), $pk_id_raci, $pk_id_pro);
                                    if (!empty($response_contratos)) {
                                        $responseUpdate = $objRaci->editRaciPoblado($pk_id_raci, $new_total_cont_raci);
                                        if ($responseUpdate ==  true) {
                                            #echo $responseUpdate;
                                            echo $response_contratos; 
                                        }
                                    }else{
                                        if($response_contratos == false){
                                            $data["data"]["mensaje"] = "No se pudo agregar, revice su conección."; 
                                            echo json_encode($data);
                                        } 
                                    }
                                }else{
                                    $data["data"]["mensaje"] = "Verifica cuantas acciones o contratos puedes agregar, de acuerdo al universo de lotes."; 
                                    echo json_encode($data);

                                }
                                
                            } else {
                                $data["data"]["mensaje"] = "Algo salio mal intentalo con una nueva conección, recarga tu navegador web."; 
                                echo json_encode($data);
                            }
                        }
                   } #If end / consulta de raci
                }  
            }else if ($pk_id_pro == 5) {
                if($accion_con == '' || $accion_con == 0 || !is_numeric($accion_con)){
                    $data["data"]["mensaje"] = "Algo salio mal, llena el campo Acción";
                } elseif ($pago_ben_con == '' || $pago_ben_con == 0 || !is_numeric($pago_ben_con)){
                    $data["data"]["mensaje"] = "Algo salio mal, llena el campo Pago Beneficiarios";
                } elseif ($subsidio_con == '' || $subsidio_con == 0 || !is_numeric($subsidio_con)){
                    $data["data"]["mensaje"] = "Algo salio mal, llena el campo Subsidio";
                }else{
                    $responseRaci = $objRaci->getIdRaci($pk_id_raci);
                    if ($responseRaci==false) {#If init / consulta de raci
                        $data["data"]["mensaje"] = "Algo salio mal intentalo de nuevo.";
                    }else{ 
                        foreach ($responseRaci as  $raci) {                       
                            if ($pk_id_raci == $raci['id_raci'] && $universo_de_lot_raci == $raci['universo_de_lot_raci'] && $total_con_raci == $raci['total_con_raci'] ) {
                                $new_total_cont_raci =  $total_con_raci+$accion_con;
                                if ($new_total_cont_raci <= $universo_de_lot_raci) {
                                    $response_contratos = $objContratos->addContratos($accion_con, $pago_ben_con, 0,$subsidio_con, 0, 0, $mes_con, $anno_con,date("Y-m-d"),date("Y-m-d"), $pk_id_raci, $pk_id_pro);
                                    if (!empty($response_contratos)) {
                                        $responseUpdate = $objRaci->editRaciPoblado($pk_id_raci, $new_total_cont_raci);
                                        if ($responseUpdate ==  true) {
                                            #echo $responseUpdate;
                                            echo $response_contratos; 
                                        }
                                    }else{
                                        if($response_contratos == false){
                                            $data["data"]["mensaje"] = "No se pudo agregar, revice su conección."; 
                                            echo json_encode($data);
                                        } 
                                    }
                                }else{
                                    $data["data"]["mensaje"] = "Verifica cuantas acciones o contratos puedes agregar, de acuerdo al universo de lotes."; 
                                    echo json_encode($data);

                                }
                                
                            } else {
                                $data["data"]["mensaje"] = "Algo salio mal intentalo con una nueva conección, recarga tu navegador web."; 
                                echo json_encode($data);
                            }
                        }
                   } #If end / consulta de raci
                }  
            }else if ($pk_id_pro == 6) {
                if($accion_con == '' || $accion_con == 0 || !is_numeric($accion_con)){
                    echo "Algo salio mal, llena el campo Acción";
                } elseif ($apoyo_insus_con == '' || $apoyo_insus_con == 0 || !is_numeric($apoyo_insus_con) ){
                    echo "Algo salio mal, llena el campo Apoyo INSUS";
                } elseif ($subsidio_con == '' || $subsidio_con == 0 || !is_numeric($subsidio_con)){
                    echo "Algo salio mal, llena el campo Subsidio";
                }else{
                    $responseRaci = $objRaci->getIdRaci($pk_id_raci);
                    if ($responseRaci==false) {#If init / consulta de raci
                        echo "Algo salio mal intentalo de nuevo.";
                    }else{ 
                        foreach ($responseRaci as  $raci) {                       
                            if ($pk_id_raci == $raci['id_raci'] && $universo_de_lot_raci == $raci['universo_de_lot_raci'] && $total_con_raci == $raci['total_con_raci'] ) {
                                $new_total_cont_raci =  $total_con_raci+$accion_con;
                                if ($new_total_cont_raci <= $universo_de_lot_raci) {
                                    $response_contratos = $objContratos->addContratos($accion_con,0,$apoyo_insus_con ,$subsidio_con, 0, 0, $mes_con, $anno_con,date("Y-m-d"),date("Y-m-d"), $pk_id_raci, $pk_id_pro);
                                    if (!empty($response_contratos)) {
                                        $responseUpdate = $objRaci->editRaciPoblado($pk_id_raci, $new_total_cont_raci);
                                        if ($responseUpdate ==  true) {
                                            #echo $responseUpdate;
                                            echo $response_contratos; 
                                        }
                                    }else{
                                        if($response_contratos == false){
                                            $data["data"]["mensaje"] = "No se pudo agregar, revice su conección."; 
                                            echo json_encode($data);
                                        } 
                                    }
                                }else{
                                    $data["data"]["mensaje"] = "Verifica cuantas acciones o contratos puedes agregar, de acuerdo al universo de lotes."; 
                                    echo json_encode($data);

                                }
                                
                            } else {
                                $data["data"]["mensaje"] = "Algo salio mal intentalo con una nueva conección, recarga tu navegador web."; 
                                echo json_encode($data);
                            }
                        }
                   } #If end / consulta de raci
                }  
            }else if ($pk_id_pro == 7) {
                $data["success"] = false;
                if($rectificaciones_con == '' || $rectificaciones_con == 0 || !is_numeric($rectificaciones_con)){
                    echo "";
                    echo json_encode($data["data"]["mensaje"] = "Algo salio mal, llena el campo Rectificaciones");
                } elseif ($otros_con == '' || $otros_con == 0 || !is_numeric($otros_con) ){
                    echo json_encode($data["data"]["mensaje"] = "Algo salio mal, llena el campo Otros");
                }else{
                    $responseRaci = $objRaci->getIdRaci($pk_id_raci);
                    if ($responseRaci==false) {#If init / consulta de raci
                        echo json_encode($data["data"]["mensaje"] = "Algo salio mal intentalo de nuevo.");
                    }else{ 
                        foreach ($responseRaci as  $raci) {                       
                            if ($pk_id_raci == $raci['id_raci']) {
                                    $response_contratos = $objContratos->addContratos(0,0,0 ,0, $rectificaciones_con, $otros_con, $mes_con, $anno_con,date("Y-m-d"),date("Y-m-d"), $pk_id_raci, $pk_id_pro);
                                    if (!empty($response_contratos)) {
                                            echo $response_contratos;
                                        }
                                    }else{
                                         if($response_contratos == false){
                                            $data["data"]["mensaje"] = "No se pudo agregar, revice su conección.";
                                            echo json_encode($data);
                                        } 
                                    }
                                
                            }
                        }
                   } #If end / consulta de raci  
            }else{
                $data["data"]["mensaje"] = "No encontramos los datos del programa.";
                echo json_encode($data);
            }
            break;
        #Consulta de beneficiarios de acuerdo al poblado 
        case 'cont_benef':
            $response_contratos = $objContratos->consultaContratos($anno_con, $pk_id_raci);
            if (!empty($response_contratos)) {
                echo json_encode($response_contratos);
            }else{
                $data["data"]["mensaje"] = "No encontramos resultados sobre contratos.";
                echo json_encode($data);
            }
            break;
        default:
            # mensaje por default
            $data["data"]["mensaje"] = "Default, datos no encontrados.";
            echo json_encode($data);
            break;
    }
}else{
    $data["data"]["mensaje"] = "Datos incompletos, respuesta default.";
    echo json_encode($data);
}

?>