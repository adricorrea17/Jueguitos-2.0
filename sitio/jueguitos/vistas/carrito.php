<?php 
    use Juegos\Modelos\Carrito;
    use Juegos\Modelos\ProductoAgregado;
    use Juegos\Auth\Autenticacion;

    $carritos = (new Carrito)->data();
    $productos = (new ProductoAgregado)->data();
    $autenticacion = (new Autenticacion)->getId();

    $lista = (new ProductoAgregado)->listaProductos($productos, $autenticacion);

?>
<main class="container" id="carrito">
<h1>Productos en el carrito</h1>


<table class="table">
    <thead>
        <tr> 
            <th>Imagen</th>
            <th>Nombre</th>
            <th>Cantidad</th>
            <th>Subtotal</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
    <?php 
    foreach($productos as $producto):
        if($producto->getCarritoFk() == $autenticacion):
    ?>
        <tr> 
            <td><img src="img/<?= $producto->getImagen();?>" alt="<?= $producto->getNombre();?>"></td>
            <td><?= $producto->getNombre();?></td>
            <td>x<?= $producto->getCantidad();?> un.</td>
            <td>$<?= $producto->getSubtotal();?> USD</td>
            <td>
            <form action="acciones/eliminar-producto-carrito.php" method="post">
                <input type="hidden" name="id" value="<?= $producto->getProductoAgregadoId();?>">
                <button type="submit" class="btn btn-primary btn-sm">Eliminar</button>
            </form>
            </td>
        </tr>
    <?php 
    endif;
    endforeach;
    ?>
    </tbody>

</table>

<?php 
foreach($carritos as $carrito):
if($carrito->getCarritoId() == $autenticacion):
?>
    <div id="totalCarrito">
        <p>Cantidad total <span>x<?= $carrito->getCantidad();?></span></p>
        <p>Total <span>$<?= $carrito->getTotal();?></span></p>
    </div>
    <div id="formCarrito">
        <form action="acciones/vaciar-carrito.php" method="post">
            <input type="hidden" name="id" value="<?=$autenticacion;?>">
            <button type="submit" class="btn btn-outline-primary">Vaciar Carrito</button>
        </form>
                    
        <form action="acciones/finalizar-compra.php" method="post">
            <input type="hidden" name="cantidad" value="<?=$carrito->getCantidad();?>">
            <input type="hidden" name="total" value="<?=$carrito->getTotal();?>">
            <input type="hidden" name="productos" value="<?=$lista;?>">
            <button type="submit" class="btn btn-primary">Finalizar Compra</button>
        </form>
    </div>

<?php 
endif;
endforeach;
?>
</main>