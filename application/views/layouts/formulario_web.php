<?php

$link_inicio_web = "web/inicio/";

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<title> <?php echo $this->pagina_web; ?> </title>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="description" content="Course Project">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	
	<link rel="icon" type="image/png" href="<?php echo base_url($this->icono_pagina_web) ?>" />

	<!-- Bootstrap 3.3.7 -->
	<link rel="stylesheet" href="<?php echo base_url('assets/template/bootstrap/css/bootstrap.min.css');?>">
	<link rel="stylesheet" href="<?php echo base_url('assets/template/jquery-ui/jquery-ui.css');?>">

	<link rel="stylesheet" href="<?php echo base_url('assets/template/ionicons/css/ionicons.min.css');?>">
	<!-- Font Awesome  detalles de los botones dibujos-->
	<link rel="stylesheet" href="<?php echo base_url('assets/template/font-awesome/css/font-awesome.min.css');?>">
	<!-- Theme style -->
	<link rel="stylesheet" href="<?php echo base_url('assets/template/dist/css/AdminLTE.min.css');?>">
	<!-- AdminLTE Skins. Choose a skin from the css/skins
	parte izquierada menus del sistema -->
	<link rel="stylesheet" href="<?php echo base_url('assets/template/dist/css/skins/_all-skins.min.css');?>">

	<!--Carga de css-->
	<?php echo $this->layout->css; ?>
</head>


<body  class="hold-transition skin-blue-light layout-top-nav ">

	<!-- Site wrapper -->
	<div class="wrapper">
		<header class="main-header">
			<nav class="navbar navbar-static-top">
				<div class="container">

					<div class="navbar-header">
						<a href="<?php echo base_url($link_inicio_web);?>" class="navbar-brand">
							<?php echo ($this->nombre_empresa); ?>
						</a>
					</div>

					<!--div class="collapse navbar-collapse pull-left" id="navbar-collapse">
						<form class="navbar-form navbar-left" role="search">
							<div class="form-group">
								<input type="text" class="form-control" id="navbar-search-input" placeholder="Buscar">
							</div>
						</form>
					</div-->
				</div>
			</nav>
		</header>

		<!-- Full Width Column -->
		<div class="content-wrapper">
			<div class="container">
				<div class="row justify-content-center">
				<!-- Content Header (Page header) -->
				<section class="content-header">
					<h1> <?php echo $this->controller; ?>
						<small> <?php echo $this->metodo; ?></small>
					</h1>

					<ol class="breadcrumb">
						<li><a href="<?=base_url('web/inicio')?>"><i class="fa fa-home"></i> WEB INICIO </a></li>
					</ol>
				</section>

				<!-- Main content -->
				<section class="content">

					<!--Carga de view-->
					<?php echo $content_for_layout; ?>

				</section>
				<!-- /.content -->
				</div>
			</div>
			<!-- /.container -->
		</div>

		<footer class="main-footer">
			<div class="container">
				<div class="pull-right hidden-xs">
					<b>Version</b> <?php echo $this->version; ?>
				</div>
			<strong><?php echo $this->sistema; ?> &copy; 2020 <a href="<?php echo base_url($link_inicio_web); ?>">UNSM-T</a></strong>
			</div>
		</footer>

	</div>

	<script>
		var base_url= "<?php echo base_url();?>";
	</script>

	<!--Carga de js-->
	<?php echo $this->layout->js; ?>

	<!-- Bootstrap 3.3.7 -->
	<script src="<?php echo base_url();?>assets/template/bootstrap/js/bootstrap.min.js"></script>
	<script src="<?php echo base_url();?>assets/template/jquery-ui/jquery-ui.js"></script>

	<!-- AdminLTE App -->
	<script src="<?php echo base_url();?>assets/template/dist/js/adminlte.min.js"></script>
</body>

</html>


