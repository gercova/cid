
<!-- Default box -->
<div class="box box-solid">
    <div class="box-body">
        <div class="row">
            <div class="col-md-12">

                <?php msjFlashAlert($this->session->flashdata("error"));?>
                
                <form action="<?php echo base_url($controlador.'update');?>" method="POST" enctype="multipart/form-data">
                     <input type="hidden" name="id" value="<?php echo $data->id;?>">

					<div class="form-group <?php echo form_error('titulo') == true ? 'has-error':''?>">
						<label for="titulo">Nombre:</label>
						<input type="text" class="form-control" id="titulo" name="titulo" value="<?php echo form_error("titulo") !=false ? set_value("titulo") : $data->titulo;?>">
						<?php echo form_error("titulo","<span class='help-block'>","</span>");?>
					</div>

					<div class="form-group <?php echo form_error('enlace') == true ? 'has-error':''?>">
						<label for="enlace">Enlace:</label>
						<input type="text" class="form-control" id="enlace" name="enlace" value="<?php echo form_error("enlace") !=false ? set_value("enlace") : $data->enlace;?>">
						<?php echo form_error("enlace","<span class='help-block'>","</span>");?>
					</div>

					<div class="form-group <?php echo form_error('text') == true ? 'has-error':''?>">
						<label for="text">Descripción:</label>
						<textarea class="form-control" id="text" name="text"><?php echo form_error("text") !=false ? set_value("text") : $data->text;?></textarea>
						<?php echo form_error("text","<span class='help-block'>","</span>");?>
					</div>

					<div class="form-group <?php echo form_error('imagen') == true ? 'has-error':''?>">
						<label for="imagen">Imagen: (Recomendado 690 x 520 píxeles) <?php echo $data->imagen;?></label>
						<input type="hidden" name="imagen" value="<?php echo $data->imagen;?>">
						<input type="file" class="form-control" id="imagen" name="imagen" value="<?php echo form_error("imagen") !=false ? set_value("imagen") : $data->imagen;?>">
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