<div class="col-sm-offset-3">
<div class="col-xs-10">
<h3>Su carrito de la compra</h3>
<?php
//si el carrito contiene productos los mostramos
if ($carrito = $this->cart->contents()) 
{?>
	<br>
    <table class="table table-striped" style="border-collapse: separate; width:100%;">
        <tr>
        	<th>Nombre</th>
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
				<!--creamos el enlace para eliminar el producto pulsado pasando el rowid del producto-->
				<td id="eliminar"><?= anchor('/carrito/eliminaProducto/'.$item['rowid'], 'Eliminar') ?></td>
			</tr><?php
		}?>
		<tr id="total">
			<td><strong>Total:</strong></td>
			<!--mostramos el total del carrito con $this->cart->total()-->
			<td colspan="2"><?= $this->cart->total()?> €</td>
			<!--creamos un enlace para eliminar el carrito-->
			<td id="eliminarCarrito"><?= anchor('/carrito/eliminaCarrito', 'Vaciar carrito')?></td>
		</tr>
	</table>
<?php }
else
{
	echo "No hay ningún producto en el carrito.";
}?>
</div>
</div>