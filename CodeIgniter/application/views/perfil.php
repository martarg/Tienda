<table class="table" style="width: 350px;">
	<tr class="active">
		<th colspan="2" style="text-align: center;">INFORMACIÓN DE SU PERFIL</th>
	</tr>
	<tr>
		<td>Usuario</td>
		<td><?php echo $usuario ?></td>
	</tr>
	<tr>
		<td>Email</td>
		<td> <?php echo $email ?></td>
	</tr>
	<tr>
		<td>Nombre</td>
		<td><?php echo $nombre ?></td>
	</tr>
	<tr>
		<td>Apellidos</td>
		<td><?php echo $apellidos ?></td>
	</tr>
	<tr>
		<td>DNI</td>
		<td> <?php echo $dni ?></td>
	</tr>
	<tr>
		<td>Dirección</td>
		<td> <?php echo $direccion ?></td>
	</tr>
	<tr>
		<td>Código Postal</td>
		<td> <?php echo $cp ?></td>
	</tr>
	<tr>
		<td>Provincia</td>
		<td> <?php echo $provincia ?></td>
	</tr>
</table>

<a role="button" class="btn btn-primary" href="modificarPerfil">
	<span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> Modificar perfil
</a>
	
<a role="button" class="btn btn-danger" href="borrarUsuario">
	<span class="glyphicon glyphicon-remove" aria-hidden="true"></span> Dar de baja
</a>