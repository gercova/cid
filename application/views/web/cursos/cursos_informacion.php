<style type="text/css">

  .section_title .contenido_curso::before {
    display: block;
    position: absolute;
    top: 0;
    left: 15%;
    -webkit-transform: translateX(-50%);
    -moz-transform: translateX(-50%);
    -ms-transform: translateX(-50%);
    -o-transform: translateX(-50%);
    transform: translateX(-50%);
    width: 30%;
    height: 4px;
    content: '';
    background: #0089ff;
  }

  .section_title_contenido_curso{
    margin-bottom: 1rem
  }

  .title_contenido_curso{
    font-weight: 800 !important;  
    font-family: unset !important;
  }
  
</style>

<div class="home">
  <div class="home_background_container prlx_parent">
    <div class="home_background prlx" style="background-image:url(<?= $fondo ?>)"></div>
  </div>
  <div class="home_content">
    <h1><?=$Web_seccion?> </h1>

  </div>
</div>

<div class="services page_section">
  <div class="container">
    <div class="row">
      <div class="col-md-8 col-lg-8" >
        <div class="col-md-12">
          <div class="section_title section_title_contenido_curso text-left" >
            <h1 class="title_contenido_curso contenido_curso">DESCRIPCIÓN:</h1>
          </div>

          <?php foreach ($cursos_informacion as $key => $value) { ?>
            <p style="text-align: justify;">
            <?= $value['curso_contenido'] ?> 
            </p>
            <div style="padding-left: 2rem">
              <ul class="list-unstyled" style=" list-style: unset">
                <?php 
                foreach ($cursos_informacion_det as $key2 => $value2) :
                  if($value2['curso_contenido_id']==$value['curso_contenido_id']): ?>
                    <li style="color:#636363" ><?= $value2['descripcion'] ?></li> 
                <?php  endif;
                endforeach; ?>
              </ul>
            </div>
          <?php } //endforeach ?>
        </div>

        <div class="col-md-12" style="margin-top: 5rem; margin-bottom: 2.5rem;">
          <div class="section_title section_title_contenido_curso text-left">
            <h1 class="title_contenido_curso contenido_curso">MÓDULOS:</h1>
          </div>

          
          <?php foreach ($cursos_modulo as $key => $value) { ?>
            <br>
            <h3 style="color: black;font-weight: bold;">
            <?= $value['descripcion'] ?> 
            </h3>
            <div style="padding-left: 2rem">
              <ul class="list-unstyled" >
                <?php 
                foreach ($cursos_modulo_det as $key2 => $value2) :
                  if($value2['curso_modulo_id']==$value['curso_modulo_id']): ?>
                    <li style="color:#636363;font-size: 1.2rem"> 
                      <i class="fa fa-check"></i> <?= $value2['descripcion'] ?>
                    </li> 
                <?php  endif;
                endforeach; ?>
              </ul>
            </div>
          <?php } //endforeach ?>
        </div>

      </div>

      <div class="col-md-4 col-lg-4" style="background: #f0f0f0" >
        <?php foreach ($cursos_icono as $key => $value) : ?>
        <div class="col-md-12">
          <div class="section_title  text-left" >
            <h1 class=""></h1>
          </div>
          <div class="text-center">
            <i class="fa fa-5x <?= $value['icono'] ?> " style="<?= 'color:'.$value['color'] ?>"></i>
            <h1 style="font-weight: bold"><?= $value['descripcion'] ?></h1>
            <?php 
            foreach ($cursos_icono_det as $key2 => $value2) { 
              if($value2['curso_icono_id']==$value['curso_icono_id']){ ?>
                <h3><?= $value2['descripcion']?></h3>
            <?php 
              }
            }  
            ?>

          </div>
        </div>   
      <?php endforeach; ?>
      </div>


    </div>
  </div>
</div>