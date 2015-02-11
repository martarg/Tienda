<div class="panel panel-success">
	<div class="panel-heading">
		<h3 class="panel-title"><?=$nombre?></h3>
	</div>
	<div class="panel-body">
		<div class="media">
			<div class="media-left media-top">
				<img class="media-object" src="<?= base_url($imagen);?>">
			</div>
			<div class="media-body">
				<blockquote>
				<p><?=$descripcion ?></p>
				<p>Precio: <strong><?= $precio?>€</strong></p>
				<p style="color: green;">
					<strong>En stock: <?=$stock ?></strong>
				</p>
				</blockquote>
			</div>
			<br>
			<br>
			<p align="justify">Detalles del producto:<br><?=$anuncio ?></p>
		</div>

		<!-- <p>Cantidad
		<select class="form-control">
			<option>$stock</option>
		</select></p> -->
	</div>

	<div class="panel-footer">
		<a href="<?=site_url()?>">Volver</a>
	</div>
</div>