<div class="col-xs-8">
<h3>Detalles de pedido</h3>
<?php foreach ($pedido as $valor) :?>

<p>Comprado el <?php echo $valor['fecha']?>   |  Nº de pedido: <?php echo $valor['id']?></p>

<p></p>
<?php endforeach;?>

