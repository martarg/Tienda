<?php
$atributos = array(
	'class' => 'form-horizontal'
);
echo form_open('usuario/cambiarPass', $atributos);
?>

<div class="form-group">
	<label for="password" class="col-sm-2 control-label">Contraseña actual</label>
	<div class="col-sm-4">
		<input type="password" class="form-control" name="password" placeholder="Contraseña actual" />
		<?php echo form_error('password'); ?>
	</div>
</div>

<div class="form-group">
	<label for="newpassword" class="col-sm-2 control-label">Nueva contraseña</label>
	<div class="col-sm-4">
		<input type="password" class="form-control" name="newpassword" placeholder="Contraseña nueva" />
		<?php echo form_error('newpassword'); ?>
	</div>
</div>

<div class="form-group">
	<label for="newpassword" class="col-sm-2 control-label">Nueva contraseña</label>
	<div class="col-sm-4">
		<input type="password" class="form-control" name="newpassword" placeholder="Contraseña nueva" />
		<?php echo form_error('newpassword'); ?>
	</div>
</div>

<div class="form-group">
	<div class="col-sm-offset-2 col-sm-10">
		<button type="submit" class="btn btn-primary">Enviar</button>
	</div>
</div>
<?php form_close();?>