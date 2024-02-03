<?php
$dataForm = $_SESSION['data_form'] ?? [];
unset($_SESSION['data_form']);
?>

<div class="container" id="iniciarSesion">
    <h1 class="mb-1">Iniciar Sesión</h1>
    <p class="mb-1">Por favor, ingresá tus credenciales de acceso.</p>
    <form action="acciones/verif-iniciar-sesion.php" method="post">
        <div>
            <label for="email">Email</label>
            <input 
                type="email" 
                id="email" 
                name="email" 
                class="form-control"
                value="<?= $dataForm['email'] ?? null;?>"
            >
        </div>
        <div>
            <label for="password">Password</label>
            <input 
                type="password" 
                id="password" 
                name="password" 
                class="form-control"
                value="<?= $dataForm['password'] ?? null;?>"
            >
            <a class="linkPassword" href="index.php?s=restablecer-password">¿Olvidaste tu contraseña?</a>
        </div>
        <button type="submit" class="btn btn-primary">Ingresar</button>
    </form>
    <p>¿Todavía no tienes una cuenta? <a href="index.php?s=registro">Regístrate</a>.</p>
</div>
