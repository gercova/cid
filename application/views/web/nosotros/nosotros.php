<!-- Home -->
<div class="home">
    <div class="home_background_container prlx_parent">
      <div class="home_background prlx" style="background-image:url(<?= $fondo ?>)"></div>
    </div>
    <div class="home_content">
      <h1> <?= $Web_seccion ?> </h1>
    </div>
</div>

<!-- Services -->
  <div class="services page_section">
	  <div class="container">
		<div class="row">
			<div class="col">
			  <div class="section_title text-center">
				<h1>Centro en Tecnologías de Información</h1>
			  </div>
			  <p style="text-align: justify;">
					<?php  echo nl2br($data['introduccion_organizacion']); ?>
			  </p>
			</div>
		</div>

      <div class="row">
        <div class="col">
			<div class="section_title text-center">
				<h1>Organigrama</h1>
			</div> <br>
          	<div align="center">
              	<img style="width: 70%" alt="Imagen organigrama" src="<?= $img_organigrama ?>" >
         	 </div>
        </div>
      </div>

      <br>

      <div class="row services_row">

			<div class="col-lg-6 service_item text-left d-flex flex-column align-items-start justify-content-start">
				<!--div class="icon_container d-flex flex-column justify-content-end">
					<img src="<?= base_url('assets/themes/course/images/blackboard.svg') ?>" alt="">
				</div-->
				<div class="section_title text-center">
					<h1>Visión</h1>
				</div>
				<p style="text-align: justify;"><?php  echo nl2br($data['vision_organizacion']); ?></p>
			</div>

		  <div class="col-lg-6 service_item text-left d-flex flex-column align-items-start justify-content-start">
			  <!--div class="icon_container d-flex flex-column justify-content-end">
				  <img src="<?= base_url('assets/themes/course/images/books.svg') ?>" alt="">
			  </div-->
			  <div class="section_title text-center">
				  <h1>Misión</h1>
			  </div>
			  <p style="text-align: justify;"><?php  echo nl2br($data['mision_organizacion']); ?></p>
		  </div>


      </div>
    </div>
  </div>
