<?php
use Juegos\Auth\Autenticacion;
use Juegos\Modelos\ProductoAgregado;

require_once __DIR__ . '/../bootstrap/autoload.php';


$autenticacion = new Autenticacion;

if(!$autenticacion->Autenticado()) {
	$_SESSION['mensaje_error'] = "Se necesita iniciar sesión para realizar esta acción.";
	header("Location: ../index.php?s=carrito" . $autenticacion->getId());
	exit;
}


$id = $_POST['id'];
$productos = new ProductoAgregado;

if(!$productos) {
    $_SESSION['msj_error'] = "El carrito que estás tratando de eliminar no existe.";
    header("Location: ../index.php?s=carrito");
    exit;
    }

try {
	$productos->vaciarProductosAgregados($id);
	$_SESSION['msj_exito'] = "El carrito se vació correctamente";
    header("Location: ../index.php?s=carrito");
	exit;
}catch (Exception $e) {
	$_SESSION['msj_error'] = "Error inesperado al tratar de vaciar el carrito.";
	header("Location: ../index.php?s=carrito");
	exit;
}