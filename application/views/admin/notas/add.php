
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
        NOTAS POR CURSO
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
                        <?php if($this->session->flashdata("error")):?>
                            <div class="alert alert-danger alert-dismissible">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                <p><i class="icon fa fa-ban"></i><?php echo $this->session->flashdata("error"); ?></p>
                             </div>
                        <?php endif;?>
                        <form action="<?php echo base_url();?>matriculas/notas/store" method="POST" >

                            <div class="form-group <?php echo form_error('curso') == true ? 'has-error':''?>">
                                <div class="col-md-8">
                                         <label for="">CURSO CON NOTAS:</label>
                                        <div class="input-group">
											<input type="hidden" name="idcurso" id="idcurso" value="<?php echo set_value("idcurso");?>">
											<input type="hidden" name="idapertura" id="idapertura" value="<?php echo set_value("idapertura");?>">
											<input type="text" size="150%" class="form-control" data-toggle="modal" placeholder="Seleccione Curso"   data-target="#modal-matri-notas" name="apertura" id="apertura" readonly  value="<?php echo set_value("apertura");?>">
                                     	</div>
                                    <?php echo form_error("curso","<span class='help-block'>","</span>");?>
                                </div> 
                            <div class="form-group col-md-12">           
                            </div>                            
                            <div class="form-group">
                                <div class="col-md-4 <?php echo form_error('grupo') == true ? 'has-error':''?>">
                                    <label for="">GRUPO :</label>
                                    <input type="hidden" name="idgrupo" id="idgrupo" value="<?php echo set_value("idgrupo");?>">
                                    <input type="text" name="grupo" class="form-control" id="grupo" readonly value="<?php echo set_value("grupo");?>" >
                                    <?php echo form_error("grupo","<span class='help-block'>","</span>");?>
                                </div>
                                <div class="col-md-2 <?php echo form_error('hora_ini') == true ? 'has-error':''?>">
                                    <label for="">HORA INICIO :</label>
                                    <input type="text" name="hora_ini" class="form-control" readonly id="hora_ini" value="<?php echo set_value("hora_ini");?>">
                                    <?php echo form_error("hora_ini","<span class='help-block'>","</span>");?>
                                </div>
                                <div class="col-md-2 <?php echo form_error('hora_fin') == true ? 'has-error':''?>">
                                    <label for="">HORA FIN:</label>
                                    <input type="text" name="hora_fin" class="form-control" readonly id="hora_fin" value="<?php echo set_value("hora_fin");?>">
                                    <?php echo form_error("hora_fin","<span class='help-block'>","</span>");?>
                                </div>

                                 <div class="col-md-2 <?php echo form_error('fecha_ini') == true ? 'has-error':''?>">
                                    <label for="">FECHA INICIAL :</label>
                                    <input type="date" name="fecha_ini" class="form-control" readonly id="fecha_ini" value="<?php echo set_value("fecha_ini");?>" >
                                    <?php echo form_error("fecha_ini","<span class='help-block'>","</span>");?>
                                </div>
                                <div class="col-md-2 <?php echo form_error('fecha_fin') == true ? 'has-error':''?>">
                                    <label for="">FECHA FINAL:</label>
                                    <input type="date" name="fecha_fin" class="form-control" readonly id="fecha_fin" value="<?php echo set_value("fecha_fin");?>">
                                    <?php echo form_error("fecha_fin","<span class='help-block'>","</span>");?>
                                </div>


                            </div>
                             <div class="form-group col-md-12">           
                            </div>  
							<div class="form-group" >
									<div class="col-md-6 <?php echo form_error('docente') == true ? 'has-error':''?>">
											<label for="">DOCENTE:</label>
												<div class="input-group">
													<input  type="hidden" name="iddocente" id="iddocente" value="<?php echo set_value("idcurso");?>">
													<input type="text" size="100%" class="form-control" name="docente" id="docente" readonly  value="<?php echo set_value("docente");?>">
													<?php echo form_error("docente","<span class='help-block'>","</span>");?>
												</div>									
									</div>
									<div class="col-md-6 <?php echo form_error('aula') == true ? 'has-error':''?>">
											<label for="">AULA / LUGAR :</label>
												<div class="input-group">
													<input type="hidden" name="idaula" id="idaula" value="<?php echo set_value("idaula");?>">
													<input type="text" size="100%" class="form-control" name="aula" id="aula" readonly  value="<?php echo set_value("aula");?>">
													<?php echo form_error("aula","<span class='help-block'>","</span>");?>
													</div>	
									</div> 
								</div>		
							
                            <div class="form-group col-md-12">           
                            </div>

                            <div class="form-group">
                               
                                <div class="col-md-2">
                                    <label for="">&nbsp;</label>
                                    <button id="btn-agregar-notas" type="button" class="btn btn-success btn-flat btn-block"><span class="fa fa-plus"></span> Alumnos </button>
                                </div>

                            </div>
                              <div class="form-group col-md-12">           
                            </div>
                            <div class="form-group">
                                <input type="hidden" id="modules_len">
                                <input type="hidden" id="modules_ids">
                                <table id="table_notas" class="display">
                                    <thead>
                                    <tr>
                                            <th>DNI</th>
                                            <th>APELLIDOS Y NOMBRES</th>
                                            
                                            <th><span id='title_mods'></span></th>
                                        </tr>
                                    </thead>

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




<div class="modal fade bd-example-modal-lg" id="modal-matri-notas">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">LISTA DE CURSO POR DOCENTE</h4>
            </div>
            <div class="modal-body">
                <table id="example1" class="table table-bordered table-striped table-hover">
                    <thead>
                        <tr>
							<th>#</th>
                            <th width="20%">CURSO</th>
                            <th>DOCENTE</th>
                            <th>HORARIO</th>
                            <th>FECHA</th>
                            <th>Opcion</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(!empty($matriculas)):?>
                            <?php foreach($matriculas as $matricula):?>
                                <tr>
									<td><?php echo $matricula->id;?> </td>
                                    <td><?php echo $matricula->curso;?> </td>
                                    <td><?php echo $matricula->docente;?> </td>
                                    <td><?php echo $matricula->hora_ini;?> A <?php echo $matricula->hora_fin;?></td>
                                    <td><?php echo $matricula->fecha_ini;?> A <?php echo $matricula->fecha_fin;?></td>
                                    <?php $datamatricula = $matricula->id."*".$matricula->curso."*".$matricula->grupo_id."*".$matricula->grupo.
                                    "*".$matricula->hora_ini."*".$matricula->hora_fin."*".$matricula->fecha_ini."*".$matricula->fecha_fin.
                                    "*".$matricula->docente_id."*".$matricula->docente."*".$matricula->aula_id."*".$matricula->aula."*".$matricula->curso_id;?>
                                    <td>
                                        <button type="button" class="btn btn-success btn-matri-notas" value="<?php echo $datamatricula;?>"><span class="fa fa-check"></span></button>
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

