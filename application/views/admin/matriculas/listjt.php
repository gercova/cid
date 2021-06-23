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
			<hr>
				<div id="matriculas">
					
				</div>
			</div>
			<!-- /.box-body -->
		</div>
		<!-- /.box -->
	</section>
	<!-- /.content -->
</div>
<!-- /.content-wrapper -->

<div class="modal fade" id="modal-matriculas">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">INFORMACIÓN DE LA MATRICULA</h4>
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
