<?php 
require_once('../model/model_estados.php');
require_once('../model/model_raci.php');
require_once('../model/model_contratos.php');

if (isset($_POST['op'])) {
    $op =  (isset($_POST['op']) ? $_POST['op'] : NULL);#Dato para la consulta de de cada case 
    #Variable de entrada para la tabla estados 
    $id_est =  (isset($_POST['id_est']) ? $_POST['id_est'] : NULL);#Identificador de cada estado 
    $nombre_est =  (isset($_POST['nombre_est']) ? $_POST['nombre_est'] : NULL);#Campo para el 
    #variables de entrada para la tabla raci
    $id_raci =  (isset($_POST['id_raci']) ? $_POST['id_raci'] : NULL);
    $entidad_raci =  (isset($_POST['entidad_raci']) ? $_POST['entidad_raci'] : NULL);
    $clave_insus_raci =  (isset($_POST['clave_insus_raci']) ? $_POST['clave_insus_raci'] : NULL);
    $clave_inegi_raci =  (isset($_POST['clave_inegi_raci']) ? $_POST['clave_inegi_raci'] : NULL);
    $modalidad_raci =  (isset($_POST['modalidad_raci']) ? $_POST['modalidad_raci'] : NULL);
    $nombre_de_pob_raci =  (isset($_POST['nombre_de_pob_raci']) ? $_POST['nombre_de_pob_raci'] : NULL);
    $municipio_raci =  (isset($_POST['municipio_raci']) ? $_POST['municipio_raci'] : NULL);
    $superficie_de_pob_raci=  (isset($_POST['superficie_de_pob_raci']) ? $_POST['superficie_de_pob_raci'] : NULL);
    $municipio_pro_raci =  (isset($_POST['municipio_pro_raci']) ? $_POST['municipio_pro_raci'] : NULL);
    $fecha_ini_con_raci =  (isset($_POST['fecha_ini_con_raci']) ? $_POST['fecha_ini_con_raci'] : NULL);
    $universo_de_lot_raci =  (isset($_POST['universo_de_lot_raci']) ? $_POST['universo_de_lot_raci'] : NULL);
    $total_con_raci =  (isset($_POST['total_con_raci']) ? $_POST['total_con_raci'] : NULL);

    #variable para validar la consultas por roles
    $rol_usu =  (isset($_POST['rol_usu']) ? $_POST['rol_usu'] : NULL);

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
    $mgs_error = "";
    $new_total_cont_raci = 0;

    $objContratos = new Model_contratos();
    $objRaci = new Model_raci();

    switch($op) {
        case 'estados':
            # Consulta a la tabla estados
            if ($rol_usu == 0 || $rol_usu == "" || $id_est == "" || $id_est == 0) {
                echo "Lo sentimos, algo salio mal.  :( ";
            }else{
                $objEstados = new Model_estados();
                $response = $objEstados->getEstados($id_est,$rol_usu);
                if (!empty($response)) {
                    header('Content-type: application/json; charset=utf-8');
                    echo json_encode($response);
                }else{
                    if ($response == false) {
                        echo "Lo sentimos, no encontramos resultados.";
                    }
                }
            }
            break;
        case 'raci':
            $responseRaci = $objRaci->getRaci($entidad_raci);
            if (!empty($responseRaci)) {
                header('Content-type: application/json; charset=utf-8');
                echo json_encode($responseRaci);
            }else{
                if ($responseRaci == false) {
                    echo "Lo sentimos, no encontramos resultados.";
                }
            }
            break;
        case 'programa':
            # code...
            $response = $objContratos->getContratos($mes_con, $anno_con,$pk_id_pro,$pk_id_raci);
           if (!empty($response)) {
                header('Content-type: application/json; charset=utf-8');
                echo json_encode($response);
            }else{
                if ($response == false) {
                    echo "Lo sentimos, no encontramos resultados.";
                }
            }
            break;
        case 'insert':
            if ($pk_id_pro == 1) {
                if($accion_con == '' || $accion_con == 0 || !is_numeric($accion_con)){
                    echo "Algo salio mal, llena el campo Acción";
                } elseif ($pago_ben_con == '' || $pago_ben_con == 0 || !is_numeric($pago_ben_con)){
                    echo "Algo salio mal, llena el campo Pago Beneficiarios";
                } elseif ($apoyo_insus_con == '' || $apoyo_insus_con == 0 || !is_numeric($apoyo_insus_con) ){
                    echo "Algo salio mal, llena el campo Apoyo INSUS";
                }else{
                    $responseRaci = $objRaci->getIdRaci($pk_id_raci);
                    if ($responseRaci==false) {#If init / consulta de raci
                        echo "Algo salio mal intentalo de nuevo.";
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
                                            header('Content-type: applicat  ion/json; charset=utf-8');
                                            echo $response_contratos;
                                        }
                                    }else{
                                        if($response_contratos == false) echo "No se pudo agregar, revice su conección.";
                                    }
                                }else{
                                    echo "Verifica cuantas acciones o contratos puedes agregar, de acuerdo al universo de lotes.";
                                }
                                
                            } else {
                                echo "Algo salio mal intentalo con una nueva conección, recarga tu navegador web.";
                            }
                        }
                   } #If end / consulta de raci
                }   
            }else if ($pk_id_pro == 2) {
                if($accion_con == '' || $accion_con == 0 || !is_numeric($accion_con)){
                    echo "Algo salio mal, llena el campo Acción";
                } elseif ($pago_ben_con == '' || $pago_ben_con == 0 || !is_numeric($pago_ben_con)){
                    echo "Algo salio mal, llena el campo Pago Beneficiarios";
                }else{
                    $responseRaci = $objRaci->getIdRaci($pk_id_raci);
                    if ($responseRaci==false) {#If init / consulta de raci
                        echo "Algo salio mal intentalo de nuevo.";
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
                                            header('Content-type: applicat  ion/json; charset=utf-8');
                                            echo $response_contratos;
                                        }
                                    }else{
                                        if($response_contratos == false) echo "No se pudo agregar, revice su conección.";
                                    }
                                }else{
                                    echo "Verifica cuantas acciones o contratos puedes agregar, de acuerdo al universo de lotes.";
                                }
                                
                            } else {
                                echo "Algo salio mal intentalo con una nueva conección, recarga tu navegador web.";
                            }
                        }
                   } #If end / consulta de raci
                }  
            }else if ($pk_id_pro == 3) {
                if($accion_con == '' || $accion_con == 0 || !is_numeric($accion_con)){
                    echo "Algo salio mal, llena el campo Acción";
                } elseif ($pago_ben_con == '' || $pago_ben_con == 0 || !is_numeric($pago_ben_con)){
                    echo "Algo salio mal, llena el campo Pago Beneficiarios";
                }else{
                    $responseRaci = $objRaci->getIdRaci($pk_id_raci);
                    if ($responseRaci==false) {#If init / consulta de raci
                        echo "Algo salio mal intentalo de nuevo.";
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
                                            header('Content-type: applicat  ion/json; charset=utf-8');
                                            echo $response_contratos;
                                        }
                                    }else{
                                        if($response_contratos == false) echo "No se pudo agregar, revice su conección.";
                                    }
                                }else{
                                    echo "Verifica cuantas acciones o contratos puedes agregar, de acuerdo al universo de lotes.";
                                }
                                
                            } else {
                                echo "Algo salio mal intentalo con una nueva conección, recarga tu navegador web.";
                            }
                        }
                   } #If end / consulta de raci
                }  
            }else if ($pk_id_pro == 4) {
                if($accion_con == '' || $accion_con == 0 || !is_numeric($accion_con)){
                    echo "Algo salio mal, llena el campo Acción";
                } elseif ($pago_ben_con == '' || $pago_ben_con == 0 || !is_numeric($pago_ben_con)){
                    echo "Algo salio mal, llena el campo Pago Beneficiarios";
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
                                    $response_contratos = $objContratos->addContratos($accion_con, $pago_ben_con, 0,$subsidio_con, 0, 0, $mes_con, $anno_con,date("Y-m-d"),date("Y-m-d"), $pk_id_raci, $pk_id_pro);
                                    if (!empty($response_contratos)) {
                                        $responseUpdate = $objRaci->editRaciPoblado($pk_id_raci, $new_total_cont_raci);
                                        if ($responseUpdate ==  true) {
                                            #echo $responseUpdate;
                                            header('Content-type: applicat  ion/json; charset=utf-8');
                                            echo $response_contratos;
                                        }
                                    }else{
                                        if($response_contratos == false) echo "No se pudo agregar, revice su conección.";
                                    }
                                }else{
                                    echo "Verifica cuantas acciones o contratos puedes agregar, de acuerdo al universo de lotes.";
                                }
                                
                            } else {
                                echo "Algo salio mal intentalo con una nueva conección, recarga tu navegador web.";
                            }
                        }
                   } #If end / consulta de raci
                }  
            }else if ($pk_id_pro == 5) {
                if($accion_con == '' || $accion_con == 0 || !is_numeric($accion_con)){
                    echo "Algo salio mal, llena el campo Acción";
                } elseif ($pago_ben_con == '' || $pago_ben_con == 0 || !is_numeric($pago_ben_con)){
                    echo "Algo salio mal, llena el campo Pago Beneficiarios";
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
                                    $response_contratos = $objContratos->addContratos($accion_con, $pago_ben_con, 0,$subsidio_con, 0, 0, $mes_con, $anno_con,date("Y-m-d"),date("Y-m-d"), $pk_id_raci, $pk_id_pro);
                                    if (!empty($response_contratos)) {
                                        $responseUpdate = $objRaci->editRaciPoblado($pk_id_raci, $new_total_cont_raci);
                                        if ($responseUpdate ==  true) {
                                            #echo $responseUpdate;
                                            header('Content-type: applicat  ion/json; charset=utf-8');
                                            echo $response_contratos;
                                        }
                                    }else{
                                        if($response_contratos == false) echo "No se pudo agregar, revice su conección.";
                                    }
                                }else{
                                    echo "Verifica cuantas acciones o contratos puedes agregar, de acuerdo al universo de lotes.";
                                }
                                
                            } else {
                                echo "Algo salio mal intentalo con una nueva conección, recarga tu navegador web.";
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
                                            header('Content-type: applicat  ion/json; charset=utf-8');
                                            echo $response_contratos;
                                        }
                                    }else{
                                        if($response_contratos == false) echo "No se pudo agregar, revice su conección.";
                                    }
                                }else{
                                    echo "Verifica cuantas acciones o contratos puedes agregar, de acuerdo al universo de lotes.";
                                }
                                
                            } else {
                                echo "Algo salio mal intentalo con una nueva conección, recarga tu navegador web.";
                            }
                        }
                   } #If end / consulta de raci
                }  
            }else if ($pk_id_pro == 7) {
                 if($rectificaciones_con == '' || $rectificaciones_con == 0 || !is_numeric($rectificaciones_con)){
                    echo "Algo salio mal, llena el campo Acción";
                } elseif ($otros_con == '' || $otros_con == 0 || !is_numeric($otros_con) ){
                    echo "Algo salio mal, llena el campo Apoyo INSUS";
                }else{
                    $responseRaci = $objRaci->getIdRaci($pk_id_raci);
                    if ($responseRaci==false) {#If init / consulta de raci
                        echo "Algo salio mal intentalo de nuevo.";
                    }else{ 
                        foreach ($responseRaci as  $raci) {                       
                            if ($pk_id_raci == $raci['id_raci']) {
                                    $response_contratos = $objContratos->addContratos(0,0,0 ,0, $rectificaciones_con, $otros_con, $mes_con, $anno_con,date("Y-m-d"),date("Y-m-d"), $pk_id_raci, $pk_id_pro);
                                    if (!empty($response_contratos)) {
                                            echo $response_contratos;
                                        }
                                    }else{
                                        if($response_contratos == false) echo "No se pudo agregar, revice su conección.";
                                    }
                                
                            }
                        }
                   } #If end / consulta de raci  
            }else{
                 echo "No encontramos los datos del programa.";
            }
            break;
        default:
            # mensaje por default
            echo "Default, datos no encontrados";
            break;
    }
}else{
    echo "Datos incompletos, respuesta default.";
}?>