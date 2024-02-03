<?php 
    use Juegos\Modelos\Producto;
    $productos = (new Producto)->data();
?>

<main>
<picture class="img-fluid">
  <source class="img-fluid" media="(max-width:578px)" srcset="img/bannerTiendaTablet.jpg">
  <img src="img/bannerTienda.jpg" class="img-fluid" alt="Banner de la tienda de videojuegos">
</picture>
    <div id="tienda" class="container">
        <h1>Nuestros videojuegos</h1>
        <p>Podras encontrar juegos de Xbox One, Playstation 4 y Nintendo Switch </p>
        <div id="catalogo" class="row">
            <?php 
            foreach($productos as $producto):
            ?>
            <article class="col-sm-12 col-md-4 col-lg-4 p-sm-5">
                <div class="card">
                    <img src="img/<?= $producto->getImagen();?>" alt="<?= htmlspecialchars($producto->getTitulo());?>">
                    <div class="card-body">
                        <h2 class="fs-md-3"><?= htmlspecialchars($producto->getTitulo());?></h2>
                        <p>$<?= htmlspecialchars($producto->getPrecio());?> USD</p>
                        <a class="btn btn-primary" href="index.php?s=shop-detalles&id=<?= $producto->getId();?>">Ver detalles</a>
                    </div>
                </div>
            </article>
            <?php 
            endforeach;
            ?>
        </div>
    </div>
</main>