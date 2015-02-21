<?php
//Atributos del formulario
$atributos = array(
	'class' => 'form-horizontal'
);
echo form_open('usuario/login', $atributos);

//Error de usuario no válido
echo "<div class='alert-sm alert-danger'>";
	if (isset($error_message)) {
		echo $error_message;
	}
	
	if (isset($logout))
	{
		echo $logout;
	}
echo "</div><br>";
?>

<div class="form-group">
	<label for="usuario" class="col-sm-2 control-label">Usuario</label>
	<div class="col-sm-4">
		<input type="text" class="form-control" name="usuario" placeholder="Nombre de usuario" value="<?php echo set_value('usuario'); ?>">
		<?php echo form_error('usuario'); ?>
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
	<div class="col-sm-offset-2 col-sm-10">
		<div class="checkbox">
    		<label>
      			<input type="checkbox" name="recordar"> Recordarme
    		</label>
    	</div>
	</div>
</div>

<div class="form-group">
	<div class="col-sm-offset-2 col-sm-10">
		¿Aún no estás registrado? <a href="<?= site_url('usuario/registro')?>">Registrate aquí</a>
</div>
</div>
<div class="form-group">
	<div class="col-sm-offset-3">
		<button type="submit" class="btn btn-primary">Entrar</button>
	</div>
</div>
<?php echo form_close(); ?>