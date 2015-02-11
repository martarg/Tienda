<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<link href="<?=base_url('assets/css/bootstrap.min.css')?>" rel="stylesheet">
	<title>TiendaOnline</title>
</head>
<body>
<div class="container">
	<header>
		<?= $encabezado?>
	</header>
	
	<div class="col-sm-2 col-md-3">
		<aside><?= $menu_izq?></aside>
	</div>
	
	<div class="col-sm-9">
		<?= $cuerpo?>
	</div>
</div>
</body>
</html>