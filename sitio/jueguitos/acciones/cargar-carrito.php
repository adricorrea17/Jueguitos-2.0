<?php
use Juegos\Auth\Autenticacion;
use Juegos\Modelos\ProductoAgregado;

require_once __DIR__ . '/../bootstrap/autoload.php';

$autenticacion = new Autenticacion;

$id = $_POST['id'];
$cantidad = $_POST['cantidad'];
$subtotal = $_POST['precio'];
$titulo = $_POST['titulo'];

$productos = (new ProductoAgregado)->data();

if(!$autenticacion->Autenticado()) {
	$_SESSION['msj_error'] = "No podés agregar un producto sin iniciar sesión";
	header('Location: ../index.php?s=shop-detalles&id=' . $id);
	exit;
}

foreach($productos as $producto):

    if ($producto->getProductoFk() == $id && $producto->getCarritoFk() == $autenticacion->getId()){
    $indice = $producto->getProductoAgregadoId();
    $cantidadExistente = $producto->getCantidad();

    try{ 
        (new ProductoAgregado)->sumarProducto($indice, [
        'cantidad' => $cantidad + $cantidadExistente,
        'subtotal' => $subtotal * ($cantidad + $cantidadExistente),
        ]);

        $_SESSION['msj_exito'] = "YAY! Se sumaron más unidades de este producto a tu carrito";
            header("Location: ../index.php?s=shop-detalles&id=" . $id);
            exit;


        } catch (Exception $e) {
            $_SESSION['msj_error'] = "Error inesperado al agregar más unidades del producto. Por favor, probá mas tarde.";
            header('Location: ../index.php?s=shop-detalles&id=' . $id);
            exit;
        };
    }
    
endforeach;


try{
    (new ProductoAgregado)->AddLista([
    'carrito_fk' => $autenticacion->getId(),
    'producto_fk' => $id,
    'nombre' => $titulo,
    'cantidad' => $cantidad,
    'subtotal' => $subtotal * $cantidad,
    ]);

    $_SESSION['msj_exito'] = "Producto agregado exitosamente";
    header('Location: ../index.php?s=shop-detalles&id=' . $id);
    exit;
}
catch(Exception $e){
    $_SESSION['msj_error'] = "Error inesperado al cargar el producto en el carrito. Por favor, probá mas tarde.";
    header('Location: ../index.php?s=shop-detalles&id=' . $id);
    exit;
}

