<?php 
	foreach ($rs_articulos as $fila) :
?>
	<p>
	<a href="<?= site_url('/productos/muestraDetalles/'.$fila['id']); ?>"><?=$fila['nombre'];?></a>
	</p>
<?php endforeach;