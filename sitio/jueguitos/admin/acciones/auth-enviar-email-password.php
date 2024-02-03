<?php
use Juegos\Modelos\Usuario;

require_once __DIR__ . '/../../bootstrap/autoload.php';

$email = $_POST['email'];

$usuario = (new Usuario)->obtenerPorEmail($email);

if(!$usuario) {
    $_SESSION['msj_error'] = "El email no corresponde a ningún usuario en nuestros registros.";
    $_SESSION['data_form'] = $_POST;
    header("Location: ../index.php?s=restablecer-password");
    exit;
}

// Manejo del envío del email.
$recuperar = new Juegos\Auth\RecuperarPassword;
$recuperar->setUsuario($usuario);

try {
    $recuperar->enviarEmailDeRecuperacion();
    
    $_SESSION['msj_exito'] = "Se envió un email con las instrucciones necesarias.";
    header("Location: ../index.php?s=iniciar-sesion");
    exit;
} catch (Exception $e) {
    $_SESSION['msj_error'] = "Ocurrió un error inesperado y el email no pudo ser enviado.";
    $_SESSION['data_form'] = $_POST;
    header("Location: ../index.php?s=restablecer-password");
    exit;
}
