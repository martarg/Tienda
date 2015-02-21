<?php //echo validation_errors();
$atributos = array(
	'class' => 'form-horizontal',
	'name' => 'reg_form'
);
echo form_open('usuario/registro', $atributos);
?>


<fieldset>
<legend style="color: #58ACFA;">Datos personales</legend>	
	<div class="form-group">
		<label for="nombre" class="col-sm-2 control-label">Nombre</label>
		<div class="col-sm-4">
			<input type="text" class="form-control" name="nombre" placeholder="Nombre" value="<?php echo set_value('nombre'); ?>"/>
			<?php echo form_error('nombre'); ?>
		</div>
	</div>

	<div class="form-group">
		<label for="apellidos" class="col-sm-2 control-label">Apellidos</label>
		<div class="col-sm-4">
			<input type="text" class="form-control" name="apellidos" placeholder="Apellidos" value="<?php echo set_value('apellidos'); ?>" />
			<?php echo form_error('apellidos'); ?>
		</div>
	</div>
	
	<div class="form-group">
		<label for="dni" class="col-sm-2 control-label">DNI</label>
		<div class="col-sm-4">
			<input type="text" class="form-control" name="dni" placeholder="DNI" value="<?php echo set_value('dni'); ?>" />
			<?php echo form_error('dni'); ?>
		</div>
	</div>

	<div class="form-group">
		<label for="direccion" class="col-sm-2 control-label">Dirección</label>
		<div class="col-sm-4">
			
			<input type="text" class="form-control" name="direccion" placeholder="Dirección" value="<?php echo set_value('direccion'); ?>" />
			<?php echo form_error('direccion'); ?>
		</div>
	</div>
	
	<div class="form-group">
		<label for="cp" class="col-sm-2 control-label">Código Postal</label>
		<div class="col-sm-4">
			
			<input type="text" class="form-control" name="cp" placeholder="Código Postal" value="<?php echo set_value('cp'); ?>" />
			<?php echo form_error('cp'); ?>
		</div>
	</div>
	
	<div class="form-group">
		<label for="provincia" class="col-sm-2 control-label">Provincia</label>
		<div class="col-sm-4">
			<?=form_dropdown('selprovincias', $provincias, set_value('selprovincias'), 'class="form-control"' );?>
		</div>
	</div>
</fieldset>

<fieldset>
<legend style="color: #58ACFA;">Datos acceso usuario</legend>
	<div class="form-group">
		<label for="usuario" class="col-sm-2 control-label">Nombre usuario</label>
		<div class="col-sm-4">
			<input type="text" class="form-control" name="usuario" placeholder="Nombre de usuario" value="<?php echo set_value('usuario'); ?>">
			<?php echo form_error('usuario'); ?>
		</div>
	</div>
	
	<div class="form-group">
		<label for="email" class="col-sm-2 control-label">Email</label>
		<div class="col-sm-4">
			<input type="email" class="form-control" name="email" placeholder="Email" value="<?php echo set_value('email'); ?>">
			<?php echo form_error('email'); ?>
		</div>
	</div>
	
	<div class="form-group">
		<label for="password" class="col-sm-2 control-label">Contraseña</label>
		<div class="col-sm-4">
			<input type="password" class="form-control" name="password" placeholder="Contraseña">
			<?php echo form_error('password'); ?>
		</div>
	</div>
	
	<div class="form-group">
		<label for="pConfirm" class="col-sm-2 control-label">Confirma contraseña</label>
		<div class="col-sm-4">
			<input type="password" class="form-control" name="pConfirm" placeholder="Confirma contraseña">
			<?php echo form_error('pConfirm'); ?>
		</div>
	</div>
</fieldset>

	<div class="form-group">
		<div class="col-sm-offset-2 col-sm-10">
			<button type="submit" class="btn btn-primary">Enviar</button>
		</div>
	</div>
<?php echo form_close(); ?>