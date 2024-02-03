<?php
use Juegos\Auth\Autenticacion;
use Juegos\Modelos\ProductoAgregado;

require_once __DIR__ . '/../bootstrap/autoload.php';


$autenticacion = new Autenticacion;

if(!$autenticacion->Autenticado()) {
	$_SESSION['mensaje_error'] = "Se necesita iniciar sesión para realizar esta acción.";
	header("Location: ../index.php?s=carrito");
	exit;
}

$id = $_POST['id'];

$productoAgregado = (new ProductoAgregado)->obtenerPorId($id);

if(!$productoAgregado) {
    $_SESSION['msj_error'] = "El producto que estás tratando de 
    eliminar no parece existir.";
    header("Location: ../index.php?s=carrito");
    exit;
    }

try {
	$productoAgregado->eliminar();
	$_SESSION['msj_exito'] = "El producto fue eliminado con éxito.";
	header("Location: ../index.php?s=carrito");
	exit;
}catch (Exception $e) {
	$_SESSION['msj_error'] = "Error inesperado al tratar de eliminar 
	el producto.";
	header("Location: ../index.php?s=carrito");
	exit;
}