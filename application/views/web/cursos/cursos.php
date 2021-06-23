<?php


?>
<!-- Home -->
  <div class="home">
	  <div class="home_background_container prlx_parent">
		  <div class="home_background prlx" style="background-image:url(<?= $fondo ?>)"></div>
	  </div>
	  <div class="home_content">
		  <h1><?=$Web_seccion?></h1>
	  </div>
  </div>

  <div class="popular page_section">

	  <div class="container">
		  <!-- Popular -->
		  <div class="row">
			<div class="col">
			  <div class="section_title text-center">
				<h1>Nuestros Cursos</h1>
			  </div>
			</div>
		  </div>

		  <div class="row course_boxes">

			  <?php foreach ($cursos_lista as $key => $curso) { 
			  	
			  		$link_curso = base_url($curso["enlace_web_informacion_curso"]);
			  		$img = validImgDefault($curso['imagen'], $upload_curso_path, $img_default);
			  	?>

				  <div class="col-lg-4 course_box">
					  <div class="card">
						  <img class="card-img-top" src="<?=$img?>" alt="Imagen de <?=$curso['nombre_web']?>">
						  <div class="card-body">
							  <div class="card-title text-center">
								  <a href="<?=$link_curso?>"><?= $curso['nombre_web'] ?></a>
							  </div>
							  <div class="card-text"><?= $curso['descripcion_web'] ?></div>
						  </div>

						  <div class="price_box d-flex flex-row align-items-center" onclick="window.location='<?=$link_curso?>';">
							  <div class="course_author_name ">
								  <a class="btn btn-link" href="<?=$link_curso?>"> Ver información </a>
							  </div>
							  <div class="course_price d-flex flex-column align-items-center justify-content-center">
								  <span> <i class="icon fa fa-plus"></i> </span>
							  </div>
						  </div>
					  </div>
				  </div>
			  <?php } //endforeach ?>

		  </div>

	  </div>
  </div>
