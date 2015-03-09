<?php 
if (isset($exito)) { ?>
	<div class="alert alert-success" role="alert"><?= $exito; ?></div>
<?php }?>

<div class="col-xs-8">
<h3>Detalles de pedido</h3>
<table class="table">

<?php foreach ($pedido as $valor) : 
foreach ($producto as $prod) : ?>

	<h5>Nº de pedido: <?php echo $valor['pedido_id']?></h5>
	<p>Comprado el <?php echo $valor['fecha']?></p>

<tr class="active">
	<th>Dirección de envío</th>
	<th style="text-align: center">Resumen del pedido</th>
</tr>
<tr>
	<td><?php echo $usuario['direccion']?><br>
	<?php echo $usuario['cp']?>, <?php echo $usuario['provincia']?></td>
	
	
	<td style="text-align: right">Precio unidad: <?php echo $prod['precio']?> € (IVA incluido)<br>
	Cantidad: <?php echo $carrito['cantidad']?><br>
	Gastos de envío: <?php echo '3,02 €' ?><br>
	Precio total <?php echo round($prod['precio']*$carrito['cantidad']+3,02)?> €
	</td>
</tr>

<tr class="active">
	<th colspan="2" style="text-align: center">Detalles producto</th>
</tr>
<tr>
	<td><img src="<?= base_url().$prod['imagen'];?>"></td>
	<td><?php echo $prod['nombre']?><br>
	<?php echo $prod['descripcion']?></td>
	
</tr>

<?php endforeach; endforeach;?>
</table>
