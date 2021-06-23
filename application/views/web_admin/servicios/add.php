
<div class="box box-solid">
    <div class="box-body">
        <div class="row">
            <div class="col-md-12">
                
                <?php msjFlashAlert($this->session->flashdata("error"));?>
                
                <form action="<?php echo base_url($controlador.'store');?>" method="POST" enctype="multipart/form-data">

                    <div class="form-group <?php echo form_error('titulo') == true ? 'has-error':''?>">
                        <label for="titulo">Nombre:</label>
                        <input type="text" class="form-control" id="titulo" name="titulo" value="<?php echo set_value("titulo");?>" placeholder="EXAMEN DE SUFICIENCIA">
                        <?php echo form_error("titulo","<span class='help-block'>","</span>");?>
                    </div>

					<div class="form-group <?php echo form_error('enlace') == true ? 'has-error':''?>">
						<label for="enlace">Enlace:</label>
						<input type="text" class="form-control" id="enlace" name="enlace" value="<?php echo set_value("enlace");?>" placeholder="web/servicios/informacion/examen-suficiencia">
						<?php echo form_error("enlace","<span class='help-block'>","</span>");?>
					</div>

					<div class="form-group <?php echo form_error('text') == true ? 'has-error':''?>">
						<label for="text">Descripción:</label>
						<textarea class="form-control" id="text" name="text" placeholder="CTI - UNSM,  te facilita el requisito de suficiencia en cursos informáticos, a través de la administración de un examen de suficiencia"><?php echo set_value("text");?></textarea>
						<?php echo form_error("text","<span class='help-block'>","</span>");?>
					</div>

					<div class="form-group <?php echo form_error('imagen') == true ? 'has-error':''?>">
						<label for="imagen">Imagen: (Recomendado 690 x 520 píxeles) </label>
						<input type="file" class="form-control" id="imagen" name="imagen" value="<?php echo set_value("imagen");?>">
						<?php echo form_error("imagen","<span class='help-block'>","</span>");?>
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
