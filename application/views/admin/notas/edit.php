<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>
			NOTAS POR CURSO
			<small>Editar</small>
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
						<form action="<?php echo base_url(); ?>matriculas/Notas/update" method="POST">

							<div class="form-group <?php echo form_error('curso') == true ? 'has-error' : '' ?>">
								<div class="col-md-8">
									<label for="">CURSOS CON NOTAS:</label>
									<div class="input-group">
										<input type="hidden" name="idcurso" id="idcurso" value="<?php echo form_error("idcurso") != false ? set_value("idcurso") : $apertura->curso_id; ?>">
										<input type="hidden" name="idapertura" id="idapertura" value="<?php echo form_error("idapertura") != false ? set_value("idapertura") : $apertura->id; ?>">
										<input type="text" size="150%" class="form-control" name="apertura" id="apertura" readonly value="<?php echo form_error("curso") != false ? set_value("curso") : $apertura->curso . " - " . $apertura->id; ?>">
									</div>
									<?php echo form_error("curso", "<span class='help-block'>", "</span>"); ?>
								</div>
								<div class="form-group col-md-12">
								</div>
								<div class="form-group">
									<div class="col-md-4 <?php echo form_error('grupo') == true ? 'has-error' : '' ?>">
										<label for="">GRUPO :</label>
										<input type="hidden" name="idgrupo" id="idgrupo" value="<?php echo form_error("idgrupo") != false ? set_value("idgrupo") : $apertura->grupo_id; ?>">
										<input type="text" name="grupo" class="form-control" id="grupo" readonly value="<?php echo form_error("grupo") != false ? set_value("grupo") : $apertura->grupo; ?>">
										<?php echo form_error("grupo", "<span class='help-block'>", "</span>"); ?>
									</div>
									<div class="col-md-2 <?php echo form_error('hora_ini') == true ? 'has-error' : '' ?>">
										<label for="">HORA INICIO :</label>
										<input type="text" name="hora_ini" class="form-control" readonly id="hora_ini" value="<?php echo form_error("hora_ini") != false ? set_value("hora_ini") : $apertura->hora_ini; ?>">
										<?php echo form_error("hora_ini", "<span class='help-block'>", "</span>"); ?>
									</div>
									<div class="col-md-2 <?php echo form_error('hora_fin') == true ? 'has-error' : '' ?>">
										<label for="">HORA FIN:</label>
										<input type="text" name="hora_fin" class="form-control" readonly id="hora_fin" value="<?php echo form_error("hora_fin") != false ? set_value("hora_fin") : $apertura->hora_fin; ?>">
										<?php echo form_error("hora_fin", "<span class='help-block'>", "</span>"); ?>
									</div>

									<div class="col-md-2 <?php echo form_error('fecha_ini') == true ? 'has-error' : '' ?>">
										<label for="">FECHA INICIAL:</label>
										<input type="date" name="fecha_ini" class="form-control" readonly id="fecha_ini" value="<?php echo form_error("fecha_ini") != false ? set_value("fecha_ini") : $apertura->fecha_ini; ?>">
										<?php echo form_error("fecha_ini", "<span class='help-block'>", "</span>"); ?>
									</div>
									<div class="col-md-2 <?php echo form_error('fecha_fin') == true ? 'has-error' : '' ?>">
										<label for="">FECHA FINAL:</label>
										<input type="date" name="fecha_fin" class="form-control" readonly id="fecha_fin" value="<?php echo form_error("fecha_fin") != false ? set_value("fecha_fin") : $apertura->fecha_fin; ?>">
										<?php echo form_error("fecha_fin", "<span class='help-block'>", "</span>"); ?>
									</div>


								</div>
								<div class="form-group col-md-12">
								</div>
								<div class="form-group">
									<div class="col-md-6 <?php echo form_error('docente') == true ? 'has-error' : '' ?>">
										<label for="">DOCENTE:</label>
										<div class="input-group">
											<input type="hidden" name="iddocente" id="iddocente" value="<?php echo form_error("iddocente") != false ? set_value("iddocente") : $apertura->docente_id; ?>">
											<input type="text" size="100%" class="form-control" name="docente" id="docente" readonly value="<?php echo form_error("docente") != false ? set_value("docente") : $apertura->docente; ?>">
											<?php echo form_error("docente", "<span class='help-block'>", "</span>"); ?>
										</div>
									</div>
									<div class="col-md-6 <?php echo form_error('aula') == true ? 'has-error' : '' ?>">
										<label for="">AULA / LUGAR :</label>
										<div class="input-group">
											<input type="hidden" name="idaula" id="idaula" value="<?php echo form_error("idaula") != false ? set_value("idaula") : $apertura->aula_id; ?>">
											<input type="text" size="100%" class="form-control" name="aula" id="aula" readonly value="<?php echo form_error("aula") != false ? set_value("aula") : $apertura->aula; ?>">
											<?php echo form_error("aula", "<span class='help-block'>", "</span>"); ?>
										</div>
									</div>
								</div>

								<div class=" form-group col-md-12">
								</div>
								<div class="form-group col-md-12">
								</div>
								<div class="form-group">
									<input type="hidden" id="modules_len">
									<input type="hidden" id="modules_ids">
									<table id="example1" class="table table-bordered table-hover">
										<thead>
											<tr>
												<th style="text-align:center; width: 10%">DNI</th>
												<th style="text-align:center; width: 45%">APELLIDOS Y NOMBRES</th>
												<th style="text-align:center;width: 35%">NOTAS</th>
											</tr>
										</thead>
										<tbody>
											<?php if (!empty($nota)) : ?>
												<?php foreach ($nota as $notas) : ?>
													<tr> 
														<td>
															<?php echo $notas->dni; ?>
														</td>
														<td >
															<?php echo $notas->nombre; ?>
														</td>
														
														<?php if (!empty($jalado)) : ?>
														<td style="text-align:center;">
															<?php foreach ($jalado as $jalados) : ?>
															
																<?php if ($notas->idpre == $jalados->idpre) : ?>
																
																	<input type="hidden" name="idnota[]"  value="<?php echo $jalados->idnota ?>" style="width:42px;border:1px solid gray; border-radius:4px; margin-right: 3px" >
																	<input type="number" name="nota[]" value="<?php echo $jalados->nota ?>" min="0" max="20"  style="width:42px;border:1px solid gray; border-radius:4px; margin-right: 3px ;text-align:center;" title="<?php echo $jalados->abreviatura; ?>">
																	
																<?php endif; ?>
																
															<?php endforeach; ?>
															
														<?php endif; ?>
														</td>
													</tr>

												<?php endforeach; ?>
											<?php endif; ?>
										</tbody>

									</table>

								</div>


								<div class="form-group col-md-12">
								</div>
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
