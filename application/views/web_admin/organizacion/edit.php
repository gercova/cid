
<!-- Default box -->
<div class="box box-solid">
    <div class="box-body">
        <div class="row">
            <div class="col-md-12">

            	<?php $msjType = $this->session->flashdata("error")? "error":"success";
				msjFlashAlert( $this->session->flashdata($msjType), $msjType);?>

                <form action="<?php echo base_url($controlador);?>update" method="POST" enctype="multipart/form-data">
                     <input type="hidden" name="id_organizacion" value="<?php echo $data->id_organizacion;?>">

					<div class="form-group <?php echo form_error('direccion') == true ? 'has-error':''?>">
						<label for="direccion">Dirección:</label>
						<input type="text" class="form-control" id="direccion" name="direccion" value="<?php echo form_error("direccion") !=false ? set_value("direccion") : $data->direccion;?>">
						<?php echo form_error("direccion","<span class='help-block'>","</span>");?>
					</div>
					<div class="form-group <?php echo form_error('direccion_referencia') == true ? 'has-error':''?>">
						<label for="direccion_referencia">Dirección referencia:</label>
						<input type="text" class="form-control" id="direccion_referencia" name="direccion_referencia" value="<?php echo form_error("direccion_referencia") !=false ? set_value("direccion_referencia") : $data->direccion_referencia;?>">
						<?php echo form_error("direccion_referencia","<span class='help-block'>","</span>");?>
					</div>

					<div class="form-group col-md-6 <?php echo form_error('telefono_principal') == true ? 'has-error':''?>">
						<label for="telefono_principal">Telefono principal:</label>
						<input type="text" class="form-control" id="telefono_principal" name="telefono_principal" value="<?php echo form_error("telefono_principal") !=false ? set_value("telefono_principal") : $data->telefono_principal;?>">
						<?php echo form_error("telefono_principal","<span class='help-block'>","</span>");?>
					</div>
					<div class="form-group col-md-6 <?php echo form_error('telefonos') == true ? 'has-error':''?>">
						<label for="telefonos">Telefonos adicionales:</label>
						<input type="text" class="form-control" id="telefonos" name="telefonos" value="<?php echo form_error("telefonos") !=false ? set_value("telefonos") : $data->telefonos;?>">
						<?php echo form_error("telefonos","<span class='help-block'>","</span>");?>
					</div>

					<div class="form-group col-md-6 <?php echo form_error('correo_principal') == true ? 'has-error':''?>">
						<label for="correo_principal">Correo principal:</label>
						<input type="text" class="form-control" id="correo_principal" name="correo_principal" value="<?php echo form_error("correo_principal") !=false ? set_value("correo_principal") : $data->correo_principal;?>">
						<?php echo form_error("correo_principal","<span class='help-block'>","</span>");?>
					</div>
					<div class="form-group col-md-6 <?php echo form_error('correos') == true ? 'has-error':''?>">
						<label for="correos">Correos adicionales:</label>
						<input type="text" class="form-control" id="correos" name="correos" value="<?php echo form_error("correos") !=false ? set_value("correos") : $data->correos;?>">
						<?php echo form_error("correos","<span class='help-block'>","</span>");?>
					</div>

					<div class="form-group <?php echo form_error('informacion_pago') == true ? 'has-error':''?>">
						<label for="informacion_pago">Información de pago:</label>
						<textarea class="form-control" id="informacion_pago" name="informacion_pago" rows="4"><?php echo form_error("informacion_pago") !=false ? set_value("informacion_pago") : $data->informacion_pago;?></textarea>
						<?php echo form_error("informacion_pago","<span class='help-block'>","</span>");?>
					</div>

					<hr>
					<div class="form-group <?php echo form_error('introduccion_organizacion') == true ? 'has-error':''?>">
						<label for="introduccion_organizacion">Introduccion en "nosotros":</label>
						<textarea class="form-control" id="introduccion_organizacion" name="introduccion_organizacion" rows="4"><?php echo form_error("introduccion_organizacion") !=false ? set_value("introduccion_organizacion") : $data->introduccion_organizacion;?></textarea>
						<?php echo form_error("introduccion_organizacion","<span class='help-block'>","</span>");?>
					</div>

					<div class="form-group col-md-6 <?php echo form_error('vision_organizacion') == true ? 'has-error':''?>">
						<label for="vision_organizacion">Visión:</label>
						<textarea class="form-control" id="vision_organizacion" name="vision_organizacion" rows="4"><?php echo form_error("vision_organizacion") !=false ? set_value("vision_organizacion") : $data->vision_organizacion;?></textarea>
						<?php echo form_error("vision_organizacion","<span class='help-block'>","</span>");?>
					</div>

					<div class="form-group col-md-6 <?php echo form_error('mision_organizacion') == true ? 'has-error':''?>">
						<label for="mision_organizacion">Misión:</label>
						<textarea class="form-control" id="mision_organizacion" name="mision_organizacion" rows="6"><?php echo form_error("mision_organizacion") !=false ? set_value("mision_organizacion") : $data->mision_organizacion;?></textarea>
						<?php echo form_error("mision_organizacion","<span class='help-block'>","</span>");?>
					</div>
                  	
                  	<?php if ($permisos->update == 1) : ?>
                    <div class="form-group">                    	
                        <button type="submit" class="btn btn-success btn-flat">Guardar</button>
                    </div>
                    <?php endif; ?>
                </form>
            </div>
        </div>
    </div>
    <!-- /.box-body -->
</div>
<!-- /.box -->