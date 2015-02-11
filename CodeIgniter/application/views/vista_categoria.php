<div class="row">
<p>CATEGORIA</p>
<?php 
	foreach ($rs_prod as $fila) :
	
	if($fila['oculto']==0) :
?>

	<div class="col-sm-4 col-md-4">
		<div class="thumbnail">
			<img src="<?= base_url($fila['imagen']);?>">
			<div class="caption">
				<h4><a href="<?= site_url('/tienda/muestraDetalles/'.$fila['id']); ?>"><?=$fila['nombre'];?></a></h4>
				<p><strong><?=$fila['descripcion']?></strong></p>
				<p>Precio: <strong><?=$fila['precio']?>€</strong></p>
			</div>
		</div>
	</div>

<?php endif; endforeach;?>
</div>