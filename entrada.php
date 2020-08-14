<?php require_once 'includes/conexion.php'; ?>
<?php require_once 'includes/helpers.php'; ?>
<?php
    $entrada_actual = conseguirEntrada($db,$_GET['id']);
    if(!isset($entrada_actual['id'])){
        header("Location: index.php");
    };
?>
<?php require_once 'includes/cabecera.php'; ?>
<?php require_once 'includes/lateral.php'; ?>
<div id="principal">
    <h1><?= $entrada_actual['titulo']?></h1>
    <h2 style="margin-top:10px;font-size: 23px;"><?= $entrada_actual['categoria']?></h2>
    <h4 class="fecha"><?= $entrada_actual['fecha']?> | <?= $entrada_actual['autor']?></h4>
    <p>
        <?= $entrada_actual['descripcion']?>
    </p>
    <br>
    <?php if(isset($_SESSION["usuario"]) && $_SESSION['usuario']['id'] == $entrada_actual['usuario_id']):?>
        <a href="editar-entrada.php?id=<?= $entrada_actual['id'] ?>" class="boton boton-verde">Editar entrada</a>
        <a href="borrar-entrada.php?id=<?= $entrada_actual['id'] ?>" class="boton boton-rojo ">Eliminar entrada</a>
    <?php endif; ?> 
</div>   

<?php require_once 'includes/pie.php'; ?>