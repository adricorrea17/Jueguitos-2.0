<?php
use Juegos\Auth\Autenticacion;
use Juegos\Modelos\Producto;
use Juegos\Validaciones\ValidarProducto;
use Intervention\Image\ImageManagerStatic as Image;

require_once __DIR__ . '/../../bootstrap/autoload.php';

$autenticacion = new Autenticacion;

if(!$autenticacion->Autenticado() || !$autenticacion->esAdmin()){
    $_SESSION['msj_error'] = "Necesitas iniciar sesión para editar un producto";
    header("Location: index.php?s=iniciar-sesion");
    exit;
}

$id		            = $_POST['producto_id'];
$categoria_fk		= $_POST['categoria_fk'];
$titulo				= $_POST['titulo'];
$precio 			= $_POST['precio'];
$descripcion 		= $_POST['descripcion'];
$imagen	            = $_FILES['imagen'];

$producto = (new Producto)->productoPorId($id);

if(!$producto) {
	$_SESSION['msj_error'] = "El producto que estás tratando de editar no parece existir.";
	header("Location: ../index.php?s=productos");
	exit;
}

$validador = new ValidarProducto([
	'titulo' => $titulo,
	'precio' => $precio,
	'descripcion' => $descripcion,
	'imagen' => $imagen,
]);

if($validador->erroresEncontrados()) {
    
    $_SESSION['errores'] = $validador->obtenerError();
    $_SESSION['data_form'] = $_POST;
    header("Location: ../index.php?s=editar-producto&id=" . $id);
    exit;

    }    


    if(!empty($imagen['tmp_name'])) {

        $nombreImg = date('YmdHis_') . $imagen['name'];
    
        $img = Image::make($imagen['tmp_name']);
    
        $img
            ->save(__DIR__ . '/../../img/' . $nombreImg);
            
    }

try {
    (new Producto)->editar($id, [
        'usuario_fk' => $autenticacion->getId(),
        'categoria_fk' => $categoria_fk,
        'titulo' => $titulo,
        'precio' => $precio,
        'descripcion' => $descripcion,
        'imagen' => $nombreImg ?? $producto->getImagen(),
    ]);

    $_SESSION['msj_exito'] = "El producto <b>" . htmlspecialchars($titulo) . "</b> se editó correctamente.";

    header("Location: ../index.php?s=productos");
    exit;

} catch (Exception $e) {

    $_SESSION['msj_error'] = "Error inesperado al cargar el producto. Por favor, probá mas tarde.";
	$_SESSION['data_form'] = $_POST;

    header("Location: ../index.php?s=editar-producto&id=" . $id);
    exit;

}