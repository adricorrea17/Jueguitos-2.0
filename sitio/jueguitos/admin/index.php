<?php

require_once __DIR__ . '/../bootstrap/autoload.php';

$rutas = [
    'iniciar-sesion' => [
        'title' => 'Ingresar',
    ],
    'restablecer-password' => [
        'title' => 'Solicitar Restablecer Password',
    ],
    'actualizar-password' => [
        'title' => 'Restablecimiento de Password',
    ],
    'panel' => [
        'title' => 'Panel',
        'required' => true,
    ],
    'productos' => [
        'title' => 'Administrador de Productos',
        'required' => true,
    ],
    'usuarios' => [
        'title' => 'Administrador de Usuarios',
        'required' => true,
    ],
    'compras-usuarios' => [
        'title' => 'Compras de usuarios',
        'required' => true,
    ],
    'cargar-producto' => [
        'title' => 'Cargar producto',
        'required' => true,
    ],
    'editar-producto' => [
        'title' => 'Editar producto',
        'required' => true,
    ],
    'eliminar-producto' => [
        'title' => 'Eliminar producto',
        'required' => true,
    ],
    '404' => [
        'title' => 'Página no Encontrada',
    ],

];

$seccion = $_GET['s'] ?? 'panel';

if(!isset($rutas[$seccion])) {
    $seccion = '404';
}

$rutaConfig = $rutas[$seccion];

$autenticacion = new \Juegos\Auth\Autenticacion;

$required = $rutaConfig['required'] ?? false;

if($required && 
    (!$autenticacion->Autenticado() || !$autenticacion->esAdmin())
){
    $_SESSION['msj_error'] = "Necesitas iniciar sesión para ingresar a esta página";
    header("Location: index.php?s=iniciar-sesion");
    exit;
}

$msjExito = $_SESSION['msj_exito'] ?? null;
$msjError = $_SESSION['msj_error'] ?? null;

unset($_SESSION['msj_exito'], $_SESSION['msj_error']);
?>

<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/estilos.css?1">
    <link rel="icon" href="../juegos.ico">
    <title><?= $rutaConfig['title']?> :: Administración Juegos</title>
</head>
<body>
<header class="sticky-top">
        <a href="#principal" class="visually-hidden-focusable">Saltar al contenido principal</a>
        <nav class="navbar-expand-lg navbar navbar-dark bg-dark">
            <div class="container">
                    <a class="d-flex align-items-center mb-0 navbar-brand logo" href="../index.php"> Juegos </a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <div class="collapse navbar-collapse justify-content-end" id="navbarNavAltMarkup">

                    <?php
                    if($autenticacion->Autenticado() && $autenticacion->esAdmin()):
                    ?>
                        <ul class="navbar-nav ml-auto mb-2 mb-lg-0">
                            <li class="nav-item">
                                <a class="nav-link" href="../index.php">Home</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="index.php?s=panel">Panel</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="index.php?s=productos">Productos</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="index.php?s=usuarios">Usuarios</a>
                            </li>
                            <li class="nav-item">
                                <form action="acciones/verif-cerrar-sesion.php" method="post">
                                    <button type="submit" class="btn btn-dark"><?= htmlspecialchars($autenticacion->getUsuario()->getNombreApellido());?> (Cerrar Sesión)</button>
                                </form>
                            </li>
                        </ul>
                    <?php
                    endif;
                    ?>
                    </div>
            </div>
        </nav>

    </header>
    <main id="principal">
        <?php 
        if($msjExito):
        ?>
            <div class="msg-success"><div class="container"><?= $msjExito;?></div></div>
        <?php 
        endif;
        ?>
        <?php 
        if($msjError):
        ?>
            <div class="msg-error"><div class="container"><?= $msjError;?></div></div>
        <?php 
        endif;
        ?>
        <?php

            $archivo = __DIR__ . '/vistas/' . $seccion . '.php';
            if (file_exists($archivo)){
                require $archivo;
            } else {
                require __DIR__ . '/vistas/404.php';
            }

        ?>
    </main>
    <footer class="fw-light text-white">
        <ul class="m-0 p-0">
            <li>Profesor Gallino Santiago</li>
            <li>Programación II | Final | Correa Adrian | E-commerce PHP</li>
        </ul>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>