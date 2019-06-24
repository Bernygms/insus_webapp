<?php 
require_once('../model/model_usuarios.php');

if (isset($_POST['op'])) {
    $op =  (isset($_POST['op']) ? $_POST['op'] : NULL);
    $id_usu =  (isset($_POST['id_usu']) ? $_POST['id_usu'] : NULL);
    $nombre_usu =  (isset($_POST['nombre_usu']) ? $_POST['nombre_usu'] : NULL);
    $apellidos_usu =  (isset($_POST['apellidos_usu']) ? $_POST['apellidos_usu'] : NULL);
    $usuario_usu =  (isset($_POST['usuario_usu']) ? $_POST['usuario_usu'] : NULL);
    $correo_usu =  (isset($_POST['correo_usu']) ? $_POST['correo_usu'] : NULL);
    $password_usu =  (isset($_POST['password_usu']) ? $_POST['password_usu'] : NULL);
    $estado_usu =  (isset($_POST['estado_usu']) ? $_POST['estado_usu'] : NULL);
    $rol_usu =  (isset($_POST['rol_usu']) ? $_POST['rol_usu'] : NULL);
    $pk_id_est =  (isset($_POST['pk_id_est']) ? $_POST['pk_id_est'] : NULL);

    switch($op) {
        case 'login':
            # metodo para el acceso
            if ($correo_usu == "") {
                # code...
                echo "El correo o nombre de usuario es obligatorio.";
            }else if($password_usu == "") {
                # code...
                echo "La contraseña es obligatorio.";
            }else{
                $objUsuarios = new Model_Usuarios();
                $result = $objUsuarios->acceso($correo_usu, $password_usu);
                if ($result == false) {
                   #echo "Correo o contraseña incorrecta, intenta acceder nuevamente.";
                   echo "Correo o contraseña incorrecta, intenta acceder nuevamente";
                }else{
                    foreach ($result as  $users) {   
                    #, , , , , password_usu, , ,                     
                        if (strtolower($correo_usu) == $users['correo_usu'] && $password_usu == $users['password_usu']) {
                            session_start();
                            $_SESSION['id_usu'] = $users['id_usu'];
                            $_SESSION['nombre_usu'] = $users['nombre_usu'];
                            $_SESSION['apellidos_usu'] = $users['apellidos_usu'];
                            $_SESSION['usuario_usu'] = $users['usuario_usu'];
                            $_SESSION['correo_usu'] = $users['correo_usu'];
                            $_SESSION['estado_usu'] = $users['estado_usu'];
                            $_SESSION['rol_usu'] = $users['rol_usu'];
                            $_SESSION['pk_id_est'] = $users['pk_id_est']; 
                            echo 1;
                            
                        } 
                    }
                }

            }
            break;
        
        default:
            # code...
            echo "Default";
            break;
    }
   
   
}else{
    echo "Datos incompletos, respuesta default.";
}?>