<?php
// Conexion 
$server = 'localhost';
$username = 'root';
$password = '';
$database = 'proyecto-php';
$db = mysqli_connect($server, $username, $password, $database);

mysqli_query($db,"SET NAME 'utf8'");
// Iniciar la sesion
if(!isset($_SESSION)){
    session_start();
}