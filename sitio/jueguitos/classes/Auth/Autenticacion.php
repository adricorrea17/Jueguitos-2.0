<?php
namespace Juegos\Auth;
use Juegos\Modelos\Usuario;

class Autenticacion
{
    public function iniciarSesion(string $email, string $password): int
    {

        $usuario = (new Usuario)->obtenerPorEmail($email);
        if(!$usuario) {
        return false;
        }

        if(!password_verify($password, $usuario->getPassword())) {
        return false;
        }

        $this->autenticar($usuario);
        return true;
    }

    public function autenticar(Usuario $usuario): void
    {
        $_SESSION['usuario_id'] = $usuario->getUsuarioId();
        $_SESSION['rol_id'] = $usuario->getRolFk();
    }

    public function cerrarSesion(): void
    {
        unset($_SESSION['usuario_id'], $_SESSION['rol_id']);
    }

    public function Autenticado(): bool
    {
        return isset($_SESSION['usuario_id']);
    }

    public function esAdmin(): bool
    {
        return $_SESSION['rol_id'] === 1;
    }

    public function getId(): ?int
    {
        return $this->Autenticado() ?
            $_SESSION['usuario_id'] :
            null;
    }

    public function getUsuario(): ?Usuario
    {
        return $this->Autenticado() ?
            (new Usuario)->obtenerPorId($_SESSION['usuario_id']) : 
            null;
    }

}