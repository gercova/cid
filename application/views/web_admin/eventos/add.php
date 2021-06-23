
<!-- Default box -->
<div class="box box-solid">
    <div class="box-body">
        <div class="row">
            <div class="col-md-12">
            	
                <?php msjFlashAlert($this->session->flashdata("error"));?>

                <form action="<?php echo base_url($controlador.'store');?>" method="POST" enctype="multipart/form-data">

                    <div class="form-group <?php echo form_error('fecha_inicio') == true ? 'has-error':''?>">
                        <label for="fecha_inicio">Fecha inicio:</label>
                        <input type="date" class="form-control" id="fecha_inicio" name="fecha_inicio" value="<?php echo date("Y-m-d");?>">
                        <?php echo form_error("fecha_inicio","<span class='help-block'>","</span>");?>
                    </div>

					<div class="form-group <?php echo form_error('fecha_fin') == true ? 'has-error':''?>">
						<label for="fecha_fin">Fecha fin:</label>
						<input type="date" class="form-control" id="fecha_fin" name="fecha_fin" value="<?php echo set_value("fecha_fin");?>">
						<?php echo form_error("fecha_fin","<span class='help-block'>","</span>");?>
					</div>

					<div class="form-group <?php echo form_error('titulo_evento') == true ? 'has-error':''?>">
						<label for="titulo_evento">Titulo del evento:</label>
						<input type="text" class="form-control" id="titulo_evento" name="titulo_evento" value="<?php echo set_value("titulo_evento");?>">
						<?php echo form_error("titulo_evento","<span class='help-block'>","</span>");?>
					</div>

					<div class="form-group <?php echo form_error('subtitulo_evento') == true ? 'has-error':''?>">
						<label for="subtitulo_evento">Sub-titulo del evento:</label>
						<input type="text" class="form-control" id="subtitulo_evento" name="subtitulo_evento" value="<?php echo set_value("subtitulo_evento");?>">
						<?php echo form_error("subtitulo_evento","<span class='help-block'>","</span>");?>
					</div>

					<div class="form-group <?php echo form_error('descripcion_evento') == true ? 'has-error':''?>">
						<label for="descripcion_evento">Descripción del evento:</label>
						<textarea class="form-control" id="descripcion_evento" name="descripcion_evento"><?php echo set_value("descripcion_evento");?></textarea>
						<?php echo form_error("descripcion_evento","<span class='help-block'>","</span>");?>
						<code>
						*Si requiere agregar un enlace use el ejemplo &lt;a href='https://ctiunsm.pe/registro/'&gt Registro enlace &lt;/a&gt 
						</code>
					</div>

					<div class="form-group">
						<label for="imagen_evento">Imagen del evento : </label>
						<input type="file" class="form-control" id="imagen_evento" name="imagen_evento" value="<?php echo set_value("imagen_evento");?>">
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