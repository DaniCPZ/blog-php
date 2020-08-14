<?php require_once 'includes/redirect.php'; ?>
<?php require_once 'includes/cabecera.php'; ?>
<?php require_once 'includes/lateral.php'; ?>

<div id="principal">
    <h3>Registrate</h3>            
        <?php if(isset($_SESSION['completado'])): ?>
            <div class="alerta alerta-exito">
                <?php echo $_SESSION['completado'] ?>
            </div>
        <?php elseif(isset($_SESSION['errores']['general'])): ?>
            <div class="alerta alerta-error">
                <?php echo $_SESSION['errores']['general'] ?>
            </div>
        <?php endif; ?>

        <form action="actualizar-usuario.php" method="POST">
            <label for="nombre">Nombre</label>
            <input type="text" name="nombre" value="<?= $_SESSION['usuario']['nombre'] ?>"/>
            <?php echo isset($_SESSION['errores']) ? mostrarError($_SESSION['errores'],'nombre') : ''; ?>

            <label for="apellidos">Apellidos</label>
            <input type="text" name="apellidos" value="<?= $_SESSION['usuario']['apellidos'] ?>"/>
            <?php echo isset($_SESSION['errores']) ? mostrarError($_SESSION['errores'],'apellidos') : ''; ?>

            <input type="submit" value="Actualizar" name="submit"/>
        </form>
        <?php borrarErrores(); ?>
</div>   

<?php require_once 'includes/pie.php'; ?>