<input type="hidden" id="controlador_mantenimiento" value="<?= $controlador ?>">
<!-- Default box -->
<div class="box box-solid">
	<div class="box-body">
		<div class="row">
			<div class="col-md-2 col-xs-12">
				<?php if ($permisos->insert == 1) : ?>
					<!-- para permisos  -->
					<a href="<?php echo base_url($controlador.'add'); ?>" class="btn btn-primary btn-flat"><span class="fa fa-plus"></span> Agregar </a>
				<?php endif; ?>
			</div>

			<div class="col-md-10 col-xs-12">
				<?php $msjType = $this->session->flashdata("error")? "error":"success";
				msjFlashAlert( $this->session->flashdata($msjType), $msjType);?>
			</div>
		</div>
		<hr>
		<div class="row">
			<div class="table-responsive col-md-12">
				<table id="data_table" class="table table-bordered table-hover">
					<thead>
					<tr>
						<th>Id</th>
						<th>Titulo</th>
						<th>Inicio del evento</th>
						<th>Fin del evento</th>
						<th>Creado</th>
						<th>opciones</th>
					</tr>
					</thead>
					<tbody>
					<?php if (!empty($data)) : ?>
						<?php foreach ($data as $row) : ?>
							<tr>
								<td><?php echo $row->evento_id; ?></td>
								<td><?php echo $row->titulo_evento; ?></td>
								<td><?php echo $row->fecha_inicio; ?></td>
								<td><?php echo $row->fecha_fin; ?></td>
								<td><?php echo $row->fecha_creacion; ?></td>
								<td style="min-width: 112px;">
									<?php getBtnsPermited($permisos, $controlador, $row->evento_id) ?>
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