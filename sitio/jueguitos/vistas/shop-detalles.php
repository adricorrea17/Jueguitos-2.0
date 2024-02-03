<?php 
use Juegos\Modelos\Producto;
$producto = (new Producto)->productoPorId($_GET['id']);
?>
<main id="detalle" class="container d-flex align-items-center justify-content-center">
	<article class="row productoDetalle justify-content-center">
        <img src="img/<?= $producto->getImagen();?>" alt="<?= htmlspecialchars($producto->getTitulo());?>" class="p-3 col-5 col-xs-6 col-sm-6 col-md-6 col-lg-4">
        <div class="infoProducto col-xs-12 col-sm-10 col-md-6 col-lg-6">
            <h1><?= htmlspecialchars($producto->getTitulo());?></h1>
            <p>$<?= htmlspecialchars($producto->getPrecio());?> USD</p>
            <h2>Descripcion</h2>
            <ul>
               <li><?= htmlspecialchars($producto->getdescripcion());?></li>
            </ul>
            <?php
            if($autenticacion->Autenticado()):
            ?>
                <form action="acciones/cargar-carrito.php" method="post">
                    <input class="form-control" type="number" id="cantidad" name="cantidad" value="<?= $dataForm['cantidad'] ?? 1;?>" min="1">
                    <input type="hidden" name="id" value="<?= $producto->getId();?>">
                    <input type="hidden" name="precio" value="<?= $producto->getPrecio();?>">
                    <input type="hidden" name="titulo" value="<?= $producto->getTitulo();?>">

                    <button type="submit" class="btn btn-primary">Comprar Ahora</button>
                </form>
            <?php       
            else:
            ?>
                <a class="btn btn-primary" href="index.php?s=iniciar-sesion">Iniciar Sesión</a>
                <p class="mt-2">Tenés que iniciar sesión para realizar una compra.</p>
            <?php
            endif;
            ?>
        </div>
</article>
</main>

