<?php
use Juegos\Modelos\Usuario;
use Juegos\Modelos\Carrito;

require_once __DIR__ . '/../bootstrap/autoload.php';

$email 				= $_POST['email'];
$password 			= $_POST['password'];
$password_confirmar = $_POST['password_confirmar'];
$nombre             = $_POST['nombre'];
$apellido           = $_POST['apellido'];

try {

	(new Usuario)->crearUsuario([
		'email' => $email,
		'password' => password_hash($password, PASSWORD_DEFAULT),
		'rol_fk' => 2,
		'nombre' => $nombre,
		'apellido' => $apellido,
	]);

	$usuario = (new Usuario)->obtenerPorEmail($email);
	(new Carrito)->crearCarrito([
		'carrito_id' => $usuario->getUsuarioId(),
		'usuario_fk' => $usuario->getUsuarioId(),
	]);

	$_SESSION['msj_exito'] = "Tu cuenta fue creada con éxito. Ya podés iniciar sesión.";
	header("Location: ../index.php?s=iniciar-sesion");
	exit;
} catch (Exception $e) {
	$_SESSION['msj_error'] = "Ocurrió un error inesperado al tratar de crear tu cuenta. " . $e->getMessage();
	header("Location: ../index.php?s=registro");
	exit;
}
