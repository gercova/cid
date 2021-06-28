<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>
			Matrícula 
			<small>Nueva</small>
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
					</div>
						<?php endif; ?>
						<form action="<?php echo base_url('pre/store'); ?>" method="POST">
							<div class="form-group">
                            	<div class="col-md-3">                        
                                	<label for="">DNI / RUC :</label>
									<div class="input-group">
										<input type="hidden" name="idestudiante" id="idestudiante" value="<?php echo set_value("idestudiante");?>">
										<input type="text" autocomplete="off" size="8" placeholder="DNI" class="form-control" name="dni" id="dni" value="<?php echo set_value("dni") ;?>">
										<span class="input-group-btn">
											<button id="btn-buscarestu" type="button" class="btn btn-primary"><span class="fa fa-search"></span> BUSCAR </button>
										</span>
									</div>
                            	</div>
							</div>
							<div class="form-group">
								<div class="col-md-5">                        
									<label for="">ESTUDIANTE :</label>
									<div class="input-group">
										<input type="text" size="0%" class="form-control" name="estudiante" id="estudiante" readonly  value="<?php echo set_value("estudiante") ;?>">
										<span class="input-group-btn">                              
											<a href="<?php echo base_url('mantenimiento/estudiantes/addpre');?>" class="btn btn-success btn-flat btn-block"><span class="fa fa-plus"></span> Nuevo</a>
										</span>
									</div>
								</div>
							</div>
							<div class="form-group">
								<div class="col-md-4">
									<label for="">TIPO PERSONA :</label>
									<div class="input-group">
										<select class="form-control" name="tipo" id="tipo" required>
											<option value="">-- Selecciona tipo --</option>
											<?php foreach ($tipos as $t): ?>
												<option value="<?php echo $t->id;?>"><?php echo $t->descripcion;?></option>
											<?php endforeach ?>
										</select>
									</div>
								</div>
							</div>
							<div class="form-group">
								<div class="col-md-4">
									<label for="">CICLO :</label>
									<div class="input-group">
										<select class="form-control" name="ciclo" id="ciclo" required>
											<option value="">-- Selecciona ciclo del estudiante --</option>
											<?php foreach ($ciclos as $c): ?>
												<option value="<?php echo $c->id;?>"><?php echo $c->descripcion;?></option>
											<?php endforeach ?>
										</select>
									</div>
								</div>
							</div>
							<div class="form-group">
								<div class="col-md-4">
									<label for="">CICLO :</label>
									<div class="input-group">
										<select class="form-control" name="ciclo" id="ciclo" required>
											<option value="">-- Selecciona ciclo del estudiante --</option>
											<?php foreach ($niveles as $n): ?>
												<option value="<?php echo $n->id;?>"><?php echo $n->descripcion;?></option>
											<?php endforeach ?>
										</select>
									</div>
								</div>
							</div>
                            <div class="form-group">
								<div class="col-md-4">
									<label for="">CICLO :</label>
									<div class="input-group">
										<select class="form-control" name="dias" id="dias" required>
											<option value="">-- Selecciona día --</option>
											<?php foreach ($dias as $d): ?>
												<option value="<?php echo $n->id;?>"><?php echo $n->descripcion;?></option>
											<?php endforeach ?>
										</select>
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
<div class="modal fade bd-example-modal-lg" id="modal-estudiante">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Lista de Estudiantes</h4>
            </div>
            <div class="modal-body">
                <table id="example1" class="table table-bordered table-striped table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>APELLIDOS Y NOMBRES</th>
                            <th>DNI</th>
                            <th>OPCIÓN</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(!empty($estudiantes)):?>
                            <?php foreach($estudiantes as $estudiante):?>
                                <tr>
                                    <td><?php echo $estudiante->id;?></td>
                                    <td><?php echo $estudiante->nombre;?></td>
                                    <td><?php echo $estudiante->num_documento;?></td>
                                    <?php $dataestudiante = $estudiante->id."*".$estudiante->nombre;?>
                                    <td>
                                        <button type="button" class="btn btn-success btn-estupre" value="<?php echo $dataestudiante;?>"><span class="fa fa-check"></span></button>
                                    </td>
                                </tr>
                            <?php endforeach;?>
                        <?php endif;?>
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