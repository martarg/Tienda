<table>
 <tr>
    <td>ID de factura:</td>
    <td><?= $id ?></td>
 </tr>
 <tr>
    <td>Fecha de emisión:</td>
    <td><?php echo date("d-m-Y"); ?></td>
 </tr>
 <tr>
    <td>Nombre de la tienda:</td>
    <td>Music-All</td>
 </tr>
 <tr>
    <td>Provincia de la tienda:</td>
    <td>Huelva</td>
 </tr>
 <tr>
    <td>NIF:</td>
    <td>11223344N</td>
 </tr>
</table>

<table border="1">
 <tr>
    <td>Nombre del cliente:</td>
    <td><?php $nombre ?></td>
 </tr>
 <tr>
    <td>Apellidos del cliente:</td>
    <td></td>
 </tr>
 <tr>
    <td>Dirección del cliente:</td>
    <td></td>
 </tr>
 <tr>
    <td>Provincia del cliente:</td>
    <td></td>
 </tr>
 <tr>
    <td>Código Postal</td>
    <td></td>
 </tr>
 <tr>
    <td>DNI</td>
    <td></td>
 </tr>
</table>

<h3>PRODUCTOS</h3>

<table border="1">
 <tr>
    <td>Impuestos:</td>
    <td><input type="text" name="iva" value="21" size="5"> %</td>
 </tr>
 <tr>
    <td>Gastos de envío</td>
    <td><input type="text" name="gastos_de_envio" value="5.95" size="5"> €</td>
 </tr>
</table>