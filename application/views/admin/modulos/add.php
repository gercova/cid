<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>
			MODULOS
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
						<form action="<?php echo base_url(); ?>mantenimiento/Modulos/store" method="POST" class="form-horizontal">

							<div class="form-group <?php echo form_error('curso') == true ? 'has-error' : '' ?>">
								<div class="col-md-12">
									<label for="">CURSO:</label>
									<div class="input-group">
										<input type="hidden" name="idcurso" id="idcurso">
										<input type="text" placeholder="Clic Buscar Curso" size="100%" data-toggle="modal" data-target="#modal-modulos" class="form-control" name="curso" id="curso" readonly value="<?php echo set_value("curso"); ?>">
										
									</div><!-- /input-group -->
									<?php echo form_error("curso", "<span class='help-block'>", "</span>"); ?>
								</div>
								<!--  <div class="col-md-3">
                                    <label for="">Fecha:</label>
                                    <input type="date" class="form-control" name="fecha" required>
                                </div>-->
							</div>
							<div class="form-group">
								<div class="col-md-6">
									<label for="">MODULO:</label>
									<input type="text" class="form-control" id="modulo">
								</div>
								<div class="col-md-2">
									<label for="">ABREVIATURA (5 LETRAS) :</label>
									<input type="text" class="form-control" id="abreviatura">
								</div>
								<div class="col-md-2">
									<label for="">HORA:</label>
									<input type="text" class="form-control" id="hora">
								</div>
								<div class="col-md-2">
									<label for="">&nbsp;</label>
									<button id="btn-agregar-modulo" type="button" class="btn btn-success btn-flat btn-block"><span class="fa fa-plus"></span> Agregar</button>
								</div>
							</div>
							<table id="tbmodulos" class="table table-bordered table-striped table-hover">
								<thead>
									<tr>
										<th>NOMBRE</th>
										<th>ABREVIATURA</th>
										<th>HORA</th>
										<th></th>
									</tr>
								</thead>
								<tbody>

								</tbody>
							</table>

							<div class="form-group">
								<div class="col-md-12">
									<button type="submit" class="btn btn-success btn-flat">Guardar</button>
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


<div class="modal fade bd-example-modal-lg" id="modal-modulos">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">LISTA DE CURSOS</h4>
			</div>
			<div class="modal-body">
				<table id="example1" class="table table-bordered table-striped table-hover">
					<thead>
						<tr>
							<th>#</th>
							<th width="20%">NOMBRE</th>
							<th width="30%">TIPO</th>
							<th>OPCIÓN</th>
						</tr>
					</thead>
					<tbody>
						<?php if (!empty($cursos)) : ?>
							<?php foreach ($cursos as $curso) : ?>
								<tr>
									<td><?php echo $curso->id; ?></td>
									<td><?php echo $curso->nombre; ?></td>
									<td><?php echo $curso->descripcion; $come=$curso->descripcion." - ".$curso->nombre; ?></td>
									<?php $datacurso = $curso->id . "*" . $come;  ?>
									<td>
										<button type="button" class="btn btn-success btn-modulos" value="<?php echo $datacurso; ?>"><span class="fa fa-check"></span></button>
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
