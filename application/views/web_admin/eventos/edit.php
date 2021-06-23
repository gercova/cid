
<!-- Default box -->
<div class="box box-solid">
    <div class="box-body">
        <div class="row">
            <div class="col-md-12">
                <?php msjFlashAlert($this->session->flashdata("error"));?>

                <form action="<?php echo base_url($controlador.'update');?>" method="POST" enctype="multipart/form-data">
                     <input type="hidden" name="evento_id" value="<?php echo $data->evento_id;?>">

					<div class="form-group <?php echo form_error('fecha_inicio') == true ? 'has-error':''?>">
						<label for="fecha_inicio">Fecha inicio:</label>
						<input type="date" class="form-control" id="fecha_inicio" name="fecha_inicio" value="<?php echo form_error("fecha_inicio") !=false ? set_value("fecha_inicio") : $data->fecha_inicio;?>">
						<?php echo form_error("fecha_inicio","<span class='help-block'>","</span>");?>
					</div>

					<div class="form-group <?php echo form_error('fecha_fin') == true ? 'has-error':''?>">
						<label for="fecha_fin">Fecha fin:</label>
						<input type="date" class="form-control" id="fecha_fin" name="fecha_fin" value="<?php echo form_error("fecha_fin") !=false ? set_value("fecha_fin") : $data->fecha_fin;?>">
						<?php echo form_error("fecha_fin","<span class='help-block'>","</span>");?>
					</div>

					<div class="form-group <?php echo form_error('titulo_evento') == true ? 'has-error':''?>">
						<label for="titulo_evento">Titulo del evento:</label>
						<input type="text" class="form-control" id="titulo_evento" name="titulo_evento" value="<?php echo form_error("titulo_evento") !=false ? set_value("titulo_evento") : $data->titulo_evento;?>">
						<?php echo form_error("titulo_evento","<span class='help-block'>","</span>");?>
					</div>

					<div class="form-group <?php echo form_error('subtitulo_evento') == true ? 'has-error':''?>">
						<label for="subtitulo_evento">Sub-titulo del evento:</label>
						<input type="text" class="form-control" id="subtitulo_evento" name="subtitulo_evento" value="<?php echo form_error("subtitulo_evento") !=false ? set_value("subtitulo_evento") : $data->subtitulo_evento;?>">
						<?php echo form_error("subtitulo_evento","<span class='help-block'>","</span>");?>
					</div>

					<div class="form-group <?php echo form_error('descripcion_evento') == true ? 'has-error':''?>">
						<label for="descripcion_evento">Descripción del evento:</label>
						<textarea class="form-control" id="descripcion_evento" name="descripcion_evento"><?php echo form_error("descripcion_evento") !=false ? set_value("descripcion_evento") : $data->descripcion_evento;?></textarea>
						<?php echo form_error("descripcion_evento","<span class='help-block'>","</span>");?>
						<code>
						*Si requiere agregar un enlace use el ejemplo &lt;a href='https://ctiunsm.pe/registro/'&gt Registro enlace &lt;/a&gt 
						</code>
					</div>

					<div class="form-group <?php echo form_error('imagen_evento') == true ? 'has-error':''?>">
						<label for="silabo">Imagen del evento : <?php echo $data->imagen_evento;?></label>
						<input type="hidden" name="imagen_evento_actual" value="<?php echo $data->imagen_evento;?>">
						<input type="file" class="form-control" id="imagen_evento" name="imagen_evento" value="<?php echo form_error("imagen_evento") !=false ? set_value("imagen_evento") : $data->imagen_evento;?>">
						<?php echo form_error("imagen_evento","<span class='help-block'>","</span>");?>
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