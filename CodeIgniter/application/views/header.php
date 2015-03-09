<div class="page-header" >
	<h1 style="margin-left: 30px;">Tienda</h1>
</div>

<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <!--<div class="navbar-header">
      <a class="navbar-brand" href="#">Tienda</a>
    </div> -->

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li class=""><a href="<?=base_url()?>">Inicio</a></li>
      </ul>
      <ul class="nav navbar-nav">
        <li><a href="<?= site_url('carrito')?>">Ver carrito <span class="glyphicon glyphicon-shopping-cart" aria-hidden="true"></span></a></li>
      </ul>
      
      <?php if(isset($this->session->userdata['valido']))
      {
      ?>
		<ul class="nav navbar-nav navbar-right">
      		<li><a href="<?php echo site_url('usuario/logout')?>">Cerrar sesión</a></li>
      	</ul>
      	<ul class="nav navbar-nav navbar-right">
        	<li><a href="<?php echo site_url('usuario/perfil')?>">Hola, <?php echo $usuario;?></a></li>
      	</ul>
      
		<ul class="nav navbar-nav navbar-right">
        	<li><a href="<?= site_url('pedido/verPedidos')?>">Mis pedidos</a></li>
      	</ul>
      	
      	
      
      <?php 
      }
      else 
      {
      ?>
      <ul class="nav navbar-nav navbar-right">
        <li><a href="<?= site_url('usuario/login')?>">Iniciar sesión</a></li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li><a href="<?= site_url('usuario/registro')?>">Registrarse</a></li>
      </ul>
      
      <?php 
      }
      ?>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
