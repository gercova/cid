
<input type="hidden" id="controlador_mantenimiento" value="<?= $controlador ?>">

<!-- Default box -->
<div class="box box-solid">
	<div class="box-body">
		
		<div class="row">
			<div class="table-responsive col-md-12">
				<table id="data_table" class="table table-bordered table-hover">
					<thead>
					<tr>
						<th>Id</th>
						<th>Registro</th>
						<th>Curso</th>
						<th>Horario</th>
						<th>Estudiante</th>
						<th>Monto</th>
						<th>Opciones</th>
					</tr>
					</thead>
					<tbody>
					<?php if (!empty($data)) : ?>
						<?php foreach ($data as $row) : ?>
							<tr>
								<td><?php echo $row->id_pago; ?></td>
								<td><?php echo $row->fecha_registro; ?></td>
								<td><?php echo $row->curso_nombre; ?></td>
								<td><?php echo $row->dias." ".$row->hora_inicio." - ".$row->hora_fin; ?></td>
								<td><?php echo $row->estudiante_nombre; ?></td>
								<td><?php echo $row->monto; ?></td>
								<td>
									<div class="btn-group">
										<button type="button" class="btn btn-info btn-view-info" data-toggle="modal" data-target="#modal-info" value="<?php echo $row->id_pago; ?>">
											<span class="fa fa-search"></span>
										</button>										
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
	