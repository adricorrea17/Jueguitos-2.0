<?php
use Juegos\Auth\Autenticacion;
use Juegos\Modelos\Producto;

require_once __DIR__ . '/../../bootstrap/autoload.php';

$autenticacion = new Autenticacion;

if(!$autenticacion->Autenticado() || !$autenticacion->esAdmin()){
    $_SESSION['msj_error'] = "Necesitas iniciar sesión para eliminar un producto";
    header("Location: index.php?s=iniciar-sesion");
    exit;
}

$id = $_POST['id'];
$producto = (new Producto)->productoPorId($id);

if(!$producto) {
    $_SESSION['msj_error'] = "El producto que estás tratando de 
    eliminar no parece existir.";
    header("Location: ../index.php?s=productos");
    exit;
    }
    try {
        
        $producto->eliminar();
        if(!empty($producto->getImagen()) && file_exists(__DIR__ . '/../../img/' . $producto->getImagen())) {

            unlink(__DIR__ . '/../../img/' . $producto->getImagen());
        }
        $_SESSION['msj_exito'] = "El producto <b>" . htmlspecialchars($producto->getTitulo())
        . "</b> fue eliminado con éxito.";
        header("Location: ../index.php?s=productos");
        exit;
    }
        catch (Exception $e) {
            $_SESSION['msj_error'] = "Error inesperado al tratar de eliminar 
            el producto.";
            header("Location: ../index.php?s=productos");
            exit;
            }
            