<?php

?>

<div class="home">

	<!-- Hero Slider -->
	<div class="hero_slider_container">
		<div class="hero_slider owl-carousel">

			<? foreach ($sliders_web as $key => $value) : ?>
				<!-- Hero Slide -->
				<div class="hero_slide">
					<div class="hero_slide_background" style="background-image:url(<?=$value['img']?>)"></div>
					<div class="hero_slide_container d-flex flex-column align-items-center justify-content-center">
						<div class="hero_slide_content text-center">
							<h2 data-animation-in="fadeInUp" data-animation-out="animate-out fadeOut"> <?=$value['texto']?> </h2>
						</div>
					</div>
				</div>
			<? endforeach; ?>

		</div>

		<div class="hero_slider_left hero_slider_nav trans_200"><span class="trans_200"><i class="fa fa-chevron-left fa-2x"></i></span></div>
		<div class="hero_slider_right hero_slider_nav trans_200"><span class="trans_200"><i class="fa fa-chevron-right fa-2x"></i></span></div>
	</div>

</div>

<div class="hero_boxes">
	<div class="hero_boxes_inner">
		<div class="container">
			<div class="row">

				<? foreach ($sliders_link_web as $key => $value) { ?>
					<div class="col-lg-4 hero_box_col" onclick="window.location='<?=$value['url']?>';">
						<div class="hero_box d-flex flex-row align-items-center justify-content-start">
							<img src="<?=base_url($value['img'])?>" class="svg" alt="">
							<div class="hero_box_content">
								<h2 class="hero_box_title"><?=$value['texto']?></h2>
								<a href="<?=$value['url']?>" class="hero_box_link">ver más</a>
							</div>
						</div>
					</div>
				<? } ?>

			</div>
		</div>
	</div>
</div>

<div class="popular page_section">
	<div class="container">
		<div class="row">
			<div class="col">
				<div class="section_title text-center">
					<h1>Nuestros Servicios </h1>
				</div>
			</div>
		</div>

		<div class="row course_boxes">

			<!-- Popular Course Item -->
			<? foreach ($cti_servicios_web as $key => $val) : ?>

				<div class="col-lg-4 course_box">
					<div class="card">
						<?php $path_img = validImgDefault($val['imagen'], $upload_servicio_path, $img_default); ?>

						<img class="card-img-top" src="<?= $path_img ?>" style="max-height: 185px;" alt="Servicios CTI">

						<div class="card-body text-center" style="height: 150px;">
							<div class="card-title"><a href="<?=  base_url($val['enlace'])?>"><?= $val['titulo']?></a></div>
							<div class="card-text"> <?= $val['text']?></div>
						</div>

						<div class="price_box d-flex flex-row align-items-center" onclick="window.location= '<?= base_url($val["enlace"])?>';">
							<div class="course_author_name ">
								<a class="btn btn-link" href="<?= base_url($val['enlace'])?>"> Ver información </a>
							</div>
							<div class="course_price d-flex flex-column align-items-center justify-content-center">
								<span> <i class="icon fa fa-plus"></i> </span>
							</div>
						</div>


					</div>
				</div>

			<? endforeach; ?>

		</div>
	</div>
</div>

<!-- Register -->
<div class="register">

	<div class="container-fluid">

		<div class="row row-eq-height">
			<div class="col-lg-6 nopadding">

				<!-- Register -->
				<div class="register_section d-flex flex-column align-items-center justify-content-center">
					<div class="register_content text-center">
						<h1 class="register_title" style="margin-bottom: 0px;font-style: italic;font-family: 'Roboto'; 'sans-serif';" >Capacítate en el <br>  
							<span> CTI </span> </h1>							
						<h2 class="register_title" ><span> Centro en Tecnología de Información </span></h2>
						<h3 class="register_title" ><span> Universidad Nacional de San Martín - Perú</span></h3>

						</h1>
						<p class="register_text" style="text-align: justify;">
							El Centro en Tecnología de Información de la Universidad Nacional de San Martin, está facultado en el desarrollo de competencias informáticas para profesionales  a demanda del mercado laboral.
						</p>
						<p class="register_text" style="text-align: justify;">
							Contamos con los cursos mas avanzados y solicitados del mercado, dictados por nuestro staff de docentes altamente calificados y profesionales.
						</p>
						<div class="button button_1 register_button mx-auto trans_200">
							<a href="<?= base_url('web/inscripcion')?>">Inscribirse</a></div>
					</div>
				</div>

			</div>

			<div class="col-lg-6 nopadding">

				<!-- Search -->

				<div class="search_section d-flex flex-column align-items-center justify-content-center">
					<div class="search_background" style="background-image:url(<?=$fondo_informe?>);"></div>
					<div class="search_content text-center">


						<div class="row services_row">
							<div class="col-lg-12 service_item text-left d-flex flex-column align-items-start justify-content-start">
								<div class="icon_container d-flex flex-column justify-content-end">
									<!--img src="images/earth-globe.svg" alt=""-->
									<i class="fa fa-info-circle  fa-3x" style="color: #0089ff"></i>
								</div>
								<h1 class="services_title">Informes :</h1>
								<p class="services_text"> Ubícanos en <?php echo $this->direccion; ?>
									<span><?php echo $this->direccion_referencia; ?></span>
								</p>
								<p class="services_text">
									Teléfonos: <?php echo $this->telefonos; ?>
								</p>
								<p class="services_text">
									Correos: <?php echo $this->correos; ?>
								</p>

							</div>


							<div class="col-lg-12 service_item text-left d-flex flex-column align-items-start justify-content-start">
								<div class="icon_container d-flex flex-column justify-content-end">
									<i class="fa fa-graduation-cap fa-3x" style="color: #0089ff"></i>
								</div>
								<h1  class="services_title"> Pagos de cursos :</h1>
								<p class="services_text">
									<?php echo nl2br($this->informacion_pago); ?>
								</p>
							</div>
						</div>


					</div>
				</div>

			</div>
		</div>
	</div>
</div>

<!-- Events -->
<div class="events page_section" id="proximos-eventos">
	<div class="container">

		<div class="row">
			<div class="col">
				<div class="section_title text-center">
					<h1>Próximos Eventos</h1>
				</div>
			</div>
		</div>

		<div class="event_items">

			<!-- Event Item -->
			<? foreach ($events_web as $key => $value) : ?>
			<div class="row event_item">
				<div class="col">
					<div class="row d-flex flex-row align-items-end">

						<div class="col-lg-2 order-lg-1 order-2">
							<div class="event_date d-flex flex-column align-items-center justify-content-center">
								<div class="event_day"> <?= strftime("%d", strtotime($value['fecha_evento'])) ?></div>
								<div class="event_month"><?= fechaES(strftime('%B',strtotime($value['fecha_evento']))) ?></div>
							</div>
						</div>

						<div class="col-lg-6 order-lg-2 order-3">
							<div class="event_content">
								<div class="event_name"><a class="trans_200" href="#"><?= $value['titulo_evento']?></a></div>
								<div class="event_location"><?= $value['subtitulo_evento']?></div>
								<p><?= $value['descripcion_evento']?></p>
							</div>
						</div>

						<div class="col-lg-4 order-lg-3 order-1">
							<div class="event_image">
								<?php $img = validImgDefault($value['imagen_evento'],$upload_evento_path, $img_default); ?>
								<img src="<?= $img ?>" alt="<?= $value['titulo_evento']?>">
							</div>
						</div>

					</div>
				</div>
			</div>
			<? endforeach; ?>

		</div>

	</div>
</div>




