<?php
//Atributos del formulario
$atributos = array(
	'class' => 'form-horizontal'
);
echo form_open('usuario/login', $atributos);

if (isset($error_message)) { ?>
	<div class="alert alert-danger" role="alert"><?= $error_message; ?></div>
<?php }
if (isset($logout)) { ?>
	<div class="alert alert-warning" role="alert"><?= $logout; ?></div>
<?php }
$enviado = $this->session->flashdata('envio');
if ($enviado) { ?>
		<div class="alert alert-success" role="alert"><?= $enviado; ?></div>
<?php } ?>

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

<!-- <div class="form-group">
	<div class="col-sm-offset-2 col-sm-10">
		<div class="checkbox">
    		<label>
      			<input type="checkbox" name="recordar"> Recordarme
    		</label>
    	</div>
	</div>
</div> -->

<div class="form-group">
	<div class="col-sm-offset-2 col-sm-10">
		<p>He olvidado mi contraseña. <a href="<?= site_url('mail/recuperarPassw')?>">Recuperar</a></p>
	</div>
</div>

<div class="form-group">
	<div class="col-sm-offset-2 col-sm-10">
		<p>¿Aún no estás registrado? <a href="<?= site_url('usuario/registro')?>">Registrate aquí</a></p>
	</div>
</div>

<div class="form-group">
	<div class="col-sm-offset-3">
		<button type="submit" class="btn btn-primary">Entrar</button>
	</div>
</div>
<?php echo form_close(); ?>