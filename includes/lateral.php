<!-- BARRA LATERAL -->
<aside id="sidebar">
        <div id="buscador" class="bloque">
            <h3>Buscador</h3>
            <form action="buscar.php" method="POST">
                <input type="text" name="busqueda"/>
                <input type="submit" value="Buscar"/>
            </form>
        </div>
    <?php if(isset($_SESSION['usuario'])): ?>
        <div id="usuario-logueado" class="bloque">
            <h3><?php echo "Bienvenido, ".$_SESSION['usuario']['nombre'].' '.$_SESSION['usuario']['apellidos'] ?></h3>
            <a href="crear-entradas.php" class="boton boton-verde">Crear entradas</a>
            <a href="crear-categoria.php" class="boton ">Crear categoria</a>
            <a href="mis-datos.php" class="boton boton-naranja">Mis datos</a>
            <a href="cerrar.php" class="boton boton-rojo">Cerrar Sesion</a>
        </div>
    <?php endif; ?>
    <?php if(!isset($_SESSION['usuario'])): ?>
        <div id="login" class="bloque">
            <h3>Identificate</h3>
            <?php if(isset($_SESSION['error_login'])): ?>
                <div class="alerta alerta-error">
                    <?php echo $_SESSION['error_login'] ?>
                </div>
            <?php endif; ?>

            <form action="login.php" method="POST">
                <label for="email">Email</label>
                <input type="email" name="email"/>

                <label for="password">Contraseña</label>
                <input type="password" name="password"/>

                <input type="submit" value="Entrar"/>
            </form>
        </div>

        <div id="register" class="bloque">
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

            <form action="registro.php" method="POST">
                <label for="nombre">Nombre</label>
                <input type="text" name="nombre"/>
                <?php echo isset($_SESSION['errores']) ? mostrarError($_SESSION['errores'],'nombre') : ''; ?>

                <label for="apellidos">Apellidos</label>
                <input type="text" name="apellidos"/>
                <?php echo isset($_SESSION['errores']) ? mostrarError($_SESSION['errores'],'apellidos') : ''; ?>

                <label for="email">Email</label>
                <input type="email" name="email"/>
                <?php echo isset($_SESSION['errores']) ? mostrarError($_SESSION['errores'],'email') : ''; ?>

                <label for="password">Contraseña</label>
                <input type="password" name="password"/>
                <?php echo isset($_SESSION['errores']) ? mostrarError($_SESSION['errores'],'password') : '' ;?>

                <input type="submit" value="Registrar" name="submit"/>
            </form>
            <?php borrarErrores(); ?>
        </div>
    <?php endif; ?>
</aside>