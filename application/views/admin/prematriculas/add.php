
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
        PREMATRICULAS
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
                        <form action="<?php echo base_url('movimientos/prematriculas/store');?>" method="POST" >
                            <div class="form-group ">
                                <div class="col-md-3">                        
                                    <label for="">DNI / RUC :</label>
                                    <div class="input-group">
                                        <input type="hidden" name="idestudiante" id="idestudiante" value="<?php echo set_value("idestudiante");?>">
                                        <input type="text" autocomplete="off" size="8"  placeholder="DNI" class="form-control" name="dni" id="dni"  value="<?php echo set_value("dni");?>">
                                        <span class="input-group-btn">
                                            <button id="btn-buscarestu" type="button" class="btn btn-primary"><span class="fa fa-search"></span> BUSCAR </button>
                                        </span>
                                    </div><!-- /input-group -->
                                </div>
                            </div> 
                            <div class="form-group">
                                <div class="col-md-5">                        
                                    <label for="">ESTUDIANTE :</label>
                                    <div class="input-group">
                                        <input type="text" size="0%" class="form-control" name="estudiante" id="estudiante" readonly  value="<?php echo set_value("estudiante");?>" required>
                                        <span class="input-group-btn">                              
											<a href="<?php echo base_url('mantenimiento/estudiantes/addpre');?>" class="btn btn-success btn-flat btn-block"><span class="fa fa-plus"></span> Nuevo</a>
                                        </span>
                                    </div><!-- /input-group -->
                                </div>
                            </div> 
                            <div class="form-group">
                                <div class="col-md-3">
                                    <label for="">NIVEL ACADEMICO:</label>
                                    <div class="input-group">
                                        <input type="hidden" name="idnivel" id="idnivel" value="<?php echo set_value("idnivel");?>">
                                        <input type="hidden" name="porcentaje" id="porcentaje" value="<?php echo set_value("porcentaje");?>">
                                        <input type="text" placeholder="Clic Buscar Nivel"  size="100%" class="form-control" name="nivel" id="nivel" readonly  data-toggle="modal" data-target="#modal-nivel" value="<?php echo set_value("nivel");?>" required>
                                    </div><!-- /input-group -->
                                </div> 
                            </div>
                            <div class="form-group col-md-12">           
                            </div>
                            <div class="form-group">
                                <div class="col-md-12">
                                    <label for="">CURSO APERTURADO:</label>
                                    <div class="input-group">
                                        <input type="hidden" name="idapertura" id="idapertura" value="<?php echo set_value("idapertura");?>">
                                        <input type="text" size="200%" placeholder="Clic Buscar Curso Aperturado" class="form-control" name="apertura" id="apertura" readonly data-toggle="modal" data-target="#modal-apertura" value="<?php echo set_value("apertura");?>" required>
                                    </div><!-- /input-group -->
                                </div> 
                            </div>
                            <div class="form-group col-md-12">           
                            </div>
                            <div class="form-group">
                                <div class="col-md-2">
                                    <label for="">PRECIO NORMAL :</label>
                                    <input type="text" name="costo" class="form-control" id="costo" readonly value="<?php echo set_value("costo");?>" required>
                                </div>
                                <div class="col-md-2">
                                    <label for="">DESCUENTO :</label>
                                    <input type="text" name="descuento" class="form-control" id="descuento" value="<?php echo set_value("descuento");?>" required>
                                </div>
                                <div class="col-md-2">
                                    <label for="">&nbsp;</label>
                                    <button id="btn-calcular-pago" type="button" class="btn btn-success btn-flat btn-block"><span class="fa fa-plus"></span> Calcular</button>
                                </div>
                                <div class="col-md-6">
                                    <label for="">DESCRIPCIÓN DEL DESCUENTO :</label>
                                    <input type="text" name="descripcion" class="form-control" id="descripcion" value="<?php echo set_value("descripcion");?>">
                                </div>
                            </div>
                            <div class="form-group col-md-12">           
                            </div>
                            <div class="form-group">
                                <div class="col-md-2">
                                    <label for="">MONTO A PAGAR :</label>
                                    <input type="text" name="monto" class="form-control" id="monto" value="<?php echo set_value("monto");?>" required>
                                </div>
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
<div class="modal fade bd-example-modal-lg" id="modal-estudiante">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">LISTA DE ESTUDIANTES</h4>
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
<div class="modal fade bd-example-modal-lg" id="modal-nivel">
    <div class="modal-dialog modal-lg">
        <div class="modal-content ">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">LISTA DE NIVEL ACADEMICO</h4>
            </div>
            <div class="modal-body">
                <table id="example4" class="table table-bordered table-striped table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>NOMBRE</th>
                            <th>PORCENTAJE</th>
                            <th>OPCIÓN</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(!empty($niveles)):?>
                            <?php foreach($niveles as $nivel):?>
                                <tr>
                                    <td><?php echo $nivel->id;?></td>
                                    <td><?php echo $nivel->nombre;?></td>
                                    <td><?php echo ($nivel->descuento)*100;?>%</td>
                                    <?php $datanivel = $nivel->id."*".$nivel->nombre."*".$nivel->descuento;?>
                                    <td>
                                        <button type="button" class="btn btn-success btn-nivelpre" value="<?php echo $datanivel;?>"><span class="fa fa-check"></span></button>
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
                            <th>DÍAS</th>
                            <th>HORA INICIO</th>
                            <th>HORA FIN</th>
                            <th>OPCION</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(!empty($aperturas)):?>
                            <?php foreach($aperturas as $apertura):?>
                                <tr>
                                    <td><?php echo $apertura->id;?></td>
                                    <td><?php $como=$apertura->descripcion." - ". $apertura->curso; echo $como; ?></td>
                                    <td><?php echo $apertura->grupo;?></td>
                                    <td><?php echo $apertura->hora_ini;?></td>
                                    <td><?php echo $apertura->hora_fin;?></td>
                                    <?php $dataapertura = $apertura->id."*".$como."*".$apertura->grupo."*".$apertura->hora_ini."*".$apertura->hora_fin."*".$apertura->costo;?>
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