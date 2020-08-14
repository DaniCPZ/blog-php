<?php require_once 'includes/cabecera.php'; ?>
<?php require_once 'includes/lateral.php'; ?>

<div id="principal">
<h1>Todas las entradas</h1>
    <?php 
        $entradas = conseguirEntradas($db); 
        if(!empty($entradas)):
            while($entrada = mysqli_fetch_assoc($entradas)): ?>
            
            <article class="entrada">
            <a href="entrada.php?id=<?=$entrada['id']?>">
                <h2><?=$entrada['titulo']?></h2>
            </a>
                <span class="fecha"><?= $entrada['categoria'].' | '.$entrada['fecha'] ?></span>
                <p><?= substr($entrada['descripcion'], 0, 280).'...' ?></p>
            </article>
    <?php                   
            endwhile;
        endif; 
    ?> 
</div>   

<?php require_once 'includes/pie.php'; ?>