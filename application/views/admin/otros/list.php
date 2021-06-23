<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>
			PAGOS
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
							<a href="<?php echo base_url(); ?>movimientos/pagos/add" class="btn btn-primary btn-flat"><span class="fa fa-plus"></span> Agregar Pagos</a>
						<?php endif; ?>
					</div>
				</div>
				<hr>
				<div class="row">
					<div class="table-responsive col-md-12">
						<table id="example1" class="table table-bordered table-hover ">
							<thead>
								<tr>
									<th class="text-center">DNI</th>
									<th class="text-center">ESTUDIANTE</th>
									<th  width="20%">CURSO</th>
									<th class="text-center">GRUPO</th>
									<th class="text-center">FECHA</th>
									<th class="text-center">MONTO</th>
									<th class="text-center">OPCIÓN</th>
								</tr>
							</thead>
							<tbody>
								<?php if (!empty($pagos)) : ?>
									<?php foreach ($pagos as $pago) : ?>
										<tr>
											<td><?php $pago->id;
														$pago->prematricula_id;
														echo $pago->dni; ?></td>
											<td class="text-justify"><?php echo $pago->nombre; ?></td>
											<td class="text-justify"><?php echo $pago->ape." - ".$pago->curso; ?> </td>
											<td><?php echo $pago->grupo; ?></td>
											<td><?php echo $pago->fecha_pago; ?></td>
											<td><?php echo $pago->monto; ?></td>
											<?php $datapago = $pago->id . "*" . $pago->prematricula_id; ?>
											<td>
												<div class="btn-group">
													<button type="button" class="btn btn-info btn-view-pagos" data-toggle="modal" data-target="#modal-pagos" value="<?php echo $pago->prematricula_id; ?>">
														<span class="fa fa-search"></span>
													</button>
													<?php if ($permisos->update == 1) : ?>
														<a href="<?php echo base_url() ?>movimientos/pagos/edit/<?php echo $pago->id; ?>/<?php echo $pago->prematricula_id; ?>" class="btn btn-warning"><span class="fa fa-pencil"></span></a>
													<?php endif; ?>
													<?php if ($permisos->delete == 1) : ?>
														<!-- <a href="<?php echo base_url(); ?>movimientos/pagos/delete/<?php echo $pago->id; ?>/<?php echo $pago->prematricula_id; ?>" class="btn btn-danger btn-remove"><span class="fa fa-remove"></span></a> -->
														<button class="btn btn-danger btn-remove-gri" value="<?php echo base_url(); ?>movimientos/pagos/delete/<?php echo $pago->id; ?>/<?php echo $pago->prematricula_id; ?>"><span class="fa fa-remove"></span></button>
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

<div class="modal fade" id="modal-pagos">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">INFORMACIÓN DEL PAGO</h4>
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
