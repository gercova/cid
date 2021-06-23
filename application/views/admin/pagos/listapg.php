<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>
			REPORTE
			<small>PAGO POR GRUPO</small>
		</h1>
	</section>
	<!-- Main content -->
	<section class="content">
		<!-- Default box -->
		<div class="box box-solid">
			<div class="box-body">
				<div class="row">
					<div class="col-md-14">
						<form action="<?php echo current_url(); ?>" method="POST">
							<div class="form-group ">

								<label for="" class="col-md-2 control-label">Lista de Cursos: </label>
								<div class="col-md-5">
									<input type="hidden" name="idapertura" id="idapertura" value="<?php echo set_value("idapertura"); ?>">
									<input type="text" size="180%" class="form-control" name="informacion" id="informacion" readonly data-toggle="modal" data-target="#modal-curdeuda" value="<?php echo set_value("informacion"); ?>">
								</div>
								<div class="col-md-3">
									<input type="submit" name="buscar" value="Buscar" class="btn btn-primary">
									<a href="<?php echo base_url(); ?>reportes/pagogrupos" class="btn btn-danger">Restablecer</a>
								</div>

							</div>
						</form>
					</div>
				</div>
				<hr>
				<div class="row">
					<div class="table-responsive col-md-12">
						<table id="example" class="table table-bordered table-hover ">
							<thead>
								<tr>	
									<th class="text-center">#</th>
									<th class="text-center">DNI</th>
									<th class="text-center" width="30%">ESTUDIANTE</th>
									<th class="text-center" width="30%">CURSO</th>
									<th class="text-center">MONTO</th>
									<th class="text-center">Ver</th>
								</tr>
							</thead>
							<tbody>
								<?php 
									$cont = 0;
									$suma = 0;
									if (!empty($pagos)) : ?>
									<?php foreach ($pagos as $pago) : ?>
										<tr>
										<td class="text-center"><?php $cont = $cont + 1;
																			echo $cont; ?></td>
											<td><?php $pago->id;
														$pago->prematricula_id;
														echo $pago->dni; ?></td>
											<td class="text-justify"><?php echo $pago->nombre; ?></td>
											<td class="text-justify"><?php echo $pago->ape." - ".$pago->curso; ?> </td>
											<td class="text-right"><?php echo $pago->monto; $suma = $suma + $pago->monto; ?></td>
											<?php $datapago = $pago->id . "*" . $pago->prematricula_id; ?>
											<td>
												<div class="btn-group">
													<button type="button" class="btn btn-info btn-view-pagos" data-toggle="modal" data-target="#modal-pagos" value="<?php echo $pago->prematricula_id; ?>">
														<span class="fa fa-search"></span>
													</button>

												</div>
											</td>
										</tr>
									<?php endforeach; ?>
								<?php endif; ?>
							</tbody>
							<tfoot>
								<tr>
									<td colspan="5" class="text-right"><strong>TOTAL :</strong></td>
									<td class="text-right"><strong> <?php echo $suma; ?></strong></td>
								</tr>
							</tfoot>
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


<div class="modal fade bd-example-modal-lg" id="modal-curdeuda">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">LISTA</h4>
			</div>
			<div class="modal-body">
				<table id="example1" class="table table-bordered table-striped table-hover">
					<thead>
						<tr>
							<th>#</th>
							<th>CURSO</th>	
							<th>OPCIÓN</th>
						</tr>
					</thead>
					<tbody>
						<?php if (!empty($curaperturados)) : ?>
							<?php foreach ($curaperturados as $curaperturado) : ?>
								<tr>
									<td><?php echo $curaperturado->id; ?></td>
									<td><?php echo $curaperturado->curso; ?></td>
									
									<?php $datacuraperturado = $curaperturado->id . "*" . $curaperturado->curso ;?>
									<td>
										<button type="button" class="btn btn-success btn-curdeuda" value="<?php echo $datacuraperturado; ?>"><span class="fa fa-check"></span></button>
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
