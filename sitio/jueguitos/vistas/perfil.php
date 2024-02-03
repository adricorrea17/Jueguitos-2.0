<?php
use Juegos\Auth\Autenticacion;
use Juegos\Modelos\Compras;

$usuario = (new Autenticacion)->getUsuario();
$id = (new Autenticacion)->getId();

$compras = (new Compras)->obtenerPorComprador($id);

?>
<section id="perfil">
<div class="bannerPerfil"></div>
	<div class="container">
		<div class="row">

			<div class="card col-lg-3" id="infoPerfil">
				<img src="img/user.png" alt="imagen de usuario">
				<h1 class="mb-1">Mi Perfil</h1>
				<dl>
					<dt>Email</dt>
					<dd><?= htmlspecialchars($usuario->getEmail());?></dd>
					<dt>Usuario</dt>
					<dd><?= htmlspecialchars($usuario->getNombreApellido());?></dd>
				</dl>
			</div>

			<div class="card col-lg-9 col-6" id="compraPerfil">
				<div class="tituloCompraPerfil">
					<h2>Mis compras</h2>
					<?php 
					if($autenticacion->esAdmin()):
					?>
					<a class="btn btn-primary" href="admin">Panel de administración</a>
					<?php
					endif;
					?>
				</div>

				<div class="row historial">
					<?php 
					foreach($compras as $compra):
					?>
					<article class="card col-lg-11 col-6">
						
					<div class="card-body">
						<picture>
							<img src="img/bag.png" alt="icono de bolsa de compra">
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
		</div>
	</div>
</section>