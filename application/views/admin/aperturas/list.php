<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>
			APERTURA DE CURSO
			<small>Listado</small>
		</h1>
	</section>
	<!-- Main content -->
	<section class="content">
		<!-- Default box -->
		<div class="box box-solid">
			<div class="box-body">
				<div class="row">
					<div class="col-md-12">
						<?php if ($permisos->insert == 1) : ?>
							<!-- para permisos  -->
							<a href="<?php echo base_url(); ?>movimientos/aperturas/add" class="btn btn-primary btn-flat"><span class="fa fa-plus"></span> Aperturar Curso</a>
						<?php endif; ?>
					</div>
				</div>

				<!-- <div class="row">
					<div class="col-md-14">
						<form action="<?php echo current_url(); ?>" method="POST">
							<div class="form-group ">

								<label for="" class="col-md-3 control-label">Cursos Aperturados: </label>
								<div class="col-md-5">
									<input type="hidden" name="datouno" id="datouno" value="<?php echo set_value("datouno"); ?>">
									<input type="hidden" name="datodos" id="datodos" value="<?php echo set_value("datodos"); ?>">
									<input type="text" class="form-control" name="informacion" id="informacion" readonly data-toggle="modal" data-target="#modal-cur-gru-pre" value="<?php echo set_value("informacion"); ?>">
								</div>
								<div class="col-md-4">
									<input type="submit" name="buscar" value="Buscar" class="btn btn-primary">
									<a href="<?php echo base_url(); ?>movimientos/Aperturas" class="btn btn-danger">Restablecer</a>
								</div>

							</div>
						</form>
					</div>
				</div>-->
				<hr>
				<div class="row">
					<div class="table-responsive col-md-12">
						<table id="example1" class="table table-bordered table-hover">
							<thead>
								<tr>
									<th>#</th>
									<th>CURSO</th>
									<th>TIPO</th>
									<th>GRUPO</th>
									<th>HORARIO</th>
									<th>OPCIÓN</th>
								</tr>
							</thead>
							<tbody>
								<?php if (!empty($Aperturas)) : ?>
									<?php foreach ($Aperturas as $apertura) : ?>
										<tr>
											<td><?php echo $apertura->id; ?></td>
											<td><?php echo $apertura->curso; ?></td>
											<td><?php echo $apertura->descripcion; ?></td>
											<td><?php echo $apertura->grupo; ?></td>
											<td><?php echo $apertura->hora_ini; ?> :: <?php echo $apertura->hora_fin; ?></td>
											<td>
												<div class="btn-group">
													<button type="button" class="btn btn-info btn-view-aperturas" data-toggle="modal" data-target="#modal-aperturas" value="<?php echo $apertura->id; ?>">
														<span class="fa fa-search"></span>
													</button>
													<?php if ($permisos->update == 1) : ?>
														<!-- para permisos  -->
														<a href="<?php echo base_url() ?>movimientos/aperturas/edit/<?php echo $apertura->id; ?>" class="btn btn-warning"><span class="fa fa-pencil"></span></a>
													<?php endif; ?>
													<?php if ($permisos->delete == 1) : ?>
														<!-- para permisos  -->
														<a href="<?php echo base_url(); ?>movimientos/aperturas/delete/<?php echo $apertura->id; ?>" class="btn btn-danger btn-remove"><span class="fa fa-remove"></span></a>
													<?php endif; ?>
												</div>
											</td>
										</tr>
									<?php endforeach; ?>
								<?php endif; ?>
							</tbody>
						</table>
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

<div class="modal fade" id="modal-aperturas">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">INFORMACIÓN DE LA APERTURA</h4>
			</div>
			<div class="modal-body">

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

<div class="modal fade" id="modal-cur-gru-pre">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">lISTA </h4>
			</div>
			<div class="modal-body">
				<table id="example5" class="table table-bordered table-striped table-hover">
					<thead>
						<tr>
							<th>#</th>
							<th>CURSO</th>
							<th>GRUPOS</th>
							<th>HORA INICIO</th>
							<th>HORA FIN</th>
							<th>OPCIÓN</th>
						</tr>
					</thead>
					<tbody>
						<?php if (!empty($curgrupres)) : ?>
							<?php foreach ($curgrupres as $curgrupre) : ?>
								<tr>
									<td><?php echo $curgrupre->id; ?></td>
									<td><?php echo $curgrupre->curso; ?></td>
									<td><?php echo $curgrupre->grupo; ?></td>
									<td><?php echo $curgrupre->hora_ini; ?></td>
									<td><?php echo $curgrupre->hora_fin; ?></td>
									<?php $datacurgrupre = $curgrupre->id . "*" . $curgrupre->curso_id . "*" . $curgrupre->curso . "*" . $curgrupre->grupo_id . "*" . $curgrupre->grupo . "*" . $curgrupre->hora_ini . "*" . $curgrupre->hora_fin; ?>
									<td>
										<button type="button" class="btn btn-success btn-curgrupre" value="<?php echo $datacurgrupre; ?>"><span class="fa fa-check"></span></button>
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
