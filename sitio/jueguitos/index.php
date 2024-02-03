<?php

require_once __DIR__ . '/bootstrap/autoload.php';

    $rutas = [
        'home' => [
            'title' => 'Home'
        ],
        'iniciar-sesion' => [
            'title' => 'Iniciar Sesión'
        ],
        'perfil' => [
            'title' => 'Mi Perfil',
            'required' => true,
        ],
        'registro' => [
            'title' => 'Registrarse',
        ],
        'shop' => [
            'title' => 'Nuestros juegos'
        ],
        'shop-detalles' => [
            'title' => 'Tienda'
        ],
        'carrito' => [
            'title' => 'Carrito',
            'required' => true,
        ],
        'contact' => [
            'title' => 'Contact'
        ],
        '404' => [
            'title' => '404'
        ],
    ];

    $seccion = $_GET['s'] ?? 'home';
    
    if(!isset($rutas[$seccion])) {
        $seccion = '404';
    }

    $rutaConfig = $rutas[$seccion];

    $autenticacion = new \Juegos\Auth\Autenticacion;

    $required = $rutaConfig['required'] ?? false;

    if($required && !$autenticacion->Autenticado()){
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
    <link rel="stylesheet" href="css/estilos.css?1">
    <link rel="icon" href="juegos.ico">
    <title>Jueguitos: <?= $rutaConfig['title']?></title>
</head>
<body>
    <header class="sticky-top">
        <nav class="navbar-expand-lg navbar navbar-dark bg-dark">
            <div class="container">
                <a class="d-flex align-items-center mb-0 navbar-brand logo" href="index.php?s=home"> Jueguitos </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse justify-content-end" id="navbarNavAltMarkup">
                    <ul class="navbar-nav ml-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link" href="index.php?s=home">Home</a>
                        </li> 
                        <li class="nav-item">
                            <a class="nav-link" href="index.php?s=shop">Tienda</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="index.php?s=contact">Contacto</a>
                        </li>

                        <?php
                        if($autenticacion->Autenticado()):
                        ?>
                            <li class="nav-item">
                                <a class="nav-link" href="index.php?s=carrito">Carrito</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="index.php?s=perfil">Perfil</a>
                            </li>
                            <li class="nav-item">
                                <form action="acciones/verif-cerrar-sesion.php" method="post">
                                    <button type="submit" class="btn btn-dark"><?= htmlspecialchars($autenticacion->getUsuario()->getNombreApellido());?> (Cerrar Sesión)</button>
                                </form>
                            </li>
                        <?php
                        else:
                        ?>
                            <li class="nav-item">
                                <a class="nav-link" href="index.php?s=iniciar-sesion">Iniciar Sesión</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="index.php?s=registro">Registrarse</a>
                            </li>
                        <?php
                        endif;
                        ?>
                    </ul>
                </div>
            </div>
        </nav>
    </header>
    
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
    
    <footer class="fw-light text-white">
        <ul class="m-0 p-0">
            <li>Profesor Gallino Santiago</li>
            <li>Programación II | Final | Correa Adrian | E-commerce PHP</li>
        </ul>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>