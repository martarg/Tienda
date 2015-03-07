<?php
//Atributos del formulario
$atributos = array(
		'class' => 'form-horizontal'
);
echo form_open('mail/recuperarPassw', $atributos);
?>

<div class="form-group">
	<label for="usuario">Escribe un email para recuperar tu contraseña</label><br>
	<div class="col-sm-5">
		<input type="text" class="form-control" name="email" placeholder="Email" value="<?php echo set_value('email'); ?>">
		<?php echo form_error('email'); ?>
	</div>
</div>

<div class="form-group">
	<button type="submit" class="btn btn-primary">Recuperar contraseña</button>
</div>
<?php echo form_close(); ?>