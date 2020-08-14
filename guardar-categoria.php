<?php
if(isset($_POST)){
    require_once 'includes/conexion.php';
    if(!isset($_SESSION)){
        session_start();
    }

    $nombre = isset($_POST['nombre']) ? mysqli_real_escape_string($db,$_POST['nombre']) : false ;
    //Array de errores
    $errores = array();
    // Validar los datos
    if(!empty($nombre) && !is_numeric($nombre) && !preg_match("/[0-9]/",$nombre)){
        $nombre_validado = true;
    }else{
        $nombre_validado = false;
        $errores['nombre'] = "El nombre no es valido";
    };
    if(count($errores)== 0){
        // Insertar usuarios en la tabla usuarios de la bd
        $sql = "INSERT INTO categorias VALUES(null,'$nombre');";
        $guardar = mysqli_query($db,$sql);               
    }else{
        $_SESSION['errores'] = $errores;        
    }
}
header('Location: index.php');