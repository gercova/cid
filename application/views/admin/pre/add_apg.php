<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>
			Apertura Curso
			<small>Nuevo</small>
		</h1>
	</section>
	<!-- Main content -->
	<section class="content">
		<!-- Default box -->
		<div class="box box-solid">
			<div class="box-body">
				<div class="row">
					<div class="col-md-12">
						<?php if ($this->session->flashdata("error")) : ?>
							<div class="alert alert-danger alert-dismissible">
								<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
								<p><i class="icon fa fa-ban"></i><?php echo $this->session->flashdata("error"); ?></p>
							</div>
						<?php endif; ?>
						<form action="<?php echo base_url('');?>" method="POST">
							<div class="form-group">
								<div class="col-md-6">
									<label for="">CURSO:</label>
									<input type="hidden" name="idcurso" id="idcurso" value="<?php echo set_value("idcurso"); ?>">
									<input type="text" size="100%"class="form-control" data-toggle="modal" data-target="#modal-curso" name="curso" id="curso" readonly value="<?php echo set_value("curso"); ?>">
								</div>
							</div>

							<div class="form-group">
								<div class="col-md-6">
									<label for="">GRUPO CLASE:</label>
									<input type="hidden" name="idgrupo" id="idgrupo" value="<?php echo set_value("idgrupo"); ?>">
									<input type="text" class="form-control" data-toggle="modal" data-target="#modal-grupo" size="100%" name="grupo" id="grupo" readonly value="<?php echo set_value("grupo"); ?>">
								</div>
								<div class="row"></div>
								<div class="form-group">
									<div class="col-md-12">
										<button type="submit" class="btn btn-success btn-flat">Guardar</button>
									</div>
								</div>
							</div>
						</form>
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
<div class="modal fade bd-example-modal-lg" id="modal-curso">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">Lita de Cursos</h4>
			</div>
			<div class="modal-body">
				<table id="example1" class="table table-bordered table-striped table-hover">
					<thead>
						<tr>
							<th>#</th>
							<th>NOMBRE</th>
							<th>OPCIÓN</th>
						</tr>
					</thead>
					<tbody>
						<?php if (!empty($cursos)) : ?>
							<?php foreach ($cursos as $c) : ?>
								<tr>
									<td><?php echo $c->id; ?></td>
									<td><?php echo $c->descripcion; ?></td>
									<?php $datacurso = $curso->id . "*" . $come . "*" . $curso->costo; ?>
									<td>
										<button type="button" class="btn btn-success btn-cursoape" value="<?php echo $datacurso;?>"><span class="fa fa-check"></span></button>
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

<div class="modal fade bd-example-modal-lg" id="modal-grupo">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">LISTADO DE GRUPOS</h4>
			</div>
			<div class="modal-body">
				<table id="example2" class="table table-bordered table-striped table-hover">
					<thead>
						<tr>
							<th>#</th>
							<th>DESCRIPCIÓN</th>
							<th>HORA INICIO</th>
							<th>HORA FIN</th>
							<th>OPCIÓN</th>
						</tr>
					</thead>
					<tbody>
						<?php if (!empty($dias)) : ?>
							<?php foreach ($dias as $d) : ?>
								<tr>
									<td><?php echo $d->id; ?></td>
									<td><?php echo $d->descripcion; ?></td>
									<td><?php echo $d->hora_ini; ?></td>
									<td><?php echo $d->hora_fin; ?></td>
									<?php $datagrupo = $d->id."*".$d->descripcion."*".$d->hora_ini."*".$d->hora_fin;?>
									<td>
										<button type="button" class="btn btn-success btn-grupoape" value="<?php echo $datagrupo; ?>"><span class="fa fa-check"></span></button>
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