<div class="row">
<div class="col-sm-12" style="text-align: left;">
	<h2><span class="label label-warning">Destacados</span></h2><br>
</div>
<?php 
	foreach ($productos as $rs_articulos) :
		foreach ($rs_articulos as $fila) :
	
	//Comprueba que el producto no está marcado como oculto.
	if($fila['oculto']==0) :
?>
	<div class="col-sm-6 col-md-4">
		<div class="thumbnail">
			<img src="<?= base_url($fila['imagen']);?>">
			<div class="caption">
				<h4><a href="<?= site_url('/tienda/muestraDetalles/'.$fila['id']); ?>"><?=$fila['nombre'];?></a></h4>
				<p><strong><?=$fila['descripcion']?></strong></p>
				<p>Precio: <strong><?=$fila['precio']?>€</strong></p>
			</div>
		</div>
	</div>

<?php endif; endforeach; endforeach;?>
</div>
<div class="col-sm-offset-5">
<div class="pagination">
	<?= $paginador?>
</div>
</div>

