<?php
use Juegos\Auth\Autenticacion;

require_once __DIR__ . '/../bootstrap/autoload.php';

$email = $_POST['email'];
$password = $_POST['password'];

$autenticacion = new Autenticacion();


if(!$autenticacion->iniciarSesion($email, $password)) {
	$_SESSION['data_form'] = $_POST;
	$_SESSION['msj_error'] = "Las credenciales ingresadas no coinciden con nuestros registros.";
	header('Location: ../index.php?s=iniciar-sesion');
	exit;
}

$_SESSION['msj_exito'] = "Sesión iniciada correctamente. ¡Bienvenido/a de nuevo!";

header('Location: ../index.php?s=perfil');
exit;
