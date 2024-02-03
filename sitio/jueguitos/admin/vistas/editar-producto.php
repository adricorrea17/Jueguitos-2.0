<?php
    use Juegos\Modelos\Producto;
    use Juegos\Modelos\Categoria;

    $errores = $_SESSION['errores'] ?? [];
    $dataForm = $_SESSION['data_form'] ?? [];

    unset($_SESSION['errores'], $_SESSION['data_form']);

    $producto = (new Producto)->productoPorId($_GET['id']);
    $categorias = (new Categoria)->todo();
?>

<div class="container" id="confirmarEditar">
<h1>Editar Producto</h1>
<p>Completa el formulario con los nuevos datos del producto. Una vez finalizado, dale click a "Editar producto".</p>

<form action="acciones/editar-producto.php" method="post" enctype="multipart/form-data">
    <input type="hidden" name="producto_id" value="<?= $producto->getId();?>">

    <div>
        <label for="titulo">Nombre del Producto</label>
        <input	type="text"	id="titulo"	name="titulo" class="form-control" value="<?= $dataForm['titulo'] ?? 
        $producto->getTitulo();?>" <?php if(isset($errores['titulo'])): ?> aria-describedby="errorTitulo" <?php endif;?>>
        <?php 
        if(isset($errores['titulo'])):
        ?>
            <div class="msg-error-form" id="errorTitulo"><span class="visually-hidden">Error: </span><?= $errores['titulo'];?></div>
        <?php 
        endif;
        ?>
    </div>

    <div>
        <label for="categoria_fk">Categoria</label>
        
        <select name="categoria_fk" id="categoria_fk" class="form-control">
            <?php 
            foreach($categorias as $categoria):
            ?>
            <option 
                value="<?= $categoria->getId();?>"
                <?= $categoria->getId() == ($dataForm['categoria_fk'] ?? $producto->getCategoria())
                    ? "selected"
                    : "";?>
            >
                <?= $categoria->getNombre();?>
            </option>
            <?php 
            endforeach;
            ?>
        </select>
    </div>

    <div>
        <label for="precio">Precio <span>(USD - precio con dos decimales)</span></label>
        <input	type="number"  id="precio"	name="precio" class="form-control" value="<?= $dataForm['precio'] ?? 
        $producto->getPrecio();?>">
        <?php 
        if(isset($errores['precio'])):
        ?>
            <div class="msg-error-form" id="error-precio"><span class="visually-hidden">Error: </span><?= $errores['precio'];?></div>
        <?php 
        endif;
        ?>
    </div>

    <div>
        <label for="descripcion">Descripcion</label>
        <input	type="text"	id="descripcion" name="descripcion" class="form-control" value="<?= $dataForm['descripcion'] ?? 
        $producto->getdescripcion();?>">
        <?php 
        if(isset($errores['descripcion'])):
        ?>
            <div class="msg-error-form" id="error-descripcion"><span class="visually-hidden">Error: </span><?= $errores['descripcion'];?></div>
        <?php 
        endif;
        ?>
    </div>

    <?php
    if(!empty($producto->getImagen()) && file_exists(__DIR__ . '/../../img/' . $producto->getImagen())):
    ?>
    <div class="imgForm">
        <p>Imagen actual</p>
        <img src="<?= '../img/' . $producto->getImagen();?>" alt="<?=$producto->getTitulo();?>">
    </div>
    <?php
    endif;
    ?>
    
    <div>
        <label for="imagen">Cargar imágen</label>
        <input	type="file" id="imagen" name="imagen" class="form-control">
    </div>

    <button type="submit" class="btn btn-primary">Editar producto</button>

</form>

</div>