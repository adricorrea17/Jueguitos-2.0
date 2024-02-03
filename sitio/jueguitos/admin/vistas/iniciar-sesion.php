<?php
$dataForm = $_SESSION['data_form'] ?? [];
unset($_SESSION['data_form']);
?>

<div class="container" id="iniciar">
    <h1 class="mb-1">Ingresar al Panel de Administración</h1>
    <p class="mb-1">Para ingresar es necesario iniciar sesión. Por favor, 
    ingresá tus credenciales de acceso en el form.</p>
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
        </div>
        <button type="submit" class="btn btn-primary">Ingresar</button>
    </form>

    <p>¿Olvidaste tu contraseña? <a href="#">Pedí restablecer su contraseña</a>.</p>
    
</div>