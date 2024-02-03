<?php
    use Juegos\Modelos\Categoria;

    $categorias = (new Categoria)->todo();
    $errores = $_SESSION['errores'] ?? [];
    $dataForm = $_SESSION['data_form'] ?? [];

    unset($_SESSION['errores'], $_SESSION['data_form']);
    
?>

<div class="container" id="cargarProd">
<h1>Nuevo producto</h1>
<p>Completa el formulario con los datos del nuevo producto</p>

<form action="acciones/crear-producto.php" method="post" enctype="multipart/form-data">

    <div>
        <label for="titulo">Nombre del Producto</label>
        <input	type="text"	id="titulo"	name="titulo" class="form-control" 
        value="<?= $dataForm['titulo'] ?? null;?>" 
        aria-describedby="memo-titulo <?= isset($errores['titulo']) ? "errorTitulo" : '';?>" 
        >
        <div id="memo-titulo" class="mensajeInput">Debe tener mínimo 3 caracteres</div>
        <?php 
        if(isset($errores['titulo'])):
        ?>
            <div class="msg-error-form" id="errorTitulo"><span class="visually-hidden">Error: </span><?= $errores['titulo'];?></div>
        <?php 
        endif;
        ?>
    </div>

    <div>
        <label for="categoria">Categoria</label>
        
        <select name="categoria_fk" id="categoria" class="form-control">
            <?php 
            foreach($categorias as $categoria):
            ?>
            <option 
                value="<?= $categoria->getId();?>"
                <?= $categoria->getId() == ($dataForm['categoria_fk'] ?? null)
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
        <label for="precio">Precio <span>(USD)</span></label>
        <input	type="number"  id="precio"	name="precio" class="form-control" value="<?= $dataForm['precio'] ?? null;?>">
        <?php 
        if(isset($errores['precio'])):
        ?>
            <div class="msg-error-form" id="error-precio"><span class="visually-hidden">Error: </span><?= $errores['precio'];?></div>
        <?php 
        endif;
        ?>
    </div>

    <div>
        <label for="descripcion">descripcion</label>
        <input	type="text"	id="descripcion" name="descripcion" class="form-control" value="<?= $dataForm['descripcion'] ?? null;?>" aria-describedby="memo-descripcion <?= isset($errores['descripcion']) ? "error-descripcion" : '';?>">
        <div id="memo-descripcion" class="mensajeInput">Ejemplo: 3000 mAh</div>
        <?php 
        if(isset($errores['descripcion'])):
        ?>
            <div class="msg-error-form" id="error-descripcion"><span class="visually-hidden">Error: </span><?= $errores['descripcion'];?></div>
        <?php 
        endif;
        ?>
    </div>


    <div>
        <label for="imagen">Cargar imágen <span>(opcional)</span></label>
        <input	type="file" id="imagen" name="imagen" class="form-control">
    </div>

    <button type="submit" class="btn btn-primary">Cargar</button>

</form>
</div>