<?php
use Juegos\Auth\Autenticacion;

require_once __DIR__ . '/../../bootstrap/autoload.php';

$autenticacion = new Autenticacion;

$autenticacion->cerrarSesion();

$_SESSION['msj_exito'] = "Cerraste sesión correctamente. ¡Hasta la proxima!";
header("Location: ../index.php?s=iniciar-sesion");
exit;