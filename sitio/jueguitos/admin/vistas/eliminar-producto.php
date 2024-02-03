<?php
use Juegos\Modelos\Producto;

$producto = (new Producto)->productoPorId($_GET['id']);
?>
<div class="container" id="confirmarBorrar">
	<h1>Eliminar Producto</h1>
	<p>¿Estás seguro que deseas eliminar <span><?= htmlspecialchars($producto->getTitulo());?></span>? Al dar click en el botón se borrará definitivamente. </p>
	<ul>
		<li>
			<img src="../img/<?= htmlspecialchars($producto->getImagen());?>" alt="<?= htmlspecialchars($producto->getTitulo());?>">
		</li>
		<li>
			<ul>
				<li><span>Nombre:</span> <?= htmlspecialchars($producto->getTitulo());?></li>
				<li><span>Precio:</span> <?= htmlspecialchars($producto->getPrecio());?></li>
				<li><span>Batería:</span> <?= htmlspecialchars($producto->getdescripcion());?></li>
			</ul>
		</li>
	</ul>
	<form action="acciones/eliminar-producto.php" method="post">
		<input type="hidden" name="id" value="<?= $producto->getId();?>">
		<button type="submit" class="btn btn-primary">Eliminar</button>
	</form>

</div>