<?php //echo validation_errors();
$atributos = array(
	'class' => 'form-horizontal'
	//'name' => 'reg_form'
);
echo form_open('usuario/modificarPerfil', $atributos);
?>


<fieldset>
<legend style="color: #58ACFA;">Modificar perfil</legend>	
	<div class="form-group">
		<label for="nombre" class="col-sm-2 control-label">Nombre</label>
		<div class="col-sm-4">
			<input type="text" class="form-control" name="nombre" placeholder="Nombre" value="<?php echo $nombre; ?>"/>
			<?php echo form_error('nombre'); ?>
		</div>
	</div>

	<div class="form-group">
		<label for="apellidos" class="col-sm-2 control-label">Apellidos</label>
		<div class="col-sm-4">
			<input type="text" class="form-control" name="apellidos" placeholder="Apellidos" value="<?php echo $apellidos; ?>" />
			<?php echo form_error('apellidos'); ?>
		</div>
	</div>
	
	<div class="form-group">
		<label for="dni" class="col-sm-2 control-label">DNI</label>
		<div class="col-sm-4">
			<input type="text" class="form-control" name="dni" placeholder="DNI" value="<?php echo $dni; ?>" />
			<?php echo form_error('dni'); ?>
		</div>
	</div>

	<div class="form-group">
		<label for="direccion" class="col-sm-2 control-label">Dirección</label>
		<div class="col-sm-4">
			
			<input type="text" class="form-control" name="direccion" placeholder="Dirección" value="<?php echo $direccion; ?>" />
			<?php echo form_error('direccion'); ?>
		</div>
	</div>
	
	<div class="form-group">
		<label for="cp" class="col-sm-2 control-label">Código Postal</label>
		<div class="col-sm-4">
			
			<input type="text" class="form-control" name="cp" placeholder="Código Postal" value="<?php echo $cp; ?>" />
			<?php echo form_error('cp'); ?>
		</div>
	</div>
	
	<div class="form-group">
		<label for="provincia" class="col-sm-2 control-label">Provincia</label>
		<div class="col-sm-4">
			<?php echo form_dropdown('selprovincias', $provincias, $provincia_id, 'class="form-control"' );?>
		</div>
	</div>

	<div class="form-group">
		<label for="usuario" class="col-sm-2 control-label">Nombre usuario</label>
		<div class="col-sm-4">
			<input type="text" class="form-control" name="usuario" placeholder="Nombre de usuario" value="<?php echo $usuario; ?>">
			<?php echo form_error('usuario'); ?>
		</div>
	</div>
	
	<div class="form-group">
		<label for="email" class="col-sm-2 control-label">Email</label>
		<div class="col-sm-4">
			<input type="email" class="form-control" name="email" placeholder="Email" value="<?php echo $email; ?>">
			<?php echo form_error('email'); ?>
		</div>
	</div>

</fieldset>

	<div class="form-group">
		<div class="col-sm-offset-2 col-sm-10">
			<button type="submit" class="btn btn-primary">Enviar</button>
		</div>
	</div>
<?php echo form_close(); ?>