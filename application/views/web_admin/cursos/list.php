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
						<th>Codigo</th>
						<th>Nombre</th>
						<th>Descripcion</th>
						<th>Imagen</th>
						<th>opciones</th>
						<th>Web</th>
					</tr>
					</thead>
					<tbody>
					<?php if (!empty($data)) : ?>
						<?php foreach ($data as $row) : ?>
							<tr>
								<td><?php echo $row->curso_id; ?></td>
								<td><?php echo $row->codigo_curso; ?></td>
								<td><?php echo $row->nombre_curso; ?></td>
								<td><?php echo $row->descripcion_curso; ?></td>
								<td><img style="width: 60%" class="card-img-top" src="<?= $upload_path.$row->imagen_curso ?>" alt="Imagen de <?=$row->nombre_curso?>">
								</td>
								<td style="min-width: 112px;">
									<?php getBtnsPermited($permisos, $controlador, $row->curso_id) ?>
								</td>
								<td>
									<a href="<?php echo base_url($controlador.'editCursoDet/'.$row->curso_id);?>" class="btn btn-success btn-remove"><span class="fa fa-book"></span></a>
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