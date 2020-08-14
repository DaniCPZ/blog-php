<?php require_once 'includes/cabecera.php'; ?>
<?php require_once 'includes/lateral.php'; ?>

<div id="principal">
<h1>Ultimas entradas</h1>
    <?php 
        $entradas = conseguirEntradas($db, true); 
        if(!empty($entradas)):
            while($entrada = mysqli_fetch_assoc($entradas)): ?>
            
            <article class="entrada">
                <h2><?=$entrada['titulo']?></h2>
                <span class="fecha"><?= $entrada['categoria'].' | '.$entrada['fecha'] ?></span>
                <p><?= substr($entrada['descripcion'], 0, 280).'...' ?></p>
            </article>
    <?php                   
            endwhile;
        endif; 
    ?>    
    <div id="ver-todas">
        <a href="entradas.php">Ver todas las entradas</a>
    </div>
</div>   

<?php require_once 'includes/pie.php'; ?>