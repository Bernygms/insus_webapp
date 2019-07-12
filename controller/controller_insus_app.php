<?php 
require_once('../model/model_estados.php');
require_once('../model/model_raci.php');

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

    #variable para validar la consultas por roles
    $rol_usu =  (isset($_POST['rol_usu']) ? $_POST['rol_usu'] : NULL);

    #Variables de entrada contratos
    /*
        id_con
        accion_con
        pago_ben_con
        apoyo_insus_con
        subsidio_con
        mes_con
        anno_con
        fecha_con
        fecha_edi_con
        pk_id_raci
        pk_id_pro
            
    */
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
            $objRaci = new Model_raci();
            $response = $objRaci->getRaci($entidad_raci);
            if (!empty($response)) {
                header('Content-type: application/json; charset=utf-8');
                echo json_encode($response);
            }else{
                if ($response == false) {
                    echo "Lo sentimos, no encontramos resultados.";
                }
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