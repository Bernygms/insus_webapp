<?php
if (isset($_POST['op'])) {
    header('Content-type: application/json; charset=utf-8');
    $data["success"] = false;
    require_once('../model/model_beneficiarios.php'); 
    #Dato para la consulta de de cada case 
    $op =  (isset($_POST['op']) ? $_POST['op'] : NULL);
    #Variables de entrada contratos                                                      
    #$id_ben =  (isset($_POST['id_ben']) ? $_POST['id_ben'] : NULL);
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
    $apoyo_insus_ben =  (isset($_POST['apoyo_insus_ben']) ? $_POST['apoyo_insus_ben'] : NULL);
    $subsidio_ben =  (isset($_POST['subsidio_ben']) ? $_POST['subsidio_ben'] : NULL);
    $fecha_ben =  (isset($_POST['fecha_ben']) ? $_POST['fecha_ben'] : NULL);
    $pk_id_con =  (isset($_POST['pk_id_con']) ? $_POST['pk_id_con'] : NULL);
    #Variable de apoyo para cada programa 
    $pk_id_pro =  (isset($_POST['pk_id_pro']) ? $_POST['pk_id_pro'] : NULL);
    $num_acciones =  (isset($_POST['num_acciones']) ? $_POST['num_acciones'] : NULL);
    #Variables de apoyo de contratos 
    $pago_ben_con =  trim((isset($_POST['pago_ben_con1']) ? $_POST['pago_ben_con1'] : NULL));
    $apoyo_insus_con =  trim((isset($_POST['apoyo_insus_con1']) ? $_POST['apoyo_insus_con1'] : NULL));
    $subsidio_con =  trim((isset($_POST['subsidio_con1']) ? $_POST['subsidio_con1'] : NULL));
    #Variable de apoyo donde guardamos una cadena  de datos que seran enviados a la bd 
    $cadena_beneficiarios = "";
    $cadena = "";
    $status = false;
    $validador = true;
    $contador = 0;
    $total_pago_ben = 0;
    $total_apoyo_insus_ben = 0;
    $total_subsidio_ben = 0;
    $max_num = 16;
    $max_leng40 = 40;
    $max_leng30 = 30;
    $max_leng10 = 10;
    #Instancia a la funcion modelo beneficiarios 
    $objBeneficiarios = new Model_beneficiarios();

    switch ($op) {
        case 'benef': 
            #Ciclo que forma la cadena  sql  despues de value.
            switch ($pk_id_pro) {
                case 1:
                    # REGLA 1
                    $fecha_hoy = date("Y")."-".date("m")."-".date("d");
                    for ($i = 0; $i < $num_acciones; $i++) {   
                        #Total pago beneficiario
                        if (!empty($pago_ben[$i])) {
                            $total_pago_ben += str_ireplace(',', '',$pago_ben[$i])  ;
                        }
                        if (!empty($apoyo_insus_ben[$i])) {
                            $total_apoyo_insus_ben += str_ireplace(',', '',$apoyo_insus_ben[$i]);
                        }
                        #var_dump($validador);
                        $contador = $i+1;
                        if (trim($nombre_ben[$i]) == "" || is_numeric($nombre_ben[$i]) || strlen($nombre_ben[$i]) > $max_leng30) {
                            if(strlen($nombre_ben[$i]) > $max_leng30){ 
                                $data["data"]["mensaje"] = "Datos  invalidos, verifica el campo Nombre  maximo ".$max_leng30." caracteres, (Beneficiario ".$contador." )";
                            }else{
                                $data["data"]["mensaje"] = "Datos  invalidos, verifica el campo Nombre, (Beneficiario ".$contador." )";
                            }
                            echo json_encode($data);
                            break;
                        }else if(trim($apellido_pat_ben[$i]) == "" || is_numeric($apellido_pat_ben[$i]) || strlen($apellido_pat_ben[$i]) > $max_leng30){
                            if(strlen($apellido_pat_ben[$i]) > $max_leng30){ 
                                $data["data"]["mensaje"] = "Datos  invalidos, verifica el campo Apelldio Paterno  maximo ".$max_leng30." caracteres, (Beneficiario ".$contador." )";
                            }else{
                                $data["data"]["mensaje"] = "Datos  invalidos, verifica el campo Apelldio Paterno, (Beneficiario ".$contador." )";
                            }
                            echo json_encode($data);
                            break;
                        }else if(strlen($apellido_mat_ben[$i]) > $max_leng30){
                            $data["data"]["mensaje"] = "Datos  invalidos, verifica el campo Apelldio Materno  maximo ".$max_leng30." caracteres, (Beneficiario ".$contador." )";
                            echo json_encode($data);
                            break;
                        }else if(trim($genero_ben[$i]) == ""){
                            $data["data"]["mensaje"] = "Datos  invalidos, verifica el campo Genero, (Beneficiario ".$contador." )";
                            echo json_encode($data);
                            break;
                        }else if(trim($estado_ben[$i]) == "" ){
                            $data["data"]["mensaje"] = "Datos  invalidos, verifica el campo Estado Civil, (Beneficiario ".$contador." )";
                            echo json_encode($data);
                            break;
                        }else if(trim($zona_ben[$i]) == ""){
                            $data["data"]["mensaje"] = "Datos  invalidos, verifica el campo Zona, (Beneficiario ".$contador." )";
                            echo json_encode($data);
                            break;  
                        }else if(trim($manazana_ben[$i]) == ""){
                            $data["data"]["mensaje"] = "Datos  invalidos, verifica el campo Manzana, (Beneficiario ".$contador." )";
                            echo json_encode($data);
                            break;
                        }else if(trim($lote_ben[$i]) == ""){
                            $data["data"]["mensaje"] = "Datos  invalidos, verifica el campo Lote, (Beneficiario ".$contador." )";
                            echo json_encode($data);
                            break;
                        }else if(trim($superficie_ben[$i]) == ""){
                            $data["data"]["mensaje"] = "Datos  invalidos, verifica el campo Superficie Mts², (Beneficiario ".$contador." )";
                            echo json_encode($data);
                            break;
                        }else if(trim($uso_ben[$i]) == ""){
                            $data["data"]["mensaje"] = "Datos  invalidos, verifica el campo Uso, (Beneficiario ".$contador." )";
                            echo json_encode($data);
                            break;
                        }else if(empty(trim($numero_con_ben[$i])) && empty(trim($numero_con_compro_ben[$i]))){
                            $data["data"]["mensaje"] = "Datos  invalidos, al menos llena un campo en  Número de contrato DJ1 o DJ2, (Beneficiario ".$contador." )";
                            echo json_encode($data);
                            break;
                        }else if(!empty($numero_con_ben[$i]) && !empty($numero_con_compro_ben[$i])){
                            $data["data"]["mensaje"] = "Datos  invalidos,no puedes llenar los dos campos Número de contrato DJ1 o DJ2, (Beneficiario ".$contador." )";
                            echo json_encode($data);
                            break;
                        }else if(empty($numero_con_compro_ben[$i]) && strlen($numero_con_ben[$i]) < $max_num || strlen($numero_con_ben[$i]) > $max_num){
                            $data["data"]["mensaje"] = "Datos  invalidos,el Número DJ * de contrato que ingresaste tiene que tener ".$max_num." caracteres, (Beneficiario ".$contador." )";
                            echo json_encode($data);
                            break;
                        }else if(empty($numero_con_ben[$i]) && strlen($numero_con_compro_ben[$i]) < $max_num || strlen($numero_con_compro_ben[$i]) > $max_num){
                            $data["data"]["mensaje"] = "Datos  invalidos,el Número DJ * de contrato que ingresaste tiene que tener ".$max_num." caracteres, (Beneficiario ".$contador." )";
                            echo json_encode($data);
                            break;
                        }else if(true == $objBeneficiarios->valNumContratoBenef($numero_con_ben[$i],$numero_con_compro_ben[$i]) ){
                            $data["data"]["mensaje"] = "Datos  invalidos,el Número DJ1 o DJ2 de contrato que ingresaste ya existe, (Beneficiario ".$contador." )";
                            echo json_encode($data);
                            break;
                        }else if(trim($fecha_ben[$i]) > $fecha_hoy || trim($fecha_ben[$i]) < "2018-01-01" ){ 
                            $data["data"]["mensaje"] = "Datos  invalidos, verifica el campo Fecha, tienes que se menor o igual a ".$fecha_hoy.", pero mayor a la fecha 2017-12-31,  (Beneficiario ".$contador.")";
                            echo json_encode($data);
                            break;
                        }else if(trim($pago_ben[$i]) == ""  ||  !is_numeric(str_ireplace(',','', $pago_ben[$i]))){
                            $data["data"]["mensaje"] = "Datos  invalidos, verifica el campo Pago Beneficiario,  (Beneficiario ".$contador." )";
                            echo json_encode($data);
                            break;

                        }else{ 
                            if ($contador == $num_acciones) { 
                                if($pago_ben_con > $total_pago_ben || $pago_ben_con < $total_pago_ben){
                                    $data["data"]["mensaje"] = "La suma total de  Pago de Beneficiarios es: $".$total_pago_ben.", debe ser igual a $ ".$pago_ben_con;
                                    echo json_encode($data);
                                    break;
                                }else if( $apoyo_insus_con > $total_apoyo_insus_ben || $apoyo_insus_con < $total_apoyo_insus_ben){
                                    $data["data"]["mensaje"] = "La suma total de  Apoyo Insus es: $".$total_apoyo_insus_ben.", debe ser igual a $ ".$apoyo_insus_con;
                                    echo json_encode($data);
                                    break;
                                } 
                                $data["success"] = true;
                                for ($i = 0; $i < count($nombre_ben); $i++) { 
                                    $cadena.="('".strtoupper($nombre_ben[$i])."','".strtoupper($apellido_pat_ben[$i])."','".strtoupper($apellido_mat_ben[$i])."','".$genero_ben[$i]."','".strtoupper($estado_ben[$i])."','".$zona_ben[$i]."','".$manazana_ben[$i]."','".$lote_ben[$i]."','".$superficie_ben[$i]."','".$uso_ben[$i]."','".$numero_con_ben[$i]."','".$numero_con_compro_ben[$i]."','".str_ireplace(',', '',$pago_ben[$i])."','".str_ireplace(',', '',$apoyo_insus_ben[$i])."','".$subsidio_ben[$i]."','".$fecha_ben[$i]."','".$pk_id_con[$i]."'),";
                                }
                                $cadena_beneficiarios = substr($cadena,0,-1);   
                                $cadena_beneficiarios.=";";
                                $response = $objBeneficiarios->addBeneficiarios($cadena_beneficiarios);
                                $data["data"]["mensaje"] = "Los datos  se ingresaron correctamente.". $total_apoyo_insus_ben;
                                echo json_encode($data);
                                break;
                            }
                        }   
                    }
                    break;
                case 2:
                    # REGLA 2
                    $fecha_hoy = date("Y")."-".date("m")."-".date("d");
                    for ($i = 0; $i < $num_acciones; $i++) {   
                        #Total pago beneficiario
                        if (!empty($pago_ben[$i])) {
                            $total_pago_ben += str_ireplace(',', '',$pago_ben[$i])  ;
                        }
                        #var_dump($validador);
                        $contador = $i+1;
                        if (trim($nombre_ben[$i]) == "" || is_numeric($nombre_ben[$i])) {
                            $data["data"]["mensaje"] = "Datos  invalidos, verifica el campo Nombre, (Beneficiario ".$contador." )";
                            echo json_encode($data);
                            break;
                        }else if(trim($apellido_pat_ben[$i]) == "" || is_numeric($apellido_pat_ben[$i])){
                            $data["data"]["mensaje"] = "Datos  invalidos, verifica el campo Apelldio Paterno,  (Beneficiario ".$contador." )";
                            echo json_encode($data);
                            break;
                        }else if(trim($genero_ben[$i]) == ""){
                            $data["data"]["mensaje"] = "Datos  invalidos, verifica el campo Genero, (Beneficiario ".$contador." )";
                            echo json_encode($data);
                            break;
                        }else if(trim($estado_ben[$i]) == "" ){
                            $data["data"]["mensaje"] = "Datos  invalidos, verifica el campo Estado Civil, (Beneficiario ".$contador." )";
                            echo json_encode($data);
                            break;
                        }else if(trim($zona_ben[$i]) == ""){
                            $data["data"]["mensaje"] = "Datos  invalidos, verifica el campo Zona, (Beneficiario ".$contador." )";
                            echo json_encode($data);
                            break;  
                        }else if(trim($manazana_ben[$i]) == ""){
                            $data["data"]["mensaje"] = "Datos  invalidos, verifica el campo Manzana, (Beneficiario ".$contador." )";
                            echo json_encode($data);
                            break;
                        }else if(trim($lote_ben[$i]) == ""){
                            $data["data"]["mensaje"] = "Datos  invalidos, verifica el campo Lote, (Beneficiario ".$contador." )";
                            echo json_encode($data);
                            break;
                        }else if(trim($superficie_ben[$i]) == ""){
                            $data["data"]["mensaje"] = "Datos  invalidos, verifica el campo Superficie Mts², (Beneficiario ".$contador." )";
                            echo json_encode($data);
                            break;
                        }else if(trim($uso_ben[$i]) == ""){
                            $data["data"]["mensaje"] = "Datos  invalidos, verifica el campo Uso, (Beneficiario ".$contador." )";
                            echo json_encode($data);
                            break;
                        }else if(empty(trim($numero_con_ben[$i])) && empty(trim($numero_con_compro_ben[$i]))){
                            $data["data"]["mensaje"] = "Datos  invalidos, al menos llena un campo en  Número de contrato DJ1 o DJ2, (Beneficiario ".$contador." )";
                            echo json_encode($data);
                            break;
                        }else if(!empty($numero_con_ben[$i]) && !empty($numero_con_compro_ben[$i])){
                            $data["data"]["mensaje"] = "Datos  invalidos,no puedes llenar los dos campos Número de contrato DJ1 o DJ2, (Beneficiario ".$contador." )";
                            echo json_encode($data);
                            break;
                        }else if(empty($numero_con_compro_ben[$i]) && strlen($numero_con_ben[$i]) < $max_num || strlen($numero_con_ben[$i]) > $max_num){
                            $data["data"]["mensaje"] = "Datos  invalidos,el Número DJ * de contrato que ingresaste tiene que tener ".$max_num." caracteres, (Beneficiario ".$contador." )";
                            echo json_encode($data);
                            break;
                        }else if(empty($numero_con_ben[$i]) && strlen($numero_con_compro_ben[$i]) < $max_num || strlen($numero_con_compro_ben[$i]) > $max_num){
                            $data["data"]["mensaje"] = "Datos  invalidos,el Número DJ * de contrato que ingresaste tiene que tener ".$max_num." caracteres, (Beneficiario ".$contador." )";
                            echo json_encode($data);
                            break;
                        }else if(true == $objBeneficiarios->valNumContratoBenef($numero_con_ben[$i],$numero_con_compro_ben[$i]) ){
                            $data["data"]["mensaje"] = "Datos  invalidos,el Número DJ1 o DJ2 de contrato que ingresaste ya existe, (Beneficiario ".$contador." )";
                            echo json_encode($data);
                            break;
                        }else if(trim($fecha_ben[$i]) > $fecha_hoy || trim($fecha_ben[$i]) < "2018-01-01" ){ 
                            $data["data"]["mensaje"] = "Datos  invalidos, verifica el campo Fecha, tienes que se menor o igual a ".$fecha_hoy.", pero mayor a la fecha 2017-12-31,  (Beneficiario ".$contador.")";
                            echo json_encode($data);
                            break;
                        }else if(trim($pago_ben[$i]) == ""  ||  !is_numeric(str_ireplace(',','', $pago_ben[$i]))){
                            $data["data"]["mensaje"] = "Datos  invalidos, verifica el campo Pago Beneficiario,  (Beneficiario ".$contador." )";
                            echo json_encode($data);
                            break;

                        }else{ 
                            if ($contador == $num_acciones) { 
                                if($pago_ben_con > $total_pago_ben || $pago_ben_con < $total_pago_ben){
                                    $data["data"]["mensaje"] = "La suma total de  Pago de Beneficiarios es: $".$total_pago_ben.", debe ser igual a $ ".$pago_ben_con;
                                    echo json_encode($data);
                                    break;
                                } 
                                $data["success"] = true;
                                for ($i = 0; $i < count($nombre_ben); $i++) { 
                                    $cadena.="('".strtoupper($nombre_ben[$i])."','".strtoupper($apellido_pat_ben[$i])."','".strtoupper($apellido_mat_ben[$i])."','".$genero_ben[$i]."','".strtoupper($estado_ben[$i])."','".$zona_ben[$i]."','".$manazana_ben[$i]."','".$lote_ben[$i]."','".$superficie_ben[$i]."','".$uso_ben[$i]."','".$numero_con_ben[$i]."','".$numero_con_compro_ben[$i]."','".str_ireplace(',', '',$pago_ben[$i])."','".str_ireplace(',', '',$apoyo_insus_ben[$i])."','".$subsidio_ben[$i]."','".$fecha_ben[$i]."','".$pk_id_con[$i]."'),";
                                }
                                $cadena_beneficiarios = substr($cadena,0,-1);   
                                $cadena_beneficiarios.=";";
                                $response = $objBeneficiarios->addBeneficiarios($cadena_beneficiarios);
                                $data["data"]["mensaje"] = "Los datos  se ingresaron correctamente.". $total_apoyo_insus_ben;
                                echo json_encode($data);
                                break;
                            }
                        }   
                    }
                    break;
                case 3:
                    # REGLA 3
                    $fecha_hoy = date("Y")."-".date("m")."-".date("d");
                    for ($i = 0; $i < $num_acciones; $i++) {   
                        #Total pago beneficiario
                        if (!empty($pago_ben[$i])) {
                            $total_pago_ben += str_ireplace(',', '',$pago_ben[$i])  ;
                        }
                        #var_dump($validador);
                        $contador = $i+1;
                        if (trim($nombre_ben[$i]) == "" || is_numeric($nombre_ben[$i])) {
                            $data["data"]["mensaje"] = "Datos  invalidos, verifica el campo Nombre, (Beneficiario ".$contador." )";
                            echo json_encode($data);
                            break;
                        }else if(trim($apellido_pat_ben[$i]) == "" || is_numeric($apellido_pat_ben[$i])){
                            $data["data"]["mensaje"] = "Datos  invalidos, verifica el campo Apelldio Paterno,  (Beneficiario ".$contador." )";
                            echo json_encode($data);
                            break;
                        }else if(trim($genero_ben[$i]) == ""){
                            $data["data"]["mensaje"] = "Datos  invalidos, verifica el campo Genero, (Beneficiario ".$contador." )";
                            echo json_encode($data);
                            break;
                        }else if(trim($estado_ben[$i]) == "" ){
                            $data["data"]["mensaje"] = "Datos  invalidos, verifica el campo Estado Civil, (Beneficiario ".$contador." )";
                            echo json_encode($data);
                            break;
                        }else if(trim($zona_ben[$i]) == ""){
                            $data["data"]["mensaje"] = "Datos  invalidos, verifica el campo Zona, (Beneficiario ".$contador." )";
                            echo json_encode($data);
                            break;  
                        }else if(trim($manazana_ben[$i]) == ""){
                            $data["data"]["mensaje"] = "Datos  invalidos, verifica el campo Manzana, (Beneficiario ".$contador." )";
                            echo json_encode($data);
                            break;
                        }else if(trim($lote_ben[$i]) == ""){
                            $data["data"]["mensaje"] = "Datos  invalidos, verifica el campo Lote, (Beneficiario ".$contador." )";
                            echo json_encode($data);
                            break;
                        }else if(trim($superficie_ben[$i]) == ""){
                            $data["data"]["mensaje"] = "Datos  invalidos, verifica el campo Superficie Mts², (Beneficiario ".$contador." )";
                            echo json_encode($data);
                            break;
                        }else if(trim($uso_ben[$i]) == ""){
                            $data["data"]["mensaje"] = "Datos  invalidos, verifica el campo Uso, (Beneficiario ".$contador." )";
                            echo json_encode($data);
                            break;
                        }else if(empty(trim($numero_con_ben[$i])) && empty(trim($numero_con_compro_ben[$i]))){
                            $data["data"]["mensaje"] = "Datos  invalidos, al menos llena un campo en  Número de contrato DJ1 o DJ2, (Beneficiario ".$contador." )";
                            echo json_encode($data);
                            break;
                        }else if(!empty($numero_con_ben[$i]) && !empty($numero_con_compro_ben[$i])){
                            $data["data"]["mensaje"] = "Datos  invalidos,no puedes llenar los dos campos Número de contrato DJ1 o DJ2, (Beneficiario ".$contador." )";
                            echo json_encode($data);
                            break;
                        }else if(empty($numero_con_compro_ben[$i]) && strlen($numero_con_ben[$i]) < $max_num || strlen($numero_con_ben[$i]) > $max_num){
                            $data["data"]["mensaje"] = "Datos  invalidos,el Número DJ * de contrato que ingresaste tiene que tener ".$max_num." caracteres, (Beneficiario ".$contador." )";
                            echo json_encode($data);
                            break;
                        }else if(empty($numero_con_ben[$i]) && strlen($numero_con_compro_ben[$i]) < $max_num || strlen($numero_con_compro_ben[$i]) > $max_num){
                            $data["data"]["mensaje"] = "Datos  invalidos,el Número DJ * de contrato que ingresaste tiene que tener ".$max_num." caracteres, (Beneficiario ".$contador." )";
                            echo json_encode($data);
                            break;
                        }else if(true == $objBeneficiarios->valNumContratoBenef($numero_con_ben[$i],$numero_con_compro_ben[$i]) ){
                            $data["data"]["mensaje"] = "Datos  invalidos,el Número DJ1 o DJ2 de contrato que ingresaste ya existe, (Beneficiario ".$contador." )";
                            echo json_encode($data);
                            break;
                        }else if(trim($fecha_ben[$i]) > $fecha_hoy || trim($fecha_ben[$i]) < "2018-01-01" ){ 
                            $data["data"]["mensaje"] = "Datos  invalidos, verifica el campo Fecha, tienes que se menor o igual a ".$fecha_hoy.", pero mayor a la fecha 2017-12-31,  (Beneficiario ".$contador.")";
                            echo json_encode($data);
                            break;
                        }else if(trim($pago_ben[$i]) == ""  ||  !is_numeric(str_ireplace(',','', $pago_ben[$i]))){
                            $data["data"]["mensaje"] = "Datos  invalidos, verifica el campo Pago Beneficiario,  (Beneficiario ".$contador." )";
                            echo json_encode($data);
                            break;

                        }else{ 
                            if ($contador == $num_acciones) { 
                                if($pago_ben_con > $total_pago_ben || $pago_ben_con < $total_pago_ben){
                                    $data["data"]["mensaje"] = "La suma total de  Pago de Beneficiarios es: $".$total_pago_ben.", debe ser igual a $ ".$pago_ben_con;
                                    echo json_encode($data);
                                    break;
                                } 
                                $data["success"] = true;
                                for ($i = 0; $i < count($nombre_ben); $i++) { 
                                    $cadena.="('".strtoupper($nombre_ben[$i])."','".strtoupper($apellido_pat_ben[$i])."','".strtoupper($apellido_mat_ben[$i])."','".$genero_ben[$i]."','".strtoupper($estado_ben[$i])."','".$zona_ben[$i]."','".$manazana_ben[$i]."','".$lote_ben[$i]."','".$superficie_ben[$i]."','".$uso_ben[$i]."','".$numero_con_ben[$i]."','".$numero_con_compro_ben[$i]."','".str_ireplace(',', '',$pago_ben[$i])."','".str_ireplace(',', '',$apoyo_insus_ben[$i])."','".$subsidio_ben[$i]."','".$fecha_ben[$i]."','".$pk_id_con[$i]."'),";
                                }
                                $cadena_beneficiarios = substr($cadena,0,-1);   
                                $cadena_beneficiarios.=";";
                                $response = $objBeneficiarios->addBeneficiarios($cadena_beneficiarios);
                                $data["data"]["mensaje"] = "Los datos  se ingresaron correctamente.". $total_apoyo_insus_ben;
                                echo json_encode($data);
                                break;
                            }
                        }   
                    }
                    break;
                case 4:
                    # PMU   
                    $fecha_hoy = date("Y")."-".date("m")."-".date("d");
                    for ($i = 0; $i < $num_acciones; $i++) {   
                        #Total pago beneficiario
                        if (!empty($pago_ben[$i])) {
                            $total_pago_ben += str_ireplace(',', '',$pago_ben[$i])  ;
                        }
                        if (!empty($subsidio_ben[$i])) {
                            $total_subsidio_ben += str_ireplace(',', '',$subsidio_ben[$i]);
                        }
                        #var_dump($validador);
                        $contador = $i+1;
                        if (trim($nombre_ben[$i]) == "" || is_numeric($nombre_ben[$i])) {
                            $data["data"]["mensaje"] = "Datos  invalidos, verifica el campo Nombre, (Beneficiario ".$contador." )";
                            echo json_encode($data);
                            break;
                        }else if(trim($apellido_pat_ben[$i]) == "" || is_numeric($apellido_pat_ben[$i])){
                            $data["data"]["mensaje"] = "Datos  invalidos, verifica el campo Apelldio Paterno,  (Beneficiario ".$contador." )";
                            echo json_encode($data);
                            break;
                        }else if(trim($genero_ben[$i]) == ""){
                            $data["data"]["mensaje"] = "Datos  invalidos, verifica el campo Genero, (Beneficiario ".$contador." )";
                            echo json_encode($data);
                            break;
                        }else if(trim($estado_ben[$i]) == "" ){
                            $data["data"]["mensaje"] = "Datos  invalidos, verifica el campo Estado Civil, (Beneficiario ".$contador." )";
                            echo json_encode($data);
                            break;
                        }else if(trim($zona_ben[$i]) == ""){
                            $data["data"]["mensaje"] = "Datos  invalidos, verifica el campo Zona, (Beneficiario ".$contador." )";
                            echo json_encode($data);
                            break;  
                        }else if(trim($manazana_ben[$i]) == ""){
                            $data["data"]["mensaje"] = "Datos  invalidos, verifica el campo Manzana, (Beneficiario ".$contador." )";
                            echo json_encode($data);
                            break;
                        }else if(trim($lote_ben[$i]) == ""){
                            $data["data"]["mensaje"] = "Datos  invalidos, verifica el campo Lote, (Beneficiario ".$contador." )";
                            echo json_encode($data);
                            break;
                        }else if(trim($superficie_ben[$i]) == ""){
                            $data["data"]["mensaje"] = "Datos  invalidos, verifica el campo Superficie Mts², (Beneficiario ".$contador." )";
                            echo json_encode($data);
                            break;
                        }else if(trim($uso_ben[$i]) == ""){
                            $data["data"]["mensaje"] = "Datos  invalidos, verifica el campo Uso, (Beneficiario ".$contador." )";
                            echo json_encode($data);
                            break;
                        }else if(empty(trim($numero_con_ben[$i])) && empty(trim($numero_con_compro_ben[$i]))){
                            $data["data"]["mensaje"] = "Datos  invalidos, al menos llena un campo en  Número de contrato DJ1 o DJ2, (Beneficiario ".$contador." )";
                            echo json_encode($data);
                            break;
                        }else if(!empty($numero_con_ben[$i]) && !empty($numero_con_compro_ben[$i])){
                            $data["data"]["mensaje"] = "Datos  invalidos,no puedes llenar los dos campos Número de contrato DJ1 o DJ2, (Beneficiario ".$contador." )";
                            echo json_encode($data);
                            break;
                        }else if(empty($numero_con_compro_ben[$i]) && strlen($numero_con_ben[$i]) < $max_num || strlen($numero_con_ben[$i]) > $max_num){
                            $data["data"]["mensaje"] = "Datos  invalidos,el Número DJ * de contrato que ingresaste tiene que tener ".$max_num." caracteres, (Beneficiario ".$contador." )";
                            echo json_encode($data);
                            break;
                        }else if(empty($numero_con_ben[$i]) && strlen($numero_con_compro_ben[$i]) < $max_num || strlen($numero_con_compro_ben[$i]) > $max_num){
                            $data["data"]["mensaje"] = "Datos  invalidos,el Número DJ * de contrato que ingresaste tiene que tener ".$max_num." caracteres, (Beneficiario ".$contador." )";
                            echo json_encode($data);
                            break;
                        }else if(true == $objBeneficiarios->valNumContratoBenef($numero_con_ben[$i],$numero_con_compro_ben[$i]) ){
                            $data["data"]["mensaje"] = "Datos  invalidos,el Número DJ1 o DJ2 de contrato que ingresaste ya existe, (Beneficiario ".$contador." )";
                            echo json_encode($data);
                            break;
                        }else if(trim($fecha_ben[$i]) > $fecha_hoy || trim($fecha_ben[$i]) < "2018-01-01" ){ 
                            $data["data"]["mensaje"] = "Datos  invalidos, verifica el campo Fecha, tienes que se menor o igual a ".$fecha_hoy.", pero mayor a la fecha 2017-12-31,  (Beneficiario ".$contador.")";
                            echo json_encode($data);
                            break;
                        }else if(trim($subsidio_ben[$i]) == ""  ||  !is_numeric(str_ireplace(',','', $subsidio_ben[$i]))){
                            $data["data"]["mensaje"] = "Datos  invalidos, verifica el campo Subsidio,  (Beneficiario ".$contador." )";
                            echo json_encode($data);
                            break;

                        }else{ 
                            if ($contador == $num_acciones) { 
                                if($pago_ben_con > $total_pago_ben || $pago_ben_con < $total_pago_ben){
                                    $data["data"]["mensaje"] = "La suma total de  Pago de Beneficiarios es: $".$total_pago_ben.", debe ser igual a $ ".$pago_ben_con;
                                    echo json_encode($data);
                                    break;
                                }else if( $subsidio_con > $total_subsidio_ben || $subsidio_con < $total_subsidio_ben){
                                    $data["data"]["mensaje"] = "La suma total del Subsidio es: $".$total_subsidio_ben.", debe ser igual a $ ".$subsidio_con;
                                    echo json_encode($data);
                                    break;
                                } 
                                $data["success"] = true;
                                for ($i = 0; $i < count($nombre_ben); $i++) { 
                                    $cadena.="('".strtoupper($nombre_ben[$i])."','".strtoupper($apellido_pat_ben[$i])."','".strtoupper($apellido_mat_ben[$i])."','".$genero_ben[$i]."','".strtoupper($estado_ben[$i])."','".$zona_ben[$i]."','".$manazana_ben[$i]."','".$lote_ben[$i]."','".$superficie_ben[$i]."','".$uso_ben[$i]."','".$numero_con_ben[$i]."','".$numero_con_compro_ben[$i]."','".str_ireplace(',', '',$pago_ben[$i])."','".str_ireplace(',', '',$apoyo_insus_ben[$i])."','".str_ireplace(',', '',$subsidio_ben[$i])."','".$fecha_ben[$i]."','".$pk_id_con[$i]."'),";
                                }
                                $cadena_beneficiarios = substr($cadena,0,-1);   
                                $cadena_beneficiarios.=";";
                                $response = $objBeneficiarios->addBeneficiarios($cadena_beneficiarios);
                                $data["data"]["mensaje"] = "Los datos  se ingresaron correctamente.". $total_apoyo_insus_ben;
                                echo json_encode($data);
                                break;
                            }
                        }   
                    }
                    break;
                case 5:
                    # PRAH
                    $fecha_hoy = date("Y")."-".date("m")."-".date("d");
                    for ($i = 0; $i < $num_acciones; $i++) {   
                        #Total pago beneficiario
                        if (!empty($pago_ben[$i])) {
                            $total_pago_ben += str_ireplace(',', '',$pago_ben[$i])  ;
                        }
                        if (!empty($subsidio_ben[$i])) {
                            $total_subsidio_ben += str_ireplace(',', '',$subsidio_ben[$i]);
                        }
                        #var_dump($validador);
                        $contador = $i+1;
                        if (trim($nombre_ben[$i]) == "" || is_numeric($nombre_ben[$i])) {
                            $data["data"]["mensaje"] = "Datos  invalidos, verifica el campo Nombre, (Beneficiario ".$contador." )";
                            echo json_encode($data);
                            break;
                        }else if(trim($apellido_pat_ben[$i]) == "" || is_numeric($apellido_pat_ben[$i])){
                            $data["data"]["mensaje"] = "Datos  invalidos, verifica el campo Apelldio Paterno,  (Beneficiario ".$contador." )";
                            echo json_encode($data);
                            break;
                        }else if(trim($genero_ben[$i]) == ""){
                            $data["data"]["mensaje"] = "Datos  invalidos, verifica el campo Genero, (Beneficiario ".$contador." )";
                            echo json_encode($data);
                            break;
                        }else if(trim($estado_ben[$i]) == "" ){
                            $data["data"]["mensaje"] = "Datos  invalidos, verifica el campo Estado Civil, (Beneficiario ".$contador." )";
                            echo json_encode($data);
                            break;
                        }else if(trim($zona_ben[$i]) == ""){
                            $data["data"]["mensaje"] = "Datos  invalidos, verifica el campo Zona, (Beneficiario ".$contador." )";
                            echo json_encode($data);
                            break;  
                        }else if(trim($manazana_ben[$i]) == ""){
                            $data["data"]["mensaje"] = "Datos  invalidos, verifica el campo Manzana, (Beneficiario ".$contador." )";
                            echo json_encode($data);
                            break;
                        }else if(trim($lote_ben[$i]) == ""){
                            $data["data"]["mensaje"] = "Datos  invalidos, verifica el campo Lote, (Beneficiario ".$contador." )";
                            echo json_encode($data);
                            break;
                        }else if(trim($superficie_ben[$i]) == ""){
                            $data["data"]["mensaje"] = "Datos  invalidos, verifica el campo Superficie Mts², (Beneficiario ".$contador." )";
                            echo json_encode($data);
                            break;
                        }else if(trim($uso_ben[$i]) == ""){
                            $data["data"]["mensaje"] = "Datos  invalidos, verifica el campo Uso, (Beneficiario ".$contador." )";
                            echo json_encode($data);
                            break;
                        }else if(empty(trim($numero_con_ben[$i])) && empty(trim($numero_con_compro_ben[$i]))){
                            $data["data"]["mensaje"] = "Datos  invalidos, al menos llena un campo en  Número de contrato DJ1 o DJ2, (Beneficiario ".$contador." )";
                            echo json_encode($data);
                            break;
                        }else if(!empty($numero_con_ben[$i]) && !empty($numero_con_compro_ben[$i])){
                            $data["data"]["mensaje"] = "Datos  invalidos,no puedes llenar los dos campos Número de contrato DJ1 o DJ2, (Beneficiario ".$contador." )";
                            echo json_encode($data);
                            break;
                        }else if(empty($numero_con_compro_ben[$i]) && strlen($numero_con_ben[$i]) < $max_num || strlen($numero_con_ben[$i]) > $max_num){
                            $data["data"]["mensaje"] = "Datos  invalidos,el Número DJ * de contrato que ingresaste tiene que tener ".$max_num." caracteres, (Beneficiario ".$contador." )";
                            echo json_encode($data);
                            break;
                        }else if(empty($numero_con_ben[$i]) && strlen($numero_con_compro_ben[$i]) < $max_num || strlen($numero_con_compro_ben[$i]) > $max_num){
                            $data["data"]["mensaje"] = "Datos  invalidos,el Número DJ * de contrato que ingresaste tiene que tener ".$max_num." caracteres, (Beneficiario ".$contador." )";
                            echo json_encode($data);
                            break;
                        }else if(true == $objBeneficiarios->valNumContratoBenef($numero_con_ben[$i],$numero_con_compro_ben[$i]) ){
                            $data["data"]["mensaje"] = "Datos  invalidos,el Número DJ1 o DJ2 de contrato que ingresaste ya existe, (Beneficiario ".$contador." )";
                            echo json_encode($data);
                            break;
                        }else if(trim($fecha_ben[$i]) > $fecha_hoy || trim($fecha_ben[$i]) < "2018-01-01" ){ 
                            $data["data"]["mensaje"] = "Datos  invalidos, verifica el campo Fecha, tienes que se menor o igual a ".$fecha_hoy.", pero mayor a la fecha 2017-12-31,  (Beneficiario ".$contador.")";
                            echo json_encode($data);
                            break;
                        }else if(trim($subsidio_ben[$i]) == ""  ||  !is_numeric(str_ireplace(',','', $subsidio_ben[$i]))){
                            $data["data"]["mensaje"] = "Datos  invalidos, verifica el campo Subsidio,  (Beneficiario ".$contador." )";
                            echo json_encode($data);
                            break;

                        }else{ 
                            if ($contador == $num_acciones) { 
                                if($pago_ben_con > $total_pago_ben || $pago_ben_con < $total_pago_ben){
                                    $data["data"]["mensaje"] = "La suma total de  Pago de Beneficiarios es: $".$total_pago_ben.", debe ser igual a $ ".$pago_ben_con;
                                    echo json_encode($data);
                                    break;
                                }else if( $subsidio_con > $total_subsidio_ben || $subsidio_con < $total_subsidio_ben){
                                    $data["data"]["mensaje"] = "La suma total del Subsidio es: $".$total_subsidio_ben.", debe ser igual a $ ".$subsidio_con;
                                    echo json_encode($data);
                                    break;
                                } 
                                $data["success"] = true;
                                for ($i = 0; $i < count($nombre_ben); $i++) { 
                                    $cadena.="('".strtoupper($nombre_ben[$i])."','".strtoupper($apellido_pat_ben[$i])."','".strtoupper($apellido_mat_ben[$i])."','".$genero_ben[$i]."','".strtoupper($estado_ben[$i])."','".$zona_ben[$i]."','".$manazana_ben[$i]."','".$lote_ben[$i]."','".$superficie_ben[$i]."','".$uso_ben[$i]."','".$numero_con_ben[$i]."','".$numero_con_compro_ben[$i]."','".str_ireplace(',', '',$pago_ben[$i])."','".str_ireplace(',', '',$apoyo_insus_ben[$i])."','".str_ireplace(',', '',$subsidio_ben[$i])."','".$fecha_ben[$i]."','".$pk_id_con[$i]."'),";
                                }
                                $cadena_beneficiarios = substr($cadena,0,-1);   
                                $cadena_beneficiarios.=";";
                                $response = $objBeneficiarios->addBeneficiarios($cadena_beneficiarios);
                                $data["data"]["mensaje"] = "Los datos  se ingresaron correctamente.". $total_apoyo_insus_ben;
                                echo json_encode($data);
                                break;
                            }
                        }   
                    }
                    break;  
                case 6:
                    # PASPRAH
                    $fecha_hoy = date("Y")."-".date("m")."-".date("d");
                    for ($i = 0; $i < $num_acciones; $i++) {   
                        #Total pago beneficiario
                        if (!empty($apoyo_insus_ben[$i])) {
                            $total_apoyo_insus_ben += str_ireplace(',', '',$apoyo_insus_ben[$i]);
                        }
                        if (!empty($subsidio_ben[$i])) {
                            $total_subsidio_ben += str_ireplace(',', '',$subsidio_ben[$i]);
                        }
                        #var_dump($validador);
                        $contador = $i+1;
                        if (trim($nombre_ben[$i]) == "" || is_numeric($nombre_ben[$i])) {
                            $data["data"]["mensaje"] = "Datos  invalidos, verifica el campo Nombre, (Beneficiario ".$contador." )";
                            echo json_encode($data);
                            break;
                        }else if(trim($apellido_pat_ben[$i]) == "" || is_numeric($apellido_pat_ben[$i])){
                            $data["data"]["mensaje"] = "Datos  invalidos, verifica el campo Apelldio Paterno,  (Beneficiario ".$contador." )";
                            echo json_encode($data);
                            break;
                        }else if(trim($genero_ben[$i]) == ""){
                            $data["data"]["mensaje"] = "Datos  invalidos, verifica el campo Genero, (Beneficiario ".$contador." )";
                            echo json_encode($data);
                            break;
                        }else if(trim($estado_ben[$i]) == "" ){
                            $data["data"]["mensaje"] = "Datos  invalidos, verifica el campo Estado Civil, (Beneficiario ".$contador." )";
                            echo json_encode($data);
                            break;
                        }else if(trim($zona_ben[$i]) == ""){
                            $data["data"]["mensaje"] = "Datos  invalidos, verifica el campo Zona, (Beneficiario ".$contador." )";
                            echo json_encode($data);
                            break;  
                        }else if(trim($manazana_ben[$i]) == ""){
                            $data["data"]["mensaje"] = "Datos  invalidos, verifica el campo Manzana, (Beneficiario ".$contador." )";
                            echo json_encode($data);
                            break;
                        }else if(trim($lote_ben[$i]) == ""){
                            $data["data"]["mensaje"] = "Datos  invalidos, verifica el campo Lote, (Beneficiario ".$contador." )";
                            echo json_encode($data);
                            break;
                        }else if(trim($superficie_ben[$i]) == ""){
                            $data["data"]["mensaje"] = "Datos  invalidos, verifica el campo Superficie Mts², (Beneficiario ".$contador." )";
                            echo json_encode($data);
                            break;
                        }else if(trim($uso_ben[$i]) == ""){
                            $data["data"]["mensaje"] = "Datos  invalidos, verifica el campo Uso, (Beneficiario ".$contador." )";
                            echo json_encode($data);
                            break;
                        }else if(empty(trim($numero_con_ben[$i])) && empty(trim($numero_con_compro_ben[$i]))){
                            $data["data"]["mensaje"] = "Datos  invalidos, al menos llena un campo en  Número de contrato DJ1 o DJ2, (Beneficiario ".$contador." )";
                            echo json_encode($data);
                            break;
                        }else if(!empty($numero_con_ben[$i]) && !empty($numero_con_compro_ben[$i])){
                            $data["data"]["mensaje"] = "Datos  invalidos,no puedes llenar los dos campos Número de contrato DJ1 o DJ2, (Beneficiario ".$contador." )";
                            echo json_encode($data);
                            break;
                        }else if(empty($numero_con_compro_ben[$i]) && strlen($numero_con_ben[$i]) < $max_num || strlen($numero_con_ben[$i]) > $max_num){
                            $data["data"]["mensaje"] = "Datos  invalidos,el Número DJ * de contrato que ingresaste tiene que tener ".$max_num." caracteres, (Beneficiario ".$contador." )";
                            echo json_encode($data);
                            break;
                        }else if(empty($numero_con_ben[$i]) && strlen($numero_con_compro_ben[$i]) < $max_num || strlen($numero_con_compro_ben[$i]) > $max_num){
                            $data["data"]["mensaje"] = "Datos  invalidos,el Número DJ * de contrato que ingresaste tiene que tener ".$max_num." caracteres, (Beneficiario ".$contador." )";
                            echo json_encode($data);
                            break;
                        }else if(true == $objBeneficiarios->valNumContratoBenef($numero_con_ben[$i],$numero_con_compro_ben[$i]) ){
                            $data["data"]["mensaje"] = "Datos  invalidos,el Número DJ1 o DJ2 de contrato que ingresaste ya existe, (Beneficiario ".$contador." )";
                            echo json_encode($data);
                            break;
                        }else if(trim($fecha_ben[$i]) > $fecha_hoy || trim($fecha_ben[$i]) < "2018-01-01" ){ 
                            $data["data"]["mensaje"] = "Datos  invalidos, verifica el campo Fecha, tienes que se menor o igual a ".$fecha_hoy.", pero mayor a la fecha 2017-12-31,  (Beneficiario ".$contador.")";
                            echo json_encode($data);
                            break;
                        }else if(trim($subsidio_ben[$i]) == ""  ||  !is_numeric(str_ireplace(',','', $subsidio_ben[$i]))){
                            $data["data"]["mensaje"] = "Datos  invalidos, verifica el campo Subsidio,  (Beneficiario ".$contador." )";
                            echo json_encode($data);
                            break;

                        }else{ 
                            if ($contador == $num_acciones) { 
                                if( $apoyo_insus_con > $total_apoyo_insus_ben || $apoyo_insus_con < $total_apoyo_insus_ben){
                                    $data["data"]["mensaje"] = "La suma total de  Apoyo Insus es: $".$total_apoyo_insus_ben.", debe ser igual a $ ".$apoyo_insus_con;
                                    echo json_encode($data);
                                    break;
                                }else if( $subsidio_con > $total_subsidio_ben || $subsidio_con < $total_subsidio_ben){
                                    $data["data"]["mensaje"] = "La suma total del Subsidio es: $".$total_subsidio_ben.", debe ser igual a $ ".$subsidio_con;
                                    echo json_encode($data);
                                    break;
                                } 
                                $data["success"] = true;    
                                for ($i = 0; $i < count($nombre_ben); $i++) { 
                                    $cadena.="('".strtoupper($nombre_ben[$i])."','".strtoupper($apellido_pat_ben[$i])."','".strtoupper($apellido_mat_ben[$i])."','".$genero_ben[$i]."','".strtoupper($estado_ben[$i])."','".$zona_ben[$i]."','".$manazana_ben[$i]."','".$lote_ben[$i]."','".$superficie_ben[$i]."','".$uso_ben[$i]."','".$numero_con_ben[$i]."','".$numero_con_compro_ben[$i]."','".str_ireplace(',', '',$pago_ben[$i])."','".str_ireplace(',', '',$apoyo_insus_ben[$i])."','".str_ireplace(',', '',$subsidio_ben[$i])."','".$fecha_ben[$i]."','".$pk_id_con[$i]."'),";
                                }
                                $cadena_beneficiarios = substr($cadena,0,-1);   
                                $cadena_beneficiarios.=";";
                                $response = $objBeneficiarios->addBeneficiarios($cadena_beneficiarios);
                                $data["data"]["mensaje"] = "Los datos  se ingresaron correctamente.". $total_apoyo_insus_ben;
                                echo json_encode($data);
                                break;
                            }
                        }   
                    }
                    break; 
                default: 
                    # code...
                    $data["data"]["mensaje"] = "Datos incompletos, respuesta default programa no encontrada.";
                    echo json_encode($data);
                    break;
            } 
            break;  
        default:
            $data["data"]["mensaje"] = "Datos incompletos, respuesta default solicitud no encontrada.";
            echo json_encode($data);
            break;
    }
}else{
    $data["data"]["mensaje"] = "Datos incompletos, respuesta default reporta la falla con el quipo de sistemas.";
    echo json_encode($data);
}
