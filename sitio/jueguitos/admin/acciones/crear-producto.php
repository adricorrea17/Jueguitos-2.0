<?php
use Juegos\Auth\Autenticacion;
use Juegos\Modelos\Producto;
use Juegos\Modelos\Categoria;
use Juegos\Validaciones\ValidarProducto;
use Intervention\Image\ImageManagerStatic as Image;

require_once __DIR__ . '/../../bootstrap/autoload.php';

$autenticacion = new Autenticacion;
$categorias = new Categoria;

if(!$autenticacion->Autenticado() || !$autenticacion->esAdmin()){
    $_SESSION['msj_error'] = "Necesitas iniciar sesión para agregar un producto";
    header("Location: index.php?s=iniciar-sesion");
    exit;
}

$categoria_fk          = $_POST['categoria_fk'];
$titulo				= $_POST['titulo'];
$precio 			= $_POST['precio'];
$descripcion 			= $_POST['descripcion'];
$imagen	            = $_FILES['imagen'];

$validador = new ValidarProducto([
    'titulo' => $titulo,
	'precio' => $precio,
	'descripcion' => $descripcion,
	'imagen' => $imagen,
]);

if($validador->erroresEncontrados()) {
    
    $_SESSION['errores'] = $validador->obtenerError();
    $_SESSION['data_form'] = $_POST;
    header("Location: ../index.php?s=cargar-producto");
    exit;

    }    


if(!empty($imagen['tmp_name'])) {

	$nombreImg = date('YmdHis_') . $imagen['name'];
	
    $img = Image::make($imagen['tmp_name']);

    $img->save(__DIR__ . '/../../img/' . $nombreImg);

}

try {
    (new Producto)->crear([
        'usuario_fk' => $autenticacion->getId(),
        'categoria_fk' => $categoria_fk,
        'titulo' => $titulo,
        'precio' => $precio,
        'descripcion' => $descripcion,
        'imagen' => $nombreImg ?? null,
    ]);

    $_SESSION['msj_exito'] = "El producto <b>" . htmlspecialchars($titulo) . "</b> se agregó exitosamente al catálogo.";

    header("Location: ../index.php?s=productos");
    exit;

} catch (Exception $e) {

    $_SESSION['msj_error'] = "Error inesperado al cargar el producto. Por favor, probá mas tarde.";
	$_SESSION['data_form'] = $_POST;

    header("Location: ../index.php?s=cargar-producto");
    exit;

}