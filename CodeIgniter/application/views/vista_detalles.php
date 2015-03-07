<?= form_open(site_url().'/carrito/agregarProducto');?>

<div class="panel panel-info">
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
				
				<?php if(isset($preciofinal)) : ?>
					<p>Precio: <s><?= $precio?>€</s></p>
					<p>Descuento: <?= $descuento?>%. Precio final: <strong><?= $preciofinal?>€</strong></p>
				<?php else : ?>
					<p>Precio: <strong><?= $precio?>€</strong></p>
				<?php endif;?>
				
				<p style="color: green">
					<strong>En stock: <?=$stock ?></strong>
				</p>
				</blockquote>
				

				<p><label>Cantidad </label>
					<?php 
					if (isset($stock) && $stock != 0)
					{
						$datos = array();
						for($i=1; $i<=$stock; $i++)
						{
							$datos[$i]=$i;
						}
						echo form_dropdown('cantidad', $datos);
					}?>
				</p>
                 <?= form_hidden('id', $id); ?>
				<button type="submit" class="btn btn-success">
					<span class="glyphicon glyphicon-shopping-cart" aria-hidden="true"></span>
					Añadir al carrito
				</button>	
				
			</div>
			<br>
			<br>
			<p align="justify">Detalles del producto:<br><?=$anuncio ?></p>
		</div>
	</div>

	<div class="panel-footer">
		<a href="<?=site_url()?>">Volver</a>
	</div>
</div>