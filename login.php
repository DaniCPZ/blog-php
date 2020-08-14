<?php
if(isset($_POST)){
    require_once 'includes/conexion.php';    
    if(!isset($_SESSION)){
        session_start();
    }
    if(isset($_SESSION['error_login'])){
        unset($_SESSION['error_login']);
    }
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    // consulta para comprobar las credenciales del usuarios
    $sql = "SELECT * FROM usuarios WHERE email='$email'";
    $login = mysqli_query($db,$sql);
    
    if($login && mysqli_num_rows($login)== 1){
        //Array asociativo a partir del resultado de la consulta
        $usuario = mysqli_fetch_assoc($login);

        //Comprobar contraseña
        $verify = password_verify($password,$usuario['password']);
        if($verify){
            $_SESSION['usuario']= $usuario;
            
        }else{            
            $_SESSION['error_login']= "Login incorrecto";
        }
    }else{        
        $_SESSION['error_login']= "Login incorrecto";
    }
}
header('Location: index.php');