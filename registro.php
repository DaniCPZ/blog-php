<?php
if(isset($_POST)){
    require_once 'includes/conexion.php';
    if(!isset($_SESSION)){
        session_start();
    }

    $nombre = isset($_POST['nombre']) ? mysqli_real_escape_string($db,$_POST['nombre']) : false ;
    $apellidos = isset($_POST['apellidos']) ? mysqli_real_escape_string($db,$_POST['apellidos']) : false ;
    $email = isset($_POST['email']) ? mysqli_real_escape_string($db,trim($_POST['email'])) : false ;
    $password = isset($_POST['password']) ? mysqli_real_escape_string($db,$_POST['password']) : false ;
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

    if(!empty($email) && filter_var($email, FILTER_VALIDATE_EMAIL)){
        $email_validado = true;
    }else{
        $email_validado = false;
        $errores['email'] = "El email no es validos";
    };

    if(!empty($password) ){
        $password_validado = true;
    }else{
        $password_validado = false;
        $errores['password'] = "La contraseña esta vacia";
    };
    $guardar_usuario = false;
    if(count($errores)== 0){
        $sql = "SELECT id,email FROM usuarios WHERE email ='$email' ;";
        $consulta = mysqli_query($db,$sql);
        $isset_email = mysqli_fetch_assoc($consulta);
        if(empty($isset_email['id'])){
            $guardar_usuario = true;
            // Cifrar contraseña
            $password_segura = password_hash($password,PASSWORD_BCRYPT, ['cost'=>4]);
            
            // Insertar usuarios en la tabla usuarios de la bd
            $sql = "INSERT INTO usuarios VALUES(null,'$nombre','$apellidos','$email','$password_segura', CURDATE());";
            $guardar = mysqli_query($db,$sql);
            if($guardar){
                $_SESSION['completado']= "el registro se ha completado con exito";
            }else{
                $_SESSION['errores']['general'] = "Fallo al guardar el usuario";
            }  
        }else{
            $errores['email'] = "El email ya esta registrado";
            $_SESSION['errores'] = $errores; 
        }               
    }else{
        $_SESSION['errores'] = $errores;        
    }
}
header('Location: index.php');