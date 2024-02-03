<?php
use Juegos\Auth\Autenticacion;

$autenticacion = new Autenticacion;
?>
<div class="container" id="panel">
    <h1>Panel de administración</h1>

    <p>¡Hola <?= htmlspecialchars($autenticacion->getUsuario()->getNombreApellido());?>!</p>
    <p>Para agregar, modificar o eliminar productos ve a la pestaña "Productos". </br>
        Pero si usted desea ver las compras de los usuarios vaya a la pestaña de "Usuarios"</p>
    <a class="btn btn-primary" href="../index.php?s=perfil">Volver al perfil</a>
</div>