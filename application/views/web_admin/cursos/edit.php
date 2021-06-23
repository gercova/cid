
<!-- Default box -->
<div class="box box-solid">
    <div class="box-body">
        <div class="row">
            <div class="col-md-12">
                
                <?php msjFlashAlert($this->session->flashdata("error"));?>

                <form action="<?php echo base_url($controlador.'update');?>" method="POST" enctype="multipart/form-data">
                     <input type="hidden" name="curso_id" value="<?php echo $data->curso_id;?>">

					<div class="form-group col-md-4 <?php echo form_error('codigo_curso') == true ? 'has-error':''?>">
						<label for="codigo_curso">Codigo  (sigla):</label>
						<input type="text" class="form-control" id="codigo_curso" name="codigo_curso" value="<?php echo form_error("codigo_curso") !=false ? set_value("codigo_curso") : $data->codigo_curso;?>">
						<?php echo form_error("codigo_curso","<span class='help-block'>","</span>");?>
					</div>

					<div class="form-group col-md-8 <?php echo form_error('nombre_curso') == true ? 'has-error':''?>">
						<label for="nombre_curso">Nombre:</label>
						<input type="text" class="form-control" id="nombre_curso" name="nombre_curso" value="<?php echo form_error("nombre_curso") !=false ? set_value("nombre_curso") : $data->nombre_curso;?>">
						<?php echo form_error("nombre_curso","<span class='help-block'>","</span>");?>
					</div>

					<div class="form-group <?php echo form_error('descripcion_curso') == true ? 'has-error':''?>">
                        <label for="descripcion_curso">Descripci√≥n:</label>
                        <textarea class="form-control" id="descripcion_curso" name="descripcion_curso"><?php echo form_error("descripcion_curso") !=false ? set_value("descripcion_curso") : $data->descripcion_curso;?></textarea>
                        <?php echo form_error("descripcion_curso","<span class='help-block'>","</span>");?>
                    </div>

					<div class="form-group <?php echo form_error('imagen_curso') == true ? 'has-error':''?>">
						<label for="imagen_curso">Imagen : <?php echo $data->imagen_curso;?></label>
						<input type="hidden" name="imagen_curso_actual" value="<?php echo $data->imagen_curso;?>">
						<input type="file" class="form-control" id="imagen_curso" name="imagen_curso" value="<?php echo form_error("imagen_curso") !=false ? set_value("imagen_curso") : $data->imagen_curso;?>">
						<?php echo form_error("imagen_curso","<span class='help-block'>","</span>");?>
					</div>

                    <div class="form-group <?php echo form_error('enlace_web_curso') == true ? 'has-error':''?>">
                        <label for="enlace_web_curso">Enlace Web:</label>
                        <p>*Este enlace es para links a otras paginas o redes sociales</p>
                        <input type="text" class="form-control" id="enlace_web_curso" name="enlace_web_curso" value="<?php echo form_error("enlace_web_curso") !=false ? set_value("enlace_web_curso") : $data->enlace_web_curso;?>">
                        <?php echo form_error("enlace_web_curso","<span class='help-block'>","</span>");?>
                    </div>

                    <div class="form-group <?php echo form_error('enlace_web_informacion_curso') == true ? 'has-error':''?>">
                        <label for="enlace_web_informacion_curso">Enlace Web Informacion:</label>
                        <p>*Este enlace es para el detalle de informaci®Æn del curso . Ej.: web/cursos/informacion/CODIGO-CURSO</p>
                        <input type="text" class="form-control" id="enlace_web_informacion_curso" name="enlace_web_informacion_curso" value="<?php echo form_error("enlace_web_informacion_curso") !=false ? set_value("enlace_web_informacion_curso") : $data->enlace_web_informacion_curso;?>">
                        <?php echo form_error("enlace_web_informacion_curso","<span class='help-block'>","</span>");?>
                    </div>    

                    <div class="form-group col-md-6 <?php echo form_error('abreviatura_curso') == true ? 'has-error':''?>">
                        <label for="abreviatura_curso">Abreviatura:</label>
                        <input type="text" class="form-control" id="abreviatura_curso" name="abreviatura_curso" value="<?php echo form_error("abreviatura_curso") !=false ? set_value("abreviatura_curso") : $data->abreviatura_curso;?>">
                        <?php echo form_error("abreviatura_curso","<span class='help-block'>","</span>");?>
                    </div>                        

                     <div class="form-group col-md-6 <?php echo form_error('estado') == true ? 'has-error':''?>">
                        <label for="estado">Estado : </label>
                        <select  class="form-control" id="estado" name="estado">
                            <option value="">Seleccion estado...</option>
                            <?php if( $data->estado=='activo'){  ?>
                            <option selected value="activo">Activo</option>
                            <option value="inactivo">Inactivo</option>
                          <?php  }else{  ?>
                            <option  value="activo">Activo</option>
                            <option selected value="inactivo">Inactivo</option>
                          <?php } ?>
                        </select>
                       
                    </div>
                  
                    <div class="form-group">
                        <button type="submit" class="btn btn-success btn-flat">Guardar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- /.box-body -->
</div>
<!-- /.box -->