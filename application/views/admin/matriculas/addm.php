
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
        APERTURA DE CURSO
        <small>Modificar</small>
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
                        <form action="<?php echo base_url('matriculas/Matriculas/storem');?>" method="POST" >

                        <div class="form-group">
                                <div class="col-md-12">
                                    <label for="">CURSO APERTURADO:</label>
                                        <div class="input-group">
                                        <input type="hidden" name="idapertura" id="idapertura" value="<?php echo set_value("idapertura");?>">
                                        <input type="text" size="150%" placeholder="Clic Buscar Curso Aperturado" class="form-control" name="apertura" id="apertura" readonly data-toggle="modal" data-target="#modal-inicurso" value="<?php echo set_value("apertura");?>" required>
                                    </div><!-- /input-group -->
                                </div> 
							</div>
							<br> 
                            <div class="form-group">
                                <div class="col-md-2">
									<label for="">&nbsp;</label>
							        <button id="btn-consultarmod" type="button" class="btn btn-primary  "><span class="fa fa-search"></span> Consultar Curso  </button>
                                </div>
                            </div>
                                <div class="form-group col-md-12">           
                            </div>
                            <div class="form-group">
                                <div class="col-md-6">
                                    <label for="">DOCENTE:</label>
                                        <div class="input-group">
                                        <input type="hidden" name="iddocente" id="iddocente" value="<?php echo set_value("iddocente");?>">
                                        <input type="text" size="150%" placeholder="Buscar Docente" class="form-control" name="docente" id="docente" readonly value="<?php echo set_value("docente");?>" required>
                                    </div><!-- /input-group -->
                                </div> 
                            </div>
                            <div class="form-group">
                                <div class="col-md-6">
                                    <label for="">AULA / LUGAR :</label>
                                    <div class="input-group">
                                        <input type="hidden" name="idaula" id="idaula" value="<?php echo set_value("idaula");?>">
                                        <input type="text" size="150%" placeholder="Buscar Aula" class="form-control" name="aula" id="aula" readonly  value="<?php echo set_value("aula");?>">
                                    </div>
                                </div><!-- /input-group -->
                            </div> 
                            <div class="form-group col-md-12">           
                            </div>                            
                            <div class="form-group">
                                <div class="col-md-3">
                                    <label for="">FECHA INICIAL :</label>
                                    <input type="date" name="fecha_ini" readonly class="form-control" id="fecha_ini" value="<?php echo set_value("fecha_ini");?>" required>
                                </div>
                                <div class="col-md-3">
                                    <label for="">FECHA FINAL :</label>
                                    <input type="date" name="fecha_fin" readonly class="form-control" id="fecha_fin" value="<?php echo set_value("fecha_fin");?>" required>
                                </div>
                            </div>
                            <div class="form-group col-md-12">           
                            </div>  
                            <div class="form-group">
                                <div class="col-md-2">
                                    <label for="">&nbsp;</label>
                                    <button id="btn-agregar-alumno" type="button" class="btn btn-success btn-flat btn-block"><span class="fa fa-plus"></span> Alumnos </button>
                                </div>

                            </div>
                              <div class="form-group col-md-12">           
                            </div>
                            <div class="form-group">
                                <table id="table_id" class="display">
                                    <thead>
                                        <tr>
                                            <th>DNI</th>
                                            <th>APELLIDOS Y NOMBRES</th>
                                            <th>EVE</th>
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
<div class="modal fade bd-example-modal-lg" id="modal-inicurso">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">LiSTADO DE CURSOS APERTURADOS</h4>
            </div>
            <div class="modal-body">
                <table id="example5" class="table table-bordered table-striped table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>CURSO</th>
                            <th>GRUPO</th>
                            <th>HORA INICIO</th>
                            <th>HORA FIN</th>
                            <th>OPCIÓN</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(!empty($aperturas)):?>
                            <?php foreach($aperturas as $apertura):?>
                                <tr>
                                    <td><?php echo $apertura->id;?></td>
                                    <td><?php echo $apertura->curso;?></td>
                                    <td><?php echo $apertura->grupo;?></td>
                                    <td><?php echo $apertura->hora_ini;?></td>
                                    <td><?php echo $apertura->hora_fin;?></td>
                                    <?php $dataapertura = $apertura->id."*".$apertura->curso."*".$apertura->grupo."*".$apertura->hora_ini."*".$apertura->hora_fin."*".$apertura->docente_id."*".$apertura->aula_id."*".$apertura->fecha_ini."*".$apertura->fecha_fin;?>
                                    <td>
                                        <button type="button" class="btn btn-success btn-inicurso" value="<?php echo $dataapertura;?>"><span class="fa fa-check"></span></button>
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
<div class="modal fade bd-example-modal-lg" id="modal-docente">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">LISTA DE DOCENTES</h4>
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
                        <?php if(!empty($docentes)):?>
                            <?php foreach($docentes as $docente):?>
                                <tr>
                                    <td><?php echo $docente->id;?></td>
                                    <td><?php echo $docente->nombre;?></td>
                                    <td><?php echo $docente->num_documento;?></td>
                                    <?php $datadocente = $docente->id."*".$docente->nombre;?>
                                    <td>
                                        <button type="button" class="btn btn-success btn-docente" value="<?php echo $datadocente;?>"><span class="fa fa-check"></span></button>
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
<div class="modal fade bd-example-modal-lg" id="modal-aula">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">LISTA DE AULAS DISPONIBLES</h4>
            </div>
            <div class="modal-body">
                <table id="example2" class="table table-bordered table-striped table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>NOMBRE</th>
                            <th>OPCIÓN</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(!empty($aulas)):?>
                            <?php foreach($aulas as $aula):?>
                                <tr>
                                    <td><?php echo $aula->id;?></td>
                                    <td><?php echo $aula->nombre;?></td>
                                    <?php $dataaula = $aula->id."*".$aula->nombre;?>
                                    <td>
                                        <button type="button" class="btn btn-success btn-aula" value="<?php echo $dataaula;?>"><span class="fa fa-check"></span></button>
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