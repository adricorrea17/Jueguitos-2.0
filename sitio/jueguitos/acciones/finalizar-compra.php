<?php
use Juegos\Auth\Autenticacion;
use Juegos\Modelos\Compras;
use Juegos\Modelos\ProductoAgregado;

require_once __DIR__ . '/../bootstrap/autoload.php';

$autenticacion = new Autenticacion;

if(!$autenticacion->Autenticado()) {
	$_SESSION['msj_error'] = "No podés realizar una compra sin iniciar sesión";
	header('Location: ../index.php?s=carrito');
	exit;
}

$id = $autenticacion->getId();
$cantidad   = $_POST['cantidad'];
$total      = $_POST['total'];
$productos  = $_POST['productos'];

$compras = (new Compras)->data();
$productosAgregados = new ProductoAgregado;

try{
    (new Compras)->AddCompras([
        'carrito_fk' => $id,
        'usuario_fk' => $id,
        'fecha' => date('Y-m-d H:i:s'),
        'cantidad' => $cantidad,
        'total' => $total,
        'productos' => $productos,
    ]);

    $productosAgregados->vaciarProductosAgregados($id);

    $_SESSION['msj_exito'] = "Tu compra se realizó con éxito";
    header('Location: ../index.php?s=perfil');
    exit;

} catch (Exception $e) {

    $_SESSION['msj_error'] = "Error inesperado al finalizar la compra. Por favor, probá mas tarde.";
    header('Location: ../index.php?s=carrito');
    exit;
};


