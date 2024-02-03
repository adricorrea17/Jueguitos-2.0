<?php
    use Juegos\Modelos\Producto;
    $productos = (new Producto)->data();
?>

<div class="container" id="panelAdmin">
<h1>Administrador de Productos</h1>
    <a href="index.php?s=cargar-producto" class="btn btn-primary cargar">Cargar producto</a>
    <div id="listaPanel">
        <?php 
            foreach($productos as $producto):
        ?>
        <article class="card ">
            <img src="../img/<?= $producto->getImagen();?>" alt="<?= htmlspecialchars($producto->getTitulo());?>" class="col-lg-3 col-md-6 col-sm-6 col-6 p-4">
            <div class="col-lg-7 datosProdPanel p-4">
                <div class="d-flex flex-row">
                <h2><?= htmlspecialchars($producto->getTitulo());?></h2>
                <p class="ms-2">$<?= htmlspecialchars($producto->getPrecio());?> USD</p>
                </div>
                <ul>
                    <li>Categoria: <?=$producto->getNombreCategoria();?></li>
                    <li>Descripcion: <?= htmlspecialchars($producto->getdescripcion());?></li>
                </ul>
            </div>
            <div class="col-lg-2 btnProdPanel">
                <a href="index.php?s=editar-producto&id=<?= $producto->getId();?>" class="btn btn-primary">Editar</a>
                <a href="index.php?s=eliminar-producto&id=<?= $producto->getId();?>" class="btn btn-outline-primary">Eliminar</a>
            </div>
        </article>
        <?php 
            endforeach;
        ?>
    </div>
    </div>