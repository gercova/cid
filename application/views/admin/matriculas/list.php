<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>
			CURSOS Y EVENTOS APERTURADOS
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
							<a href="<?php echo base_url(); ?>matriculas/matriculas/add" class="btn btn-primary btn-flat"><span class="fa fa-plus"></span> Agregar Matricula</a>
						<?php endif; ?>
					</div>
				</div>


				<hr>
				<div class="row">
					<div class="table-responsive col-md-12">
						<table id="example1" class="table table-bordered table-hover">
							<thead>
								<tr>
									<th>#</th>
									<th>CURSO</th>
									<th>DOCENTE</th>
									<th>GRUPO</th>
									<th>HORARIO</th>
									<th>FECHA</th>
									<th>AULA</th>
									<th>OPCIÓN</th>
								</tr>
							</thead>
							<tbody>
								<?php if (!empty($matriculas)) : ?>
									<?php foreach ($matriculas as $matricula) : ?>
										<tr>
											<td> <?php echo $matricula->id; ?></td>
											<td><?php echo $matricula->curso; ?> </td>
											<td><?php echo $matricula->docente; ?></td>
											<td><?php echo $matricula->grupo; ?></td>
											<td><?php echo $matricula->hora_ini; ?> <br> <?php echo $matricula->hora_fin; ?></td>
											<td><?php echo $matricula->fecha_ini; ?><br> <?php echo $matricula->fecha_fin; ?></td>
											<td><?php echo $matricula->aula; ?></td>
											<?php $datamatricula = $matricula->curso_id . "*" . $matricula->grupo_id . "*" . $matricula->fecha_ini . "*" . $matricula->fecha_fin . "*" . $matricula->docente_id . "*" . $matricula->aula_id; ?>
											<td>
												<div class="btn-group">
													<button type="button" class="btn btn-info btn-matriculados" data-toggle="modal" data-target="#modal-matriculados" value="<?php echo $matricula->id; ?>">
														<span class="fa fa-search"></span>
													</button>
													<?php if ($permisos->update == 1) : ?>
														<!-- para permisos  -->
														<a href="<?php echo base_url() ?>matriculas/matriculas/edit/<?php echo $matricula->id; ?>" class="btn btn-warning"><span class="fa fa-pencil"></span></a>
													<?php endif; ?>
													<?php if ($permisos->delete == 1) : ?>
														<!-- para permisos  -->
														<a href="<?php echo base_url(); ?>matriculas/matriculas/delete/<?php echo $matricula->id; ?>" class="btn btn-danger btn-remove"><span class="fa fa-remove"></span></a>
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

<div class="modal fade" id="modal-matriculados">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">Informacion de la matricula</h4>
			</div>
			<div class="modal-body">


			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Cerrar</button>
				<button type="button" class="btn btn-primary btn-print"><span class="fa fa-print"> Imprimir</span></button>
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
				<h4 class="modal-title">LISTA</h4>
			</div>
			<div class="modal-body">
				<table id="example5" class="table table-bordered table-striped table-hover">
					<thead>
						<tr>
							<th>#</th>
							<th>CURSO</th>
							<th>GRUPO</th>
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
