<div class="col-xs-8">
<h3>Trámite del pedido</h3>
<?php
//si el carrito contiene productos los mostramos
if ($carrito = $this->cart->contents()) 
{?>
	<br>
    <table class="table table-striped" style="border-collapse: separate; width:100%;">
        <tr>
        	<th>Producto</th>
            <th>Precio</th>
            <th>Cantidad</th>
		</tr>
        <?php
        foreach ($carrito as $item) 
        {?>
			<tr>
				<td><?= ucfirst($item['name']) ?></td>
				<?php
				$nombres = array('nombre' => ucfirst($item['name']));
				$precios = array('precio' => $item['price']);
				?>
				<td><?= $item['price'] ?></td>
				<td><?= $item['qty'] ?></td>
			</tr><?php
		}?>
		<tr id="total">
			<td><strong>Total:</strong></td>
			<!--mostramos el total del carrito con $this->cart->total()-->
			<td colspan="2" style="text-align: right;"><strong><?= $this->cart->total()?> €</strong></td>
		</tr>
		
		<tr>
			<td>Coste del envío:</td>
			<td colspan="2">3,02 €</td>
		</tr>
		<tr>
			<td><strong>Total del pedido:</strong></td>
			<td colspan="2" style="color: red; text-align: right;"><strong><?= $this->cart->total()+3.02?> €</strong></td>
		</tr>
		<tr>
			<td colspan="3" style="text-align: center;"><a href="<?= site_url('/pedido/crearPedido')?>" class="btn btn-success" role="button">Realizar compra</a>
		</tr>
	</table>
<?php }
else
{
	echo "No hay ningún producto en el carrito.";
}?>
</div>