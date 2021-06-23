<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>
			CERTIFICADOS
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
							<a href="<?php echo base_url(); ?>matriculas/certificados/add" class="btn btn-primary btn-flat"><span class="fa fa-plus"></span> Agregar Certificado</a>
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
									<th>DNI</th>
									<th>ALUMNO</th>
									<th>MODALIDAD</th>
									<th width="30%">CURSO / EVENTO</th>
									<th>FOLIO</th>
									<th>CORRE</th>
									<th>OPCIÓN</th>
								</tr>
							</thead>
							<tbody>
								<?php if (!empty($certificados)) : ?>
									<?php foreach ($certificados as $certificado) : ?>
										<tr>
											<td> <?php echo $certificado->id; ?> <?php $certificado->pre; ?></td>
											<td><?php echo $certificado->dni; ?> </td>
											<td><?php echo $certificado->estudiante; ?></td>
											<td><?php echo $certificado->descripcion; ?></td>
											<td><?php echo $certificado->codc." - ".$certificado->curso; ?></td>
											<td><?php echo $certificado->folio; ?></td>
											<td><?php echo $certificado->correlativo; ?><br></td>
											<?php $datcertificado = $certificado->id . "*" . $certificado->dni . "*" . $certificado->estudiante . "*" . $certificado->curso . "*" . $certificado->folio . "*" . $certificado->correlativo; ?>
											<td>
												<div class="btn-group">
													<?php if ($permisos->read == 1) : ?>
														<!-- para permisos  -->
														<a href="<?php echo base_url(); ?>matriculas/certificados/view/<?php echo $certificado->id;?>/<?php echo $certificado->pre; ?>" class="btn btn-info"><span class="fa fa-search"></span></a>
													<?php endif; ?>

													<?php if ($permisos->update == 1) : ?>
														<!-- para permisos  -->
														<a href="<?php echo base_url() ?>matriculas/certificados/edit/<?php echo $certificado->id; ?>" class="btn btn-warning"><span class="fa fa-pencil"></span></a>
													<?php endif; ?>
													<?php if ($permisos->delete == 1) : ?>
														<!-- para permisos  -->
														<a href="<?php echo base_url(); ?>matriculas/certificados/delete/<?php echo $certificado->id;?>/<?php echo $certificado->pre; ?>" class="btn btn-danger btn-remove"><span class="fa fa-remove"></span></a>
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