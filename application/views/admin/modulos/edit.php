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
						<form action="<?php echo base_url(); ?>mantenimiento/Modulos/update" method="POST" class="form-horizontal">

							<div class="form-group <?php echo form_error('curso') == true ? 'has-error' : '' ?>">
								<div class="col-md-6">
									<label for="">CURSO:</label>
									<div class="input-group">
										<input type="hidden" name="idcurso" id="idcurso" value="<?php echo $curso->id; ?>">
										<input type="text" class="form-control" size="100%"name="curso" id="curso" readonly value="<?php echo $curso->descripcion;?> - <?php echo $curso->nombre;?>">
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
									<input type="text" class="form-control" id="modulo" disabled>
								</div>
								<div class="col-md-3">
									<label for="">ABREVIATURA (5 LETRAS):</label>
									<input type="text" class="form-control" id="abreviatura" disabled>
								</div>
								<div class="col-md-3">
									<label for="">HORA:</label>
									<input type="text" class="form-control" id="hora" disabled>
								</div>
								<div class="col-md-2">
									<label for="">&nbsp;</label>
									<button id="btn-agregar-modulo" type="button" disabled class="btn btn-success btn-flat btn-block"><span class="fa fa-plus"></span> Agregar</button>
								</div>
							</div>
							<table id="tbmodulos" class="table table-bordered table-striped table-hover">
								<thead>
									<tr>
										<th>ID</th>
										<th>NOMBRE</th>
										<th>ABREVIATURA</th>
										<th>HORA</th>

									</tr>

								</thead>
								<tbody>
									<?php if (!empty($modulo)) : ?>
										<?php foreach ($modulo as $modulos) : ?>
											<tr>
												<td><input type="hidden" class="form-control" name="idmodulo[]" value="<?php echo $modulos->id; ?>"><label class="form-control"> <?php echo $modulos->id; ?></label></td>
												<td><input type="text" class="form-control" name="nombremodulo[]" value="<?php echo $modulos->nombre; ?>"></td>
												<td><input type="text" class="form-control" name="abreviaturamodulo[]" value="<?php echo $modulos->abreviatura; ?>"></td>
												<td><input type="text" class="form-control" name="horamodulo[]" value="<?php echo $modulos->hora; ?>"></td>
											</tr>
										<?php endforeach; ?>
									<?php endif; ?>
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
