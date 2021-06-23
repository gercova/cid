
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
   
    <!-- Main content -->
    <section class="content">
      <!-- Default box -->
	  <div id="listado">
        </div>
        <!-- /.box -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<!--Modal para CRUD-->
<div class="modal fade" id="modalCRUD" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header modal-header-color">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>           
                </button>
                <h4 class="modal-title modal-title-titulo" id="exampleModalLabel"></h4>
            </div>
        <form id="form_modulos"> 
            <div class="modal-body" >
              <div class="form-group row">
                <input type="hidden" id="idcurso" name="idcurso" value="">
                <div class="col-lg-8">
                    <label for="descripcion" class="labelfor">Nombre del Curso:</label>
                    <input class="grandes" type="text" name="curso" id="curso" placeholder="Ingrese el Curso" size="100%"  class="form-control" readonly required >
                </div>
                <div class="col-lg-2">
                    <label for="descripcion" class="labelfor">&nbsp;</label>
    				<button type="button" class="btn btn-primary" id="agregar_curso" data-toggle="modal" data-target="#modal-cursos">
    				    <span class="fa fa-plus"></span>
                        <span class="hidden-xs"> Agregar</span> 
    				</button>
                </div>
              </div>
              <div class="form-group row" >
                  <div class="col-lg-5">
                    <label for="modulo" class="labelfor">Nombre de Modulo:</label>
                    <input class="grandes" type="text" name="modulo" id="modulo" >
                  </div>
                  <div class="col-lg-2">
                    <label for="abreviatura" class="labelfor">Abreviatura:</label>
                    <input class="grandes" type="text" name="abreviatura" id="abreviatura" >
                  </div>
                  <div class="col-lg-2">
                    <label for="hora" class="labelfor">Horas:</label>
                    <input class="grandes" type="text" name="hora" id="hora" >
                  </div>
                  <div class="col-lg-1">
                    <label for="descripcion" class="labelfor">&nbsp;</label>
    				<button type="button" class="btn btn-primary" id="agregar_modulo" >
    				    <span class="fa fa-plus"></span>
                        <span class="hidden-xs"> Agregar</span> 
    				</button>
    			</div>
              </div>
                <table id="tbmodulos" class="table table-bordered table-striped table-hover">
					<thead>
						<tr>
						    <th style="width:60%; text-align:center">NOMBRE</th>
							<th style=" width:20%; text-align:center">ABREVIATURA</th>
							<th style=" width:20%;text-align:center">HORA</th>
							<th></th>
							</tr>
					</thead>
					<tbody>
					</tbody>
				</table>
				<!-- 
                <table id="tbmodulo" class="table table-bordered table-striped table-hover">
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
            </div>
           --> 
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                <input type="submit" class="btn btn-success" value="Guardar" />
                <!-- <button type="button" id="btnGuardar" >Guardar</button> -->
				
            </div>
        </form>    
        </div>
    </div>
</div>  

<div class="modal fade bd-example-modal-lg" id="modal-cursos">
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
							<th>ID</th>
							<th width="50%">CURSO</th>
                            <th width="20%">CICLO</th>
                            <th width="20%">NIVEL</th>
							<th width="10%">COSTO</th>
							<th>OPCIÓN</th>
						</tr>
					</thead>
					<tbody>
						<?php if (!empty($cursos)) : ?>
							<?php foreach ($cursos as $curso) : ?>
								<tr>
									<td><?php echo $curso->id; ?></td>
									<td><?php echo $curso->descripcion; ?></td>
                                    <td><?php echo $curso->ciclo; ?></td>
                                    <td><?php echo $curso->nivel; ?></td>
                                    <td><?php echo $curso->costo; $come=$curso->descripcion." - ".$curso->ciclo. " - ".$curso->nivel;?></td>
									
									<?php $datacurso = $curso->id . "*" . $come;  ?>
									<td>
										<button type="button" class="btn btn-success btn-cursos" value="<?php echo $datacurso; ?>"><span class="fa fa-check"></span></button>
									</td>
								</tr>
							<?php endforeach; ?>
						<?php endif; ?>
					</tbody>
				</table>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-danger " data-dismiss="modal">Cerrar</button>
			</div>
		</div>
		<!-- /.modal-content -->
	</div>
	<!-- /.modal-dialog -->
</div>
<!-- /.modal -->