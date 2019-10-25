<?php
if (isset($_POST['op'])) {
    require_once('../model/model_contratos.php');
    require_once('../model/model_estados.php');
    require_once('../model/model_raci.php'); 

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
    header('Content-type: application/json; charset=utf-8');
    $data["success"] = false;
    switch($op) {
        case 'estados':
            # Consulta a la tabla estados
            if ($rol_usu == 0 || $rol_usu == "" || $id_est == "" || $id_est == 0) {
                echo "Lo sentimos, algo salio mal.  :( ";
            }else{
                $objEstados = new Model_estados();
                $response = $objEstados->getEstados($id_est,$rol_usu);
                if (!empty($response)) {
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
                echo json_encode($responseRaci);
            }else{
                if ($responseRaci == false) {
                    echo "Lo sentimos, no encontramos resultados.";
                }
            }
            break; 
        case 'editPoblado':
            # Actualizamos datos del poblado por id
            if ($universo_de_lot_raci > $total_con_raci) {
                $response = $objRaci->editRaci_Poblado($id_raci,$entidad_raci,$clave_insus_raci,$clave_inegi_raci,$modalidad_raci,$nombre_de_pob_raci,$municipio_raci,$superficie_de_pob_raci,$municipio_pro_raci,$fecha_ini_con_raci,$universo_de_lot_raci,$total_con_raci);
                if ($response== true) {
                    $data["success"] = true;
                    $data["data"]["mensaje"] = "Excelente, los datos del poblado fueron actualizados correctamente.";
                    echo json_encode($data);
                }else{
                    $data["data"]["mensaje"] = "Lo sentimos, algo salio mal, no se actualizo  el poblado.";
                    echo json_encode($data);
                }
            }else{
                $data["data"]["mensaje"] = "El Universo de Lotes debe ser mayor.";
                echo json_encode($data);
            }
            
            break;
        default: 
            # mensaje por default 
            $data["data"]["mensaje"] = "Default, datos no encontrados";
            echo json_encode($data);
            break;
    }
}else{
    $data["data"]["mensaje"] = "Datos incompletos, respuesta default.";
    echo json_encode($data);
}

?>