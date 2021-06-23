<!-- Home -->
	<div class="home">
		<div class="home_background_container prlx_parent">
		  <div class="home_background prlx" style="background-image:url(<?= $fondo ?>)"></div>
		</div>
		<div class="home_content">
		  <h1><?=$Web_seccion?></h1>
		</div>
	</div>

  <!-- Contact -->

	<div class="contact">
		<div class="container">
		  <div class="row">
			  <div class="col-lg-8">

			  <!-- Contact Form -->
			  <div class="contact_form">
				  <div class="section_title text-center">
					  <h1>Contáctanos</h1>
				  </div>

				  <div class="contact_form_container">
					  <form action="post">
						<input id="contact_form_name" class="input_field contact_form_name" type="text" placeholder="Nombre" required="required" data-error="Nombre es requerido.">
						<input id="contact_form_email" class="input_field contact_form_email" type="email" placeholder="E-mail" required="required" data-error="Email Valido es requerido.">
						<textarea id="contact_form_message" class="text_field contact_form_message" name="message" placeholder="Mensaje" required="required" data-error="Porfavor, escribe su mensaje."></textarea>
						<button id="contact_send_btn" type="button" class="contact_send_btn trans_200" value="Submit">Enviar mensaje</button>
					  </form>
					</div>
			  </div>

			  </div>

			  <div class="col-lg-4">
				  <div class="about">
					  <div class="section_title text-center">
						  <h1>Personal</h1>
					  </div>
					  <p class="about_text">
							Nuestro equipo está totalmente dispuesto a ayudarte, no dudes en contactarnos con nosotros.
					  </p>
					  <div class="contact_info">
						  <ul>
							  <li class="contact_info_item">
								<strong>Coordinador:</strong>
								Lic. Edwin Augusto Hernández Torres
							  </li>
							  <li class="contact_info_item">
								  <strong>Administrador:</strong>
								  Ing. Segundo Roger Ramírez Shupingahua
							  </li>
								<li class="contact_info_item">
									<strong>Secretaria:</strong>
									Yajaira Salazar Novoa
								</li>
								<li class="contact_info_item">
									<strong>Apoyo:</strong>
									Pricilia Patricia Ríos Alegría
								</li>
						  </ul>
					  </div>
				  </div>
			  </div>
		  </div>
		</div>
	</div>

<div class="super_container">
	<div class="elements" >
		<div class="icon_boxes" >
	<div class="container">

		<div class="row "> <!--icon_boxes_container-->

			<div class="col-lg-6 icon_box text-left d-flex flex-column align-items-start justify-content-start">
				<div class="icon_container d-flex flex-column justify-content-end">
					<!--img src="<?= base_url('public/themes/course/images/earth-globe.svg') ?>" alt=""-->
					<i class="fa fa-info-circle  fa-3x" style="color: #FFFFFF"></i>
				</div>
				<h3>INFORMES:</h3>

				<p> Ubícanos en <b> <?php echo $this->direccion; ?> </b>
					<span><?php echo $this->direccion_referencia; ?></span>
				</p>
				<p class="">
					Teléfonos: <b><?php echo $this->telefonos; ?></b>
				</p>
				<p class="">
					Correos: <b><?php echo $this->correos; ?></b>
				</p>

			</div>

			<div class="col-lg-6 icon_box text-left d-flex flex-column align-items-start justify-content-start">
				<div class="icon_container d-flex flex-column justify-content-end">
					<!--img src="<?= base_url('public/themes/course/images/exam.svg') ?>" alt=""-->
					<i class="fa fa-graduation-cap fa-3x" style="color: #FFFFFF"></i>
				</div>
				<h3  class=""> Pagos de cursos :</h3>
				<p class="">
					<?php echo nl2br($this->informacion_pago); ?>
				</p>
			</div>

		</div>

	</div>
</div>
	</div>
</div>

</div>


<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&key=AIzaSyCIwF204lFZg1y4kPSIhKaHEXMLYxxuMhA"></script>
