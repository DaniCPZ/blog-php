<?php
if(isset($_POST)){
    require_once 'includes/conexion.php';

    $nombre = isset($_POST['nombre']) ? mysqli_real_escape_string($db,$_POST['nombre']) : false ;
    $apellidos = isset($_POST['apellidos']) ? mysqli_real_escape_string($db,$_POST['apellidos']) : false ;
    
    //Array de errores
    $errores = array();

    // Validar los datos
    if(!empty($nombre) && !is_numeric($nombre) && !preg_match("/[0-9]/",$nombre)){
        $nombre_validado = true;
    }else{
        $nombre_validado = false;
        $errores['nombre'] = "El nombre no es valido";
    };

    if(!empty($apellidos) && !is_numeric($apellidos) && !preg_match("/[0-9]/",$apellidos)){
        $apellidos_validado = true;
    }else{
        $apellidos_validado = false;
        $errores['apellidos'] = "Los apellidos no son validos";
    };

    $guardar_usuario = false;
    if(count($errores)== 0){
        $guardar_usuario = true;       
        // Insertar usuarios en la tabla usuarios de la bd
        
        $usuario = $_SESSION['usuario']['id'];
        $sql = "UPDATE usuarios SET ".
        "nombre = '$nombre', ".
        "apellidos = '$apellidos' ".
        "WHERE id = $usuario ;";

        $guardar = mysqli_query($db,$sql);
        if($guardar){
            $_SESSION['usuario']['nombre'] = $nombre;
            $_SESSION['usuario']['apellidos'] = $apellidos;
            $_SESSION['completado']= "Tus datos se han actualizado con exito!";
        }else{
            $_SESSION['errores']['general'] = "Fallo al actualizar";
        }        
    }else{
        $_SESSION['errores'] = $errores;        
    }
}
header('Location: mis-datos.php');