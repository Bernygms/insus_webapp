<?php
require_once('connection.php');
class Model_Usuarios {
    protected $db;
    public function __construct(){
        $this->db = DB();
    }
    #Funcion para elacceso alportal 
    public function acceso($correo_usu,$password_usu){
        $query = $this->db->prepare("SELECT id_usu, nombre_usu, apellidos_usu, usuario_usu, correo_usu, password_usu, estado_usu, rol_usu, pk_id_est
        FROM usuarios  WHERE  correo_usu=:correo_usu AND password_usu=:password_usu");
        $query->bindParam(":correo_usu", $correo_usu, PDO::PARAM_STR);
        $query->bindParam(":password_usu", $password_usu, PDO::PARAM_STR);
        $query->execute();
        $result = $query-> fetchAll();
        if ($result) {
            return $result;
        }else{
            return false;
        }
    }

}