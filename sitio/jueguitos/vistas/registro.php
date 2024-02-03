<section>
    <div class="container" id="registro">
    <h1 class="mb-1">Registrarse</h1>
    <p>¡Bienvenido/a a la mejor pagina de videojuegos! Completá el formulario con tus datos para crear tu cuenta.</p>

    <form action="acciones/verif-registro.php" method="post">
        <div class="form-fila">
            <label for="nombre">Nombre</label>
            <input type="text" id="nombre" name="nombre" class="form-control">
        </div>
        <div class="form-fila">
            <label for="apellido">Apellido</label>
            <input type="text" id="apellido" name="apellido" class="form-control">
        </div>
        <div class="form-fila">
            <label for="email">Email</label>
            <input type="email" id="email" name="email" class="form-control">
        </div>
        <div class="form-fila">
            <label for="password">Password</label>
            <input type="password" id="password" name="password" class="form-control">
        </div>
        <div class="form-fila">
            <label for="password_confirmar">Confirmar Password</label>
            <input type="password" id="password_confirmar" name="password_confirmar" class="form-control">
        </div>
        <button type="submit" class="btn btn-primary">Crear cuenta</button>
    </form>
    <p>¿Ya tienes una cuenta? <a href="index.php?s=iniciar-sesion">Iniciar sesión</a>.</p>
</div>
</section>