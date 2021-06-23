<?php

$logo_cabecera =  base_url($this->path_web.'img/iconos/cti_logo_150_98.webp');
$logo_pie =  base_url($this->path_web.'img/iconos/cti_logo_150_98.webp');
$logo_pie_2 =  base_url($this->path_web.'img/iconos/unsm_logo_157_54.webp');
		

$modulos_web  = array(  
	array('Inicio', base_url('web/inicio') , array()),
	array('Nosotros', base_url('web/nosotros') , array()),
	array('Cursos', base_url('web/cursos') , array()),
	array('Contacto', base_url('web/contacto') , array())
	//array('Talleres', 'talleres.php'),	
	//array('Aliados', 'Aliados.php'),
);

$redes_sociales  = array(
	'facebook' => array('icono' => 'fab fa-facebook-f', 'link' => 'https://www.facebook.com/cti.unsm' ),
	'pinterest' => array('icono' => 'fab fa-pinterest', 'link' => 'https://www.pinterest.es/ctiunsm/' ),
	'instagram' => array('icono' => 'fab fa-instagram', 'link' => 'https://www.instagram.com/cti_unsm/?hl=es-la' ),
	'twitter' => array('icono' => 'fab fa-twitter', 'link' => 'https://twitter.com/CtiUnsm' )
);

$Web_seccion = (trim($this->controller) != '')? $this->controller: 'Bienvenido';
$path_web_theme = base_url('assets/web/themes/course/');

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

	<!--link rel="stylesheet" type="text/css" href="<?php echo $path_web_theme.'styles/bootstrap4/bootstrap.min.css' ?>"-->

	<link rel="preload" href="<?php echo $path_web_theme.'styles/bootstrap4/bootstrap.min.css' ?>" as="style" onload="this.onload=null;this.rel='stylesheet'">
    <noscript>
        <link rel="stylesheet" href="<?php echo $path_web_theme.'styles/bootstrap4/bootstrap.min.css' ?>">
    </noscript>


	<link rel="preload" href="<?php echo $path_web_theme.'plugins/fontawesome-free-5.0.1/css/fontawesome-all.css' ?>" as="style" onload="this.onload=null;this.rel='stylesheet'">
    <noscript>
        <link rel="stylesheet" href="<?php echo $path_web_theme.'plugins/fontawesome-free-5.0.1/css/fontawesome-all.css' ?>">
    </noscript>


	<!--link rel="stylesheet" type="text/css" href="<?php echo $path_web_theme.'css/logo_carousel.css' ?>">

	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.css"-->

	<?php echo $this->layout->css; ?>
</head>
<body>

	<div class="super_container">

		<!-- Header -->

		<header class="header d-flex flex-row">
			<div class="header_content d-flex flex-row align-items-center">
				<!-- Logo -->
				<div class="logo_container">
					<div class="logo">
						<img src="<?=$logo_cabecera?>" alt="logo de cabecera" style="width: 5rem; cursor: pointer;" onclick="window.location='<?=base_url("web/inicio")?>';">
						<!--span>CTI</span-->
					</div>
				</div>

				<!-- Main Navigation -->
				<nav class="main_nav_container">
					<div class="main_nav">
						<ul class="main_nav_list">

							<?php foreach ($modulos_web as $key => $val ){ ?>
								<li class='main_nav_item'>
									<a href='<?= $val[1] ?>'><?= $val[0] ?></a>

									<?php if( count($val[2]) > 0 ) { ?>
										<ul class="main_nav_sub_item">

											<?php foreach ($val[2] as $skey => $sval) { ?>
												<li><a href="#"><?= $sval ?></a></li>
											<?php }; ?>

										</ul>
									<?php }; ?>									
								</li>
							<?php }; ?>

						</ul>
					</div>
				</nav>
			</div>
			<div class="header_side d-flex flex-row justify-content-center align-items-center">
				<img src="<?=$path_web_theme.'images/phone-call.svg'?>" alt="Cel.">
				<span><?= $this->telefono ?></span>
			</div>

			<!-- Hamburger -->
			<div class="hamburger_container">
				<i class="fas fa-bars trans_200"></i>
			</div>

		</header>

		<!-- Menu -->
		<div class="menu_container menu_mm">

			<!-- Menu Close Button -->
			<div class="menu_close_container">
				<div class="menu_close"></div>
			</div>

			<!-- Menu Items -->
			<div class="menu_inner menu_mm">
				<div class="menu menu_mm">
					<ul class="menu_list menu_mm">
						<? foreach ($modulos_web as $key => $val) { ?>
							<li class='menu_item menu_mm'><a href='<?= $val[1] ?>'><?= $val[0] ?></a></li>
						<? }; ?>
					</ul>

					<!-- Menu Social -->
					<div class="menu_social_container menu_mm">
						<ul class="menu_social menu_mm">
							<li class="menu_social_item menu_mm"><a href="#"><i class="fab fa-pinterest"></i></a></li>
							<li class="menu_social_item menu_mm"><a href="#"><i class="fab fa-linkedin-in"></i></a></li>
							<li class="menu_social_item menu_mm"><a href="#"><i class="fab fa-instagram"></i></a></li>
							<li class="menu_social_item menu_mm"><a href="#"><i class="fab fa-facebook-f"></i></a></li>
							<li class="menu_social_item menu_mm"><a href="#"><i class="fab fa-twitter"></i></a></li>
						</ul>
					</div>

				</div>

			</div>

		</div>


	</div>

	<!-- Cargar vista-->
	<?php echo $content_for_layout; ?>

	<footer class="footer">
		<div class="container">

			<!-- Newsletter -->
			<div class="newsletter">
				<div class="row">
					<div class="col">
						<div class="section_title text-center">
							<h1>Centro en Tecnologías de Información </h1>
						</div>
					</div>
				</div>

				<div class="row">
					<!--div class="col text-center">
						<div class="newsletter_form_container mx-auto">
							<form >
								<div class="newsletter_form d-flex flex-md-row flex-column flex-xs-column align-items-center justify-content-center">
									<input id="Busquedad" class="newsletter_email"  placeholder="Escribe lo que buscas ">
									<button id="newsletter_submit" class="newsletter_submit_btn trans_300" onclick="select_taller()" >Buscar</button>
								</div>
							</form>
						</div>
					</div-->

					
					
					<!--div class="brands">
					    <div class="container">
					        <div class="row">
					            <div class="col">
					                <div class="brands_slider_container">
					                    <div class="owl-carousel owl-theme brands_slider">
					                        <div class="owl-item">
					                            <div class="brands_item d-flex flex-column justify-content-center"><img src="https://res.cloudinary.com/dxfq3iotg/image/upload/v1561819026/brands_1.jpg" alt=""></div>
					                        </div>
					                        <div class="owl-item">
					                            <div class="brands_item d-flex flex-column justify-content-center"><img src="https://res.cloudinary.com/dxfq3iotg/image/upload/v1561819026/brands_2.jpg" alt=""></div>
					                        </div>
					                        <div class="owl-item">
					                            <div class="brands_item d-flex flex-column justify-content-center"><img src="https://res.cloudinary.com/dxfq3iotg/image/upload/v1561819026/brands_4.jpg" alt=""></div>
					                        </div>
					                        <div class="owl-item">
					                            <div class="brands_item d-flex flex-column justify-content-center"><img src="https://res.cloudinary.com/dxfq3iotg/image/upload/v1561819026/brands_5.jpg" alt=""></div>
					                        </div>
					                        <div class="owl-item">
					                            <div class="brands_item d-flex flex-column justify-content-center"><img src="https://res.cloudinary.com/dxfq3iotg/image/upload/v1561819026/brands_3.jpg" alt=""></div>
					                        </div>
					                        <div class="owl-item">
					                            <div class="brands_item d-flex flex-column justify-content-center"><img src="https://res.cloudinary.com/dxfq3iotg/image/upload/v1561819026/brands_6.jpg" alt=""></div>
					                        </div>
					                        <div class="owl-item">
					                            <div class="brands_item d-flex flex-column justify-content-center"><img src="https://res.cloudinary.com/dxfq3iotg/image/upload/v1561819026/brands_7.jpg" alt=""></div>
					                        </div>
					                        <div class="owl-item">
					                            <div class="brands_item d-flex flex-column justify-content-center"><img src="https://res.cloudinary.com/dxfq3iotg/image/upload/v1561819026/brands_8.jpg" alt=""></div>
					                        </div>
					                    </div> 
					                    <div class="brands_nav brands_prev"><i class="fas fa-chevron-left"></i></div>
					                    <div class="brands_nav brands_next"><i class="fas fa-chevron-right"></i></div>
					                </div>
					            </div>
					        </div>
					    </div>
					</div-->
				</div>

			</div>

			<!-- Footer Content -->
			<div class="footer_content">
				<div class="row">

					<!-- Footer Column - About -->
					<div class="col-lg-4 footer_col">

						<!-- Logo -->
						<div class="logo_container">
							<div class="logo">
								<img src="<?= $logo_pie ?>" alt="Logo pie de pagina">
							</div>
						</div>
						<div class="logo_container" style="margin-left: 1rem ">
							<div class="logo">
								<img src="<?= $logo_pie_2 ?>" alt="Logo pie de pagina">
							</div>
						</div>

						<p class="footer_about_text" style="text-align: justify;">Centro en Tecnologías de Información,
							somos tu llave para triunfar.
							<br>
							No te quedes atrás y sé el mejor.
						</p>

					</div>

					<!-- Footer Column - Menu -->

					<div class="col-lg-2 footer_col">
						<div class="footer_column_title">Menu</div>
						<div class="footer_column_content">
							<ul>

								<? foreach ($modulos_web as $key => $val) { ?>
									<li class='footer_list_item'><a href='<?= $val[1] ?>'><?= $val[0] ?></a></li>
								<? }; ?>

							</ul>
						</div>
					</div>

					<!-- Footer Column - Usefull Links -->

					<div class="col-lg-3 footer_col">
						<div class="footer_column_title">Enlaces</div>
						<div class="footer_column_content">
							<ul>
								<li class="footer_list_item"><a href="https://unsm.edu.pe">Página web de UNSM</a></li>
								<li class="footer_list_item"><a href="http://cpu.unsm.edu.pe/">Página web de CPU - UNSM</a></li>
								<li class="footer_list_item"><a href="https://unsm.edu.pe/centros-de-produccion/idiomas/">Centro de Idiomas</a></li>
								<li class="footer_list_item"><a href="https://unsm.edu.pe/investigacion/">Investigación y desarrollo</a></li>
								<!-- <li class="footer_list_item"><a href="#">Tuitions</a></li> -->
							</ul>
						</div>
					</div>

					<!-- Footer Column - Contact -->

					<div class="col-lg-3 footer_col">
						<div class="footer_column_title">Informes</div>
						<div class="footer_column_content">
							<ul>

								<li class="footer_contact_item">
									<div class="footer_contact_icon">
										<i class="fa fa-map fa-2x"></i>
									</div>
									<?= $this->direccion ?>
								</li>

								<li class="footer_contact_item">
									<div class="footer_contact_icon">
										<i class="fa fa-mobile fa-2x"></i>
									</div>
									<?= $this->telefonos ?>
								</li>


								<li class="footer_contact_item">
									<div class="footer_contact_icon">
										<i class="fa fa-envelope fa-2x"></i>
									</div>
									<?= $this->correos ?>
								</li>

							</ul>
						</div>
					</div>

				</div>
			</div>

			<!-- Footer Copyright -->
			<div class="footer_bar d-flex flex-column flex-sm-row align-items-center">
				<div class="footer_copyright">
					<span><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
				Copyright &copy; <?= Date("Y")?> All rights reserved | This template is made with <i class="fa fa-heart" aria-hidden="true"></i> by <?php echo $this->sistema ?> - FISI, UNSM-T <!-- and  <a href="https://colorlib.com" target="_blank">Colorlib --></a>

						<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. --></span>
				</div>
				<div class="footer_social ml-sm-auto">
					<ul class="menu_social">
						<? foreach ($redes_sociales as $key => $val) { ?>
							<li class="menu_social_item"><a href="<?= $val['link'] ?>"><i class='<?= $val['icono'] ?>'></i></a></li>
						<? }; ?>
					</ul>
				</div>
			</div>

		</div>
	</footer>
	</div>

	<script src="<?php echo $path_web_theme.'js/jquery-3.2.1.min.js'?>"></script>
	<script src="<?php echo $path_web_theme.'styles/bootstrap4/popper.js'?>"></script>
	<script src="<?php echo $path_web_theme.'styles/bootstrap4/bootstrap.min.js'?>"></script>
	<script src="<?php echo $path_web_theme.'plugins/greensock/TweenMax.min.js'?>"></script>
	<script src="<?php echo $path_web_theme.'plugins/greensock/TimelineMax.min.js'?>"></script>
	<script src="<?php echo $path_web_theme.'plugins/scrollmagic/ScrollMagic.min.js'?>"></script>
	<script src="<?php echo $path_web_theme.'plugins/greensock/animation.gsap.min.js'?>"></script>
	<script src="<?php echo $path_web_theme.'plugins/greensock/ScrollToPlugin.min.js'?>"></script>

	<script src="<?php echo $path_web_theme.'plugins/OwlCarousel2-2.2.1/owl.carousel.js'?> "></script>
	<script src="<?php echo $path_web_theme.'plugins/scrollTo/jquery.scrollTo.min.js'?>"></script>
	<script src="<?php echo $path_web_theme.'plugins/easing/easing.js'?>"></script>
	<script src="<?php echo $path_web_theme.'js/custom.js'?>"></script>

	<!--script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.2.1/owl.carousel.js"></script>
	<script src="<?php echo $path_web_theme.'js/logo_carousel.js'?>"></script-->

	<?php echo $this->layout->js; ?>

</body>
</html>
