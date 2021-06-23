
<!-- Modal informativo -->
<div class="modal fade" id="modal-solicitud-apertura">
	<div class="modal-dialog">
		<div class="modal-content">

            <form action="<?php echo base_url($controlador.'guardar_solicitud_apertura');?>" method="POST">

			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title"> Solicitud de apertura (Nuevo Horario)</h4>
			</div>
			<div class="modal-body" style="padding-bottom: 0.5rem">
                <div class="row">				
					<div class="form-group col-md-12">
                        <label for="codigo_curso">Curso:</label>
                         <select  class="form-control" id="solicitud_curso_id" name="solicitud_curso_id" required >
                            <option value="">--- Seleccione curso ---</option>
                         	<?php foreach ($cursos as $c) {                         	
                         	?>
                            <option value="<?=$c->id?>">
                                <?= $c->nombre ?>                                    
                            </option>
                         	<?php  } ?>
                        </select>
                    </div>

                    <div class="form-group col-md-12" >
                        <label for="solicitud_nombre">Apellidos y nombres</label>
                        <input class="form-control" id="solicitud_nombre" name="solicitud_nombre" type="text" required placeholder="Ingrese su apellidos y nombres">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="solicitud_celular">Celular</label>
                        <input class="form-control" id="solicitud_celular" name="solicitud_celular" type="text" placeholder="Ingrese su celular">
                    </div>
                    <div class="form-group col-md-8">
                        <label for="solicitud_correo">Correo</label>
                        <input class="form-control" id="solicitud_correo" name="solicitud_correo" type="email" placeholder="Ingrese su correo">
                    </div>

                    <div class="form-group col-md-12">
                        <?php $dias_disponibles = array('lunes','martes','miercoles','jueves','viernes','sabado', 'domingo') ?>

                            <?php foreach ($dias_disponibles as $key => $val): ?>
                                <div class="form-group col-md-3">
                            <div class="checkbox">
                                <label><input type="checkbox"  id="<?=$val?>" name="<?=$val?>">
                                    <?= strtoupper($val) ?>
                                </label>
                            </div>
                                
                                </div>
                            <?php endforeach ?>
                    </div>

                    <div class="form-group col-md-12">
                        <label for="hora_tentativa">Informacion de la hora tentativa:</label>
                        <textarea class="form-control" id="solicitud_hora_tentativa" name="solicitud_hora_tentativa" placeholder="Turno mañana, tarde o noche." required></textarea>
                    </div>
                    <div class="form-group col-md-12">
                        <label for="mensaje">Mensaje:</label>
                        <textarea class="form-control" id="solicitud_mensaje" name="solicitud_mensaje" placeholder="Somos un grupo de compañeros de V ciclo de la UNSM."></textarea>
                    </div>

				
                </div>

			</div>
			<div class="modal-footer">
                <button type="submit" class="btn btn-success btn-lg pull-left">Enviar </button>
				<button type="button" class="btn btn-danger btn-lg pull-right" data-dismiss="modal">Cerrar</button>
			</div>

            </form>
		</div>
		<!-- /.modal-content -->
	</div>
	<!-- /.modal-dialog -->
</div>
<!-- /.modal -->