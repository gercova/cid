
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
						<th>Fecha</th>
						<th>Curso</th>
						<th>Interesado</th>
						<th>Correo</th>
						<th>Opciones</th>
					</tr>
					</thead>
					<tbody>
					<?php if (!empty($data)) : ?>
						<?php foreach ($data as $row) : ?>
							<tr>
								<td><?php echo $row->solicitud_apertura_id; ?></td>
								<td><?php echo $row->fecha_server; ?></td>
								<td><?php echo $row->curso_nombre; ?></td>
								<td><?php echo $row->solicitud_persona; ?></td>
								<td><?php echo $row->solicitud_correo; ?></td>
								<td>
									<div class="btn-group">
										<button type="button" class="btn btn-info btn-view-info" data-toggle="modal" data-target="#modal-info" value="<?php echo $row->solicitud_apertura_id; ?>">
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
	