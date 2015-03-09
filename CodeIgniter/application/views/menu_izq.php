<div class="sidebar-module">
<h5><strong>GÉNEROS</strong></h5>
<ul class="list-group">
	<?php
	foreach ($rs_categorias as $valor) :
	if($valor['oculto']==0 || $valor['oculto']==NULL) :
	?>
	<li class="list-group-item">
		<span class="badge"></span> <!-- HACER CONTADOR DE PRODUCTOS -->
		<a href="<?= site_url('/tienda/muestraCategoria/'.$valor['id'])?>"><?=$valor['nombre'];?></a>
	</li>
	<?php endif; endforeach;?>
</ul>
</div>