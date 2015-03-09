<h3>Mis pedidos</h3>
<table class="table table-hover">
<tr class="active">
	<th>Nº Pedido</th>
	<th>Fecha</th>
	<th>Estado</th>
	</tr>
	<?php foreach ($pedidos as $rsPedidos) : 
	foreach ($rsPedidos as $valor) : ?>
	<tr>
		<td><?=$valor['id']?></td>
		<td><?=$valor['fecha']?></td>
		<td><?=$valor['estado']?></td>
	</tr>
	<?php endforeach;
	endforeach;?>
</table>