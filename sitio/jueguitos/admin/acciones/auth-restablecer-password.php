<?php
use Juegos\Auth\RecuperarPassword;
use Juegos\Modelos\Usuario;

require_once __DIR__ . '/../../bootstrap/autoload.php';

$id 				= $_POST['id'];
$token 				= $_POST['token'];
$password 			= $_POST['password'];
$password_confirmar = $_POST['password_confirmar'];

$usuario = (new Usuario)->obtenerPorId($id);

if(!$usuario) {
	$_SESSION['msj_error'] = "El usuario al que se le está tratando de actualizar el password no existe.";
	$_SESSION['data_form'] = $_POST;
	header("Location: ../index.php?s=actualizar-password&token=" . $token . "&id=" . $id);
	exit;
}

$recuperar = new Juegos\Auth\RecuperarPassword;
$recuperar->setUsuario($usuario);
$recuperar->setToken($token);

if(!$recuperar->existe()) {
	$_SESSION['msj_error'] = "Este link para actualizar el password no es correcto, o ha expirado. Si lo necesitás, podés pedir otro email para restablecerlo.";
	$_SESSION['data_form'] = $_POST;
	header("Location: ../index.php?s=restablecer-password");
	exit;
}

if($recuperar->expirado()) {
	$_SESSION['msj_error'] = "Este link para actualizar el password ha expirado. Si lo necesitás, podés pedir otro email para restablecerlo.";
	$_SESSION['data_form'] = $_POST;
	header("Location: ../index.php?s=restablecer-password");
	exit;
}

try {
	$recuperar->actualizarPassword(password_hash($password, PASSWORD_DEFAULT));

	$_SESSION['msj_exito'] = "El password fue actualizado correctamente. Podés iniciar sesión.";
	header("Location: ../index.php?s=iniciar-sesion");
	exit;
} catch (Exception $e) {
	$_SESSION['msj_error'] = "Ocurrió un error inesperado y el password no pudo ser actualizado. " . $e->getMessage();
	$_SESSION['data_form'] = $_POST;
	header("Location: ../index.php?s=actualizar-password&token=" . $token . "&id=" . $id);
	exit;	
}