<?php 
$tablinks = $tabcontent = array("contenido" => "","modulo" => "","icono" => "" );

if($this->session->flashdata("tab_select")){
    $tablinks[$this->session->flashdata("tab_select")]="active";
    $tabcontent[$this->session->flashdata("tab_select")]="style='display:block'";
}else{
    $tablinks["contenido"]="active";
    $tabcontent["contenido"]="style='display:block'";
}

?>

<input type="hidden" id="controlador_mantenimiento" value="<?= $controlador ?>">

<!-- Main content -->
<div class="box box-solid">
    <div class="box-body">
    <!-- Default box -->
	<div class="tab">
      <button class="tablinks <?=$tablinks["contenido"]?>" onclick="openTab(event,'Contenido')">Contenido</button>
      <button class="tablinks <?=$tablinks["modulo"]?>" onclick="openTab(event,'Modulo')">Módulo</button>
      <button class="tablinks <?=$tablinks["icono"]?>" onclick="openTab(event,'Icono')">Icono</button>
    </div>

    <div class="row">
        <?php msjFlashAlert($this->session->flashdata("error"));?>
    </div>

    <div id="Contenido" class="tabcontent" <?=$tabcontent["contenido"]?> >
    <div class="box box-solid">
        <div class="box-body">
            <div class="row">
                <div class="col-md-12">    

                    <form action="<?php echo base_url($controlador.'updateCursoContenido');?>" method="POST" enctype="multipart/form-data">

                        <div class="form-group col-md-10 <?php echo form_error('descripcion_contenido') == true ? 'has-error':''?>">
                            <label for="descripcion_contenido"> CONTENIDO DESCRIPCION :</label>
                            <input type="text" class="form-control" id="descripcion_contenido" name="descripcion_contenido" required>
                            <input type="hidden" class="form-control" id="curso_id" name="curso_id" value="<?= $id ?>" >
                        </div>

                        <div class="col-md-2">
                            <label for="">&nbsp;</label>
                            <button  type="submit" class="btn btn-success btn-flat btn-block"><span class="fa fa-plus"></span> Agregar</button>
                        </div>

                    </form>

                    <form action="<?php echo base_url($controlador.'updateCursoContenidoDet');?>" method="POST" enctype="multipart/form-data">
                        <div class="form-group col-md-5 <?php echo form_error('contenido_id') == true ? 'has-error':''?>">
                            <label for="contenido_id">Contenido :</label>
                            <input type="hidden" class="form-control" id="curso_id" name="curso_id" value="<?= $id ?>" >
                            <select class="form-control"  id="contenido_id" name="contenido_id" required>
                            <option value="" >Seleccione contenido...</option>
                            <?php $p=0; 
                                foreach($dataContenido as $dc) :
                            ?>
                                <option value="<?= $dc->curso_contenido_id ?>">
                                    <?= $dc->descripcion ?>
                                </option>
                            <?php endforeach;
                            ?>
                            </select>
                        </div>
                        <div class="form-group col-md-5 <?php echo form_error('descripcion_contenido_det') == true ? 'has-error':''?>">
                            <label for="descripcion_contenido_det">Contenido descripcion detallado:</label>
                            <input type="text" class="form-control" id="descripcion_contenido_det" name="descripcion_contenido_det" required>
                        </div>

                        <div class="col-md-2">
                            <label for="">&nbsp;</label>
                            <button  type="submit" class="btn btn-success btn-flat btn-block"><span class="fa fa-plus"></span> Agregar</button>
                        </div>
                    </form>
                    
                    <table id="tbcursocontenido" class="table table-bordered table-striped table-hover">
                        <thead>
                            <tr>
                                <th>CONTENIDO</th>
                                <th>OPERACION</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php $p=0; 
                               foreach($dataContenido as $dc){
                        ?>
                            <tr style="background-color: #96d5dd">
                                <th> <input type="hidden" class="form-control" id="idcursocontenido[]" name="idcursocontenido[]" value="<?= $dc->curso_contenido_id ?>" >
                                    <input type="hidden" class="form-control" id="descripcioncontenido[]" name="descripcioncontenido[]" value="<?= $dc->descripcion ?>" >
                                    <?= $dc->descripcion ?>
                                </th>
                                <th>
                                    <a title="eliminar contenido" href="<?php echo base_url($controlador.'eliminarcontenido/'.$dc->curso_contenido_id.'/'.$dc->curso_id);?>" class="btn btn-danger">
                                        <span class='fa fa-remove'></span>
                                    </a>
                                </th>
                            </tr>
                            <?php 
                            foreach($dataContenidoDet as $dcd){
                                if($dcd->curso_contenido_id==$dc->curso_contenido_id){ 
                            ?>
                            <tr style="background-color: #aef6ff">
                                <th>
                                    <div style="margin-left: 10%" class="col-md-2">
                                        <?= $dcd->descripcion ?>
                                    </div>  
                                </th>
                                <th>
                                    <a title="eliminar detalle del contenido" href="<?php echo base_url($controlador.'eliminarcontenidodet/'.$dcd->curso_contenido_det_id.'/'.$dc->curso_id); ?>" class="btn btn-danger"><span class='fa fa-remove' ></span></a>
                                </th>
                            </tr>
                            <?php 
                                }
                            }
                            ?>

                        <?php }  ?>
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
        <!-- /.box-body -->
    </div>
    <!-- /.box -->
    </div>

    <div id="Modulo" class="tabcontent" <?=$tabcontent["modulo"]?> >
        <div class="box box-solid">
        <div class="box-body">
            <div class="row">
                <div class="col-md-12">
                   
                    <form action="<?php echo base_url($controlador.'updateCursoModulo');?>" method="POST" enctype="multipart/form-data">
                        <div class="form-group col-md-10 <?php echo form_error('descripcion_modulo') == true ? 'has-error':''?>">
                            <label for="descripcion_modulo"> MÓDULO DESCRIPCION :</label>
                            <input type="text" class="form-control" id="descripcion_modulo" name="descripcion_modulo" required>
                            <input type="hidden" class="form-control" id="curso_id" name="curso_id" value="<?= $id ?>" >
                        </div>

                        <div class="col-md-2">
                            <label for="">&nbsp;</label>
                            <button  type="submit" class="btn btn-success btn-flat btn-block"><span class="fa fa-plus"></span> Agregar</button>
                        </div>
                    </form>

                    <form action="<?php echo base_url($controlador.'updateCursoModuloDet');?>" method="POST" enctype="multipart/form-data">
                        <div class="form-group col-md-5 <?php echo form_error('modulo_id') == true ? 'has-error':''?>">
                            <label for="modulo_id">Módulo :</label>
                            <input type="hidden" class="form-control" id="curso_id" name="curso_id" value="<?= $id ?>" >
                            <select class="form-control"  id="modulo_id" name="modulo_id" required>

                                <option value="" >Seleccione módulo...</option>
                            <?php $p=0; 
                                    foreach($dataModulo as $dm){
                            ?>
                                <option value="<?= $dm->curso_modulo_id ?>" >
                                    <?= $dm->descripcion ?></option>
                            <?php
                                  }
                            ?>
                            </select>
                        </div>
                        <div class="form-group col-md-5 <?php echo form_error('descripcion_modulo_det') == true ? 'has-error':''?>">
                            <label for="descripcion_modulo_det">Módulo descripción detallado:</label>
                            <input type="text" class="form-control" id="descripcion_modulo_det" name="descripcion_modulo_det" required>
                        </div>

                        <div class="col-md-2">
                            <label for="">&nbsp;</label>
                            <button  type="submit" class="btn btn-success btn-flat btn-block"><span class="fa fa-plus"></span> Agregar</button>

                        </div>
                    </form>

                    <table id="tbcursocontenido" class="table table-bordered table-striped table-hover">
                        <thead>
                            <tr>
                                <th>MÓDULO</th>
                                <th>OPERACIÓN</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php $p=0; 
                            foreach($dataModulo as $dm){
                        ?>
                            <tr style="background-color: #96d5dd">
                                <th>  <?= $dm->descripcion ?>  </th>
                                <th>                                        
                                    <a title="Eliminar módulo" href="<?php echo base_url($controlador.'eliminarmodulo/'.$dm->curso_modulo_id.'/'.$dm->curso_id); ?>" class="btn btn-danger">
                                        <span class='fa fa-remove'></span></a>
                                </th>
                            </tr>
                            <?php 
                            foreach($dataModuloDet as $dmd){
                                if($dmd->curso_modulo_id==$dm->curso_modulo_id){ 
                            ?>
                             <tr style="background-color: #aef6ff">
                                <th>  
                                    <div style="margin-left: 10%" class="col-md-2"> <?= $dmd->descripcion ?>                                        
                                    </div>  
                                </th>
                                <th>                                   
                                    <a title="Eliminar detalle del contenido" href="<?php echo base_url($controlador.'eliminarmodulodet/'.$dmd->curso_modulo_det_id.'/'.$dc->curso_id);?>" class="btn btn-danger"><span class='fa fa-remove' ></span></a>
                                </th>
                            </tr>
                            <?php 
                                }
                            }
                            ?>

                        <?php }  ?>
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
        <!-- /.box-body -->
        </div>
    <!-- /.box -->
    </div>


    <div id="Icono" class="box box-solid tabcontent" <?=$tabcontent["icono"]?> >
        <div class="box box-solid">
        <div class="box-body">
            <div class="row">
                <div class="col-md-12">
                    
                    <form action="<?php echo base_url($controlador.'updateCursoIcono');?>" method="POST" enctype="multipart/form-data">

                        <div class="form-group col-md-4 <?php echo form_error('descripcion_icono') == true ? 'has-error':''?>">
                            <label for="descripcion_icono"> ICONO DESCRIPCION :</label>
                            <input type="text" class="form-control" id="descripcion_icono" name="descripcion_icono" placeholder="Precio" required>
                            <input type="hidden" class="form-control" id="curso_id" name="curso_id" value="<?= $id ?>" >
                        </div>

                        <div class="form-group col-md-2 <?php echo form_error('color') == true ? 'has-error':''?>" >
                            <label for="color"> COLOR :</label>
                            <input type="color" class="form-control" id="color" name="color" value="#0089ff" required>
                        </div>

                        <div class="form-group col-md-4 <?php echo form_error('icono') == true ? 'has-error':''?>" >
                            <label for="icono"> ICONO IMAGEN HTML :</label>
                            <input type="text" class="form-control" id="icono" name="icono" required>
                            <button type="button" id="btn-iconos-disponibles" onclick="verIconosDisponibles()">Ver iconos</button>
                        </div>

                        <div class="col-md-2">
							<label for="">&nbsp;</label>
							<button  type="submit" class="btn btn-success btn-flat btn-block"><span class="fa fa-plus"></span> Agregar</button>
						</div>

                    </form>

                    <form action="<?php echo base_url($controlador.'updateCursoIconoDet');?>" method="POST" enctype="multipart/form-data">
                        <div class="form-group col-md-4 <?php echo form_error('codigo_curso') == true ? 'has-error':''?>">
                            <label for="codigo_curso">Icono :</label>
                            <input type="hidden" class="form-control" id="curso_id" name="curso_id" value="<?= $id ?>" >
                            <select class="form-control" id="icono_id" name="icono_id" required>

                                <option value="" >Seleccione icono...</option>
                            <?php $p=0; 
                                foreach($dataIcono as $di){
                            ?>
                                <option value="<?= $di->curso_icono_id ?>" >
                                    <?= $di->descripcion ?></option>
                            <?php }   ?>

                            </select>
                        </div>
                        <div class="form-group col-md-5 <?php echo form_error('descripcion_icono_det') == true ? 'has-error':''?>">
                            <label for="descripcion_icono_det">Icono descripcion detallado:</label>
                            <input type="text" class="form-control" id="descripcion_icono_det" name="descripcion_icono_det" placeholder="Publico en general: S/  200.00" required>
                        </div>
                        <div class="form-group col-md-1 <?php echo form_error('orden') == true ? 'has-error':''?>">
                            <label for="orden">orden:</label>
                            <input type="number" class="form-control" id="orden" name="orden" value="1" required>
                        </div>

                        <div class="col-md-2">
							<label for="">&nbsp;</label>
							<button  type="submit" class="btn btn-success btn-flat btn-block"><span class="fa fa-plus"></span> Agregar</button>
						</div>
                    </form>
                    <table id="tbcursocontenido" class="table table-bordered table-striped table-hover">
                        <thead>
                            <tr>
                                <th>ICONO</th>
                                <th>IMAGEN</th>
                                <th>COLOR</th>
                                <th>ORDEN</th>
                                <th width="10%">OPERACION</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php $p=0; 
                               foreach($dataIcono as $di){
                        ?>
                            <tr style="background-color: #96d5dd">
                                <th><?= $di->descripcion ?></th>
                                <th><?= $di->icono ?></th>
                                <th><?= $di->color ?></th>
                                <th>  - </th>
                                <th>
                                    <a title="eliminar módulo" href="<?php echo base_url($controlador.'eliminaricono/'.$di->curso_icono_id.'/'.$di->curso_id); ?>" class="btn btn-danger"><span class='fa fa-remove'></span></a>
                                </th>
                            </tr>
                            <?php 
                               foreach($dataIconoDet as $did){
                                if($did->curso_icono_id==$di->curso_icono_id){ 
                            ?>
                             <tr style="background-color: #aef6ff">
                                <th>  <div style="margin-left: 10%" > <?= $did->descripcion ?>
                                      </div>  
                                </th>
                                <th>  <div style="margin-left: 10%" > <?= '-' ?>
                                      </div>  
                               </th>
                                <th>  <div style="margin-left: 10%" > <?= '-' ?>
                                      </div>  
                               </th>
                                <th>  <div style="margin-left: 10%" > <?= $did->orden ?>
                                      </div>  
                               </th>
                                <th>
                                    <a title="Eliminar detalle del contenido" href="<?php echo base_url($controlador.'eliminariconodet/'.$did->curso_icono_det_id.'/'.$di->curso_id); ?>" class="btn btn-danger"><span class='fa fa-remove' ></span></a>
                                </th>
                            </tr>
                            <?php 
                                }
                            }
                            ?>

                        <?php }  ?>
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
        <!-- /.box-body -->
        </div>
    <!-- /.box -->
    </div>
    </div>
</div>
<!-- /.content -->

<!-- /.content-wrapper -->
<script>

function openTab(evt, cityName) {
  var i, tabcontent, tablinks;
  tabcontent = document.getElementsByClassName("tabcontent");
  for (i = 0; i < tabcontent.length; i++) {
    tabcontent[i].style.display = "none";
  }
  tablinks = document.getElementsByClassName("tablinks");
  for (i = 0; i < tablinks.length; i++) {
    tablinks[i].className = tablinks[i].className.replace(" active", "");
  }
  document.getElementById(cityName).style.display = "block";
  evt.currentTarget.className += " active";
}


function verIconosDisponibles(){

    var controlador_mantenimiento = $("#controlador_mantenimiento").val();
    var base_url = "<?php echo base_url();?>";
    $("#modal-info").modal("show");
    $.ajax({
        url: base_url + controlador_mantenimiento +"/iconosDisponibles/" ,
        type:"POST",
        success:function(resp){
            $("#modal-info .modal-body").html(resp);
        }

    });

}
</script>
