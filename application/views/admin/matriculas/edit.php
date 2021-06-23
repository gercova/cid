
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
        APERTURA DE CURSOS
        <small>Edit</small>
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
                        <form action="<?php echo base_url();?>matriculas/matriculas/update" method="POST" >

                            <div class="form-group <?php echo form_error('apertura') == true ? 'has-error':''?>">
                                <div class="col-md-12">
                                    <label for="">CURSO APERTURADOS:</label>
                                        <div class="input-group">
                                        <input type="hidden" name="idapertura" id="idapertura" value="<?php echo form_error("idapertura") !=false ? set_value("idapertura") : $matricula->id;?>">
                                        <input type="text" size="150%" placeholder="Clic Buscar Curso Aperturado" class="form-control" name="apertura" id="apertura" readonly  value="<?php echo form_error("apertura") !=false ? set_value("apertura") : $matricula->curso." - ".$matricula->id. " :::: GRUPO : ".$matricula->grupo." :::: HORARIO: ".$matricula->hora_ini." A ".$matricula->hora_fin;?>">
                                        <!-- <span class="input-group-btn">
                                            <button class="btn btn-primary" type="button" data-toggle="modal" data-target="#modal-cur-gru-pre" ><span class="fa fa-search"></span> Buscar</button>
                                        </span> -->
                                    </div><!-- /input-group -->
                                    <?php echo form_error("apertura","<span class='help-block'>","</span>");?>
                                </div> 
                            </div>
                            <div class="form-group <?php echo form_error('docente') == true ? 'has-error':''?>">
                                <div class="col-md-6">
                                    <label for="">DOCENTE:</label>
                                        <div class="input-group">
                                        <input type="hidden" name="iddocente" id="iddocente" value="<?php echo form_error("iddocente") !=false ? set_value("iddocente") : $matricula->docente_id;?>">
                                        <input type="text" size="150%" placeholder="Clic Buscar Docente" class="form-control" name="docente" id="docente" readonly data-toggle="modal" data-target="#modal-docente" value="<?php echo form_error("docente") !=false ? set_value("docente") : $matricula->docente;?>">

                                    </div><!-- /input-group -->
                                    <?php echo form_error("docente","<span class='help-block'>","</span>");?>
                                </div> 
                            </div>

                            <div class="form-group <?php echo form_error('aula') == true ? 'has-error':''?>">
                                <div class="col-md-6">
                                    <label for="">AULA / LUGAR :</label>
                                        <div class="input-group">
                                        <input type="hidden" name="idaula" id="idaula" value="<?php echo form_error("idaula") !=false ? set_value("idaula") : $matricula->aula_id;?>">
                                        <input type="text" size="150%" placeholder="Clic Buscar Aula" class="form-control" name="aula" id="aula" readonly data-toggle="modal" data-target="#modal-aula" value="<?php echo form_error("aula") !=false ? set_value("aula") : $matricula->aula;?>">
                                    </div><!-- /input-group -->
                                    <?php echo form_error("aula","<span class='help-block'>","</span>");?>
                                </div> 

                        
                        <div class="form-group <?php echo form_error('curso') == true ? 'has-error':''?>">
                     
                            <div class="form-group">
                                <div class="col-md-3 <?php echo form_error('fecha_ini') == true ? 'has-error':''?>">
                                    <label for="">FECHA INCIAL:</label>
                                    <input type="date" name="fecha_ini" class="form-control" id="fecha_ini" value="<?php echo form_error("fecha_ini") !=false ? set_value("fecha_ini") : $matricula->fecha_ini;?>" >
                                    <?php echo form_error("fecha_ini","<span class='help-block'>","</span>");?>
                                </div>
                                <div class="col-md-3 <?php echo form_error('fecha_fin') == true ? 'has-error':''?>">
                                    <label for="">FECHA FINAL :</label>
                                    <input type="date" name="fecha_fin" class="form-control" id="fecha_fin" value="<?php echo form_error("fecha_fin") !=false ? set_value("fecha_fin") :$matricula->fecha_fin;?>">
                                    <?php echo form_error("fecha_fin","<span class='help-block'>","</span>");?>
                                </div>
                            <div class="form-group col-md-12">           
                            </div>
                                <div class="form-group">
                               
                                <div class="col-md-2">
                                    <label for="">&nbsp;</label>
                                    <button id="btn-agregar-alumno" type="button" disabled class="btn btn-success btn-flat btn-block"><span class="fa fa-plus"></span> Alumnos </button>
                                </div>

                            </div>
                              <div class="form-group col-md-12">           
                            </div>
                            <div class="form-group">
                                <table id="example1" class="table table-bordered table-hover">
                                    <thead>
                                    <tr>	
										
                                            <th>DNI</th>
                                            <th>APELLIDOS Y NOMBRES</th>
                                            
                                            <th>EVE</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if(!empty($prematriculado)):?>
                                            <?php foreach($prematriculado as $prematriculados):;?>
                                                
                                                    <td><input type="hidden" class="form-control" name="idapcu[]" value="<?php echo $prematriculados->id;?>"><?php echo $prematriculados->dni;?></td>
                                                    <td> <?php echo $prematriculados->nombre;?></td>
                                                    
                                                    <td><a href="<?php echo base_url();?>matriculas/matriculas/deletelista/<?php echo $prematriculados->id;?>" class="btn btn-danger btn-remove"><span class="fa fa-remove"></span></a></td>
                                                </tr>
                                            <?php endforeach;?>
                                        <?php endif;?>
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


<div class="modal fade bd-example-modal-lg" id="modal-apertura">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">LISTA DE CURSOS APERTURADOS</h4>
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
                                    <?php $dataapertura = $apertura->id."*".$apertura->curso."*".$apertura->grupo."*".$apertura->hora_ini."*".$apertura->hora_fin;?>
                                    <td>
                                        <button type="button" class="btn btn-success btn-apertura" value="<?php echo $dataapertura;?>"><span class="fa fa-check"></span></button>
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
                <h4 class="modal-title">LISTA DOCENTES</h4>
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
                            <th>NOMBRES</th>
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