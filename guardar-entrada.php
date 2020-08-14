<?php
if(isset($_POST)){
    require_once 'includes/conexion.php';
    if(!isset($_SESSION)){
        session_start();
    }
    $usuario = $_SESSION['usuario']['id'];
    $titulo = isset($_POST['titulo']) ? mysqli_real_escape_string($db,$_POST['titulo']) : false ;
    $descripcion = isset($_POST['descripcion']) ? mysqli_real_escape_string($db,$_POST['descripcion']) : false ;
    $categoria = isset($_POST['categoria']) ? (int)$_POST['categoria'] : false ;
    
    //Array de errores
    $errores = array();

    // Validar los datos
    if(empty($titulo)){
        $errores['titulo'] = "El titulo no es valido";
    };
    if(empty($descripcion)){
        $errores['descripcion'] = "La descripción no es valida";
    };

    if(empty($categoria) && !is_numeric($categoria)){
        $errores['categoria'] = "La categoria no es valida";
    };
   
    if(count($errores)== 0){
        if(isset($_GET['editar'])){
            $entrada_id=$_GET['editar']; 
            $usuario_id = $_SESSION['usuario']['id'];
            $sql = "UPDATE entradas SET categoria_id=$categoria,titulo='$titulo',descripcion='$descripcion' ". 
            "WHERE id= $entrada_id AND usuario_id = $usuario_id";
        }else{
            // Insertar usuarios en la tabla usuarios de la bd
            $sql = "INSERT INTO entradas VALUES(null,$usuario,$categoria,'$titulo','$descripcion', CURDATE());";
        }       
        $guardar = mysqli_query($db,$sql);
        header('Location: index.php');             
    }else{
        $_SESSION['errores_entrada'] = $errores;
        if(isset($_GET['editar'])){
            header("Location: editar-entrada.php?id=".$_GET['editar']);
        }else{
            header('Location: crear-entradas.php'); 
        };
    }
}