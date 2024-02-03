<?php
    use Juegos\Modelos\Compras;
    use Juegos\Modelos\Usuario;

    $usuarios = (new Usuario)->todo();
    $compra = (new Compras)->data();
 
?>
<div class="container" id="usuarios">
    <h1>Usuarios registrados</h1>
    <table class="table table-hover">
        <thead>
            <tr>
                <th>Usuario</th>
                <th>Email</th>
                <th>Historial</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            foreach($usuarios as $usuario):
            ?>
            <tr>
                <td><?=htmlspecialchars($usuario->getNombreApellido())?></td>
                <td><?=htmlspecialchars($usuario->getEmail())?></td>
                <td>
                    <a class="btn btn-primary " href="index.php?s=compras-usuarios&id=<?= $usuario->getUsuarioId();?>">Ver compras</a>
                </td>
            </tr>
            <?php 
            endforeach;
            ?>
        </tbody>
    </table>
</div>