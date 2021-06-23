<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>
			Apertura Curso
			<small>Nuevo</small>
		</h1>
	</section>
	<!-- Main content -->
	<section class="content">
		<!-- Default box -->
		<div class="box box-solid">
			<div class="box-body">
				<div class="row">
					<div class="col-md-12">
						<?php if ($this->session->flashdata("error")) : ?>
							<div class="alert alert-danger alert-dismissible">
								<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
								<p><i class="icon fa fa-ban"></i><?php echo $this->session->flashdata("error"); ?></p>
							</div>
					</div>
						<?php endif; ?>
						<form action="<?php echo base_url(); ?>movimientos/Aperturas/store" method="POST">

							<div class="form-group <?php echo form_error('curso') == true ? 'has-error' : '' ?>">
								<div class="col-md-6">
									<label for="">CURSO:</label>
										<input type="hidden" name="idcurso" id="idcurso" value="<?php echo set_value("idcurso"); ?>">
										<input type="text" size="100%"class="form-control" data-toggle="modal" data-target="#modal-curso" name="curso" id="curso" readonly value="<?php echo set_value("curso"); ?>">
		
									<?php echo form_error("curso", "<span class='help-block'>", "</span>"); ?>
								</div>
							</div>

							<div class="form-group <?php echo form_error('grupo') == true ? 'has-error' : '' ?>">
								<div class="col-md-6">
									<label for="">GRUPO CLASE:</label>
										<input type="hidden" name="idgrupo" id="idgrupo" value="<?php echo set_value("idgrupo"); ?>">
										<input type="text" class="form-control" data-toggle="modal" data-target="#modal-grupo" size="100%" name="grupo" id="grupo" readonly value="<?php echo set_value("grupo"); ?>">
										
									<?php echo form_error("grupo", "<span class='help-block'>", "</span>"); ?>
								</div>
							</div>

							<div class="form-group <?php echo form_error('fecha_ini') == true ? 'has-error' : '' ?>">
								<div class="col-md-6">
									<label for="">FECHA INICIO (tentativa):</label>
										<input type="date"  class="form-control" name="fecha_ini" id="fecha_ini" value="<?php echo set_value("fecha_ini")? set_value("fecha_ini"):date('Y-m-d'); ?>">
		
									<?php echo form_error("fecha_ini", "<span class='help-block'>", "</span>"); ?>
								</div>
							</div>
							
							<div class="form-group <?php echo form_error('sede_id') == true ? 'has-error':''?>">
								<div class="form-group col-md-6">
	                                <label for="sede_id">Sede  : </label>
	                                <select  class="form-control" id="sede_id" name="sede_id">
	                                	<?php foreach ($sedes as $s) : ?>
										<option value="<?php echo $s->id;?>" ><?php echo $s->nombre;?></option>
										<?php endforeach; ?>
	                                </select>    
                                </div>                           
                            </div>

							<div class="form-group <?php echo form_error('estado_inscripcion') == true ? 'has-error':''?>">
								<div class="form-group col-md-6">
	                                <label for="estado_inscripcion">Estado inscripcion  : </label>
	                                <select  class="form-control" id="estado_inscripcion" name="estado_inscripcion">
	                                    <option selected value="abierto">Abierto</option>
	                                    <option value="cerrado">Cerrado</option>
	                                </select>    
                                </div>                           
                            </div>


								

							<div class="form-group">
								<div class="col-md-12">
									<button type="submit" class="btn btn-success btn-flat">Guardar</button>
								</div>

							</div>
						</form>
					</div>
				</div>
			</div>
			<!-- /.box-body -->
		</div>
		<!-- /.box -->
	</section>
	<!-- /.content -->
</div>
<!-- /.content-wrapper -->

<div class="modal fade bd-example-modal-lg" id="modal-curso">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">Lita de Cursos</h4>
			</div>
			<div class="modal-body">
				<table id="example1" class="table table-bordered table-striped table-hover">
					<thead>
						<tr>
							<th>#</th>
							<th>NOMBRE</th>
							<th>TIPO</th>
							<th>OPCIÓN</th>
						</tr>
					</thead>
					<tbody>
						<?php if (!empty($cursos)) : ?>
							<?php foreach ($cursos as $curso) : ?>
								<tr>
									<td><?php echo $curso->id; ?></td>
									<td><?php echo $curso->nombre; ?></td>
									<td><?php echo $curso->descripcion; $come=$curso->descripcion." - ". $curso->nombre;?></td>
									<?php $datacurso = $curso->id . "*" . $come . "*" . $curso->costo; ?>
									<td>
										<button type="button" class="btn btn-success btn-cursoape" value="<?php echo $datacurso; ?>"><span class="fa fa-check"></span></button>
									</td>
								</tr>
							<?php endforeach; ?>
						<?php endif; ?>
					</tbody>
				</table>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Cerrar</button>
			</div>
		</div>
		<!-- /.modal-content -->
	</div>
	<!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<div class="modal fade bd-example-modal-lg" id="modal-grupo">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">LISTADO DE GRUPOS</h4>
			</div>
			<div class="modal-body">
				<table id="example2" class="table table-bordered table-striped table-hover">
					<thead>
						<tr>
							<th>#</th>
							<th>NOMBRE</th>
							<th>HORA INICIO</th>
							<th>HORA FIN</th>
							<th>OPCIÓN</th>
						</tr>
					</thead>
					<tbody>
						<?php if (!empty($grupos)) : ?>
							<?php foreach ($grupos as $grupo) : ?>
								<tr>
									<td><?php echo $grupo->id; ?></td>
									<td><?php echo $grupo->nombre; ?></td>
									<td><?php echo $grupo->hora_ini; ?></td>
									<td><?php echo $grupo->hora_fin; ?></td>
									<?php $datagrupo = $grupo->id . "*" . $grupo->nombre . "*" . $grupo->hora_ini . "*" . $grupo->hora_fin; ?>
									<td>
										<button type="button" class="btn btn-success btn-grupoape" value="<?php echo $datagrupo; ?>"><span class="fa fa-check"></span></button>
									</td>
								</tr>
							<?php endforeach; ?>
						<?php endif; ?>
					</tbody>
				</table>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Cerrar</button>
			</div>
		</div>
		<!-- /.modal-content -->
	</div>
	<!-- /.modal-dialog -->
</div>
<!-- /.modal -->
