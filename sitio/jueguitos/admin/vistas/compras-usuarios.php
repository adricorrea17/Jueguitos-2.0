<?php 
use Juegos\Modelos\Compras;
use Juegos\Modelos\Usuario;


$id = $_GET['id'];
$compras = (new Compras)->obtenerPorComprador($id);
$usuario = (new Usuario)->obtenerPorId($id); 

?>
<div id="comprasUsuarios" class="container">
    <h1>Compras de <?= htmlspecialchars($usuario->getNombreApellido());?></h1>
    <p><?= htmlspecialchars($usuario->getEmail());?></p>

    <div class="row historial">
        
    <?php 
    foreach($compras as $compra):
	?>
		<article class="card col-lg-11">
			<div class="card-body">
			<picture>
			<img src="../img/bag.png" alt="icono de bolsa de compra">
			</picture>
			<div class="card-body-info">
			<div>
			<h3>Compra realizada<span>Código #<?= $compra->getCompraId();?></span></h3>
			<p><?= $compra->getFecha();?></p>
			</div>
			<ul>
				<li>Productos:
					<ul>
						<?php 
						foreach($compra->getProductos() as $item):
						?>
						<li><span><?=$item?></span></li>
						<?php
						endforeach;
						?>
					</ul>
				</li>
				<li class="cantListaPerfil">Cantidad total x<?= $compra->getCantidad();?></li>
				<li class="totalListaPerfil">Total $<?= $compra->getTotal();?> USD</li>
			</ul>
			</div>
			</div>
		</article>
		<?php
	endforeach;
	?>
    </div>

</div>