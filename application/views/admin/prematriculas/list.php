<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
        Prematricula
        <small>Listado</small>
        </h1>
    </section>
    <!-- Main content -->
    <section class="content">
        <!-- Default box -->
        <div class="box box-solid">
            <div class="box-body">
                <div class="row">
                    <div class="col-md-12">
                        <?php if($permisos->insert == 1):?>    <!-- para permisos  -->
                        <a href="<?php echo base_url();?>movimientos/prematriculas/add" class="btn btn-primary btn-flat"><span class="fa fa-plus"></span> Agregar Prematricula</a>
                    <?php endif;?>
                    </div>
                 </div>
                
                 <div class="row">    
                    <div class="col-md-14">
                        <form action="<?php echo current_url();?>" method="POST" >
                            <div class="form-group ">
                              
                                <label for="" class="col-md-2 control-label" >Curso Aperturados: </label>
                                <div class="col-md-5">
                                     <input type="hidden" name="idapertura" id="idapertura" value="<?php echo set_value("idapertura");?>">
                                    <input type="text" size="180%" class="form-control" name="informacion" id="informacion" readonly  data-toggle="modal" data-target="#modal-curaperturado" value="<?php echo set_value("informacion"); ?>">
                                </div>
                                <div class="col-md-3">
                                    <input type="submit" name="buscar" value="Buscar" class="btn btn-primary">
                                    <a href="<?php echo base_url();?>movimientos/prematriculas" class="btn btn-danger">Restablecer</a>
                                </div>

                            </div>
                        </form>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="table-responsive col-md-12">
                        <table id="example" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <!-- <th>Fecha</th> -->
                                    <th>DNI</th>
                                    <th>ESTUDANTE</th>
                            
                                    <th>CELULAR</th>
                                    <th  width="20%">CURSO</th>
                                    <th>GRUPO</th>
                                    <th>HORARIO</th>
                                    <th>OPCIÓN</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if(!empty($prematriculas)):?>
                                    <?php foreach($prematriculas as $prematricula):?>
                                        <tr>
                                            <!-- <td><?php echo $prematricula->fecha_registro;?></td> -->
                                            <td><?php $prematricula->id;echo $prematricula->dni;?></td>
                                            <td><?php echo $prematricula->nombre;?></td>
                                            <td><?php echo $prematricula->celular;?></td>
                                            <td><?php echo $prematricula->aper." - ".$prematricula->curso;?></td>
                                            <td><?php echo $prematricula->grupo;?></td>
                                            <td><?php echo $prematricula->hora_ini;?> :: <?php echo $prematricula->hora_fin;?></td>
                                           
                                            <td>
                                                <div class="btn-group">
                                                    <button type="button" class="btn btn-info btn-view-prematriculas" data-toggle="modal" data-target="#modal-prematriculas" value="<?php echo $prematricula->id;?>">
                                                        <span class="fa fa-search"></span>
                                                    </button>
                                                    
                                                    <?php if($permisos->update == 1):?>  <!-- para permisos  -->
                                                    <a href="<?php echo base_url()?>movimientos/prematriculas/edit/<?php echo $prematricula->id;?>" class="btn btn-warning"><span class="fa fa-pencil"></span></a>
                                                <?php endif;?>
                                                <?php if($permisos->delete == 1):?>  <!-- para permisos  -->
                                                    <a href="<?php echo base_url();?>movimientos/prematriculas/delete/<?php echo $prematricula->id;?>" class="btn btn-danger btn-remove"><span class="fa fa-remove"></span></a>
                                                <?php endif;?>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php endforeach;?>
                                <?php endif;?>
                            </tbody>
                        </table>
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

<div class="modal fade " id="modal-prematriculas">
  <div class="modal-dialog ">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Informacion de la Prematricula</h4>
      </div>
      <div class="modal-body">
        
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

<div class="modal fade bd-example-modal-lg" id="modal-curaperturado">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Lita de cursos Aperturados</h4>
            </div>
            <div class="modal-body">
                <table id="example5" class="table table-bordered table-striped table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Curso</th>
                            <th>Grupo</th>
                            <th>Hora Inicio</th>
                            <th>Hora Fin</th>
                            <th>Opcion</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(!empty($curaperturados)):?>
                            <?php foreach($curaperturados as $curaperturado):?>
                                <tr>
                                    <td><?php echo $curaperturado->id;?></td>
                                    <td><?php echo $curaperturado->curso;?></td>
                                    <td><?php echo $curaperturado->grupo;?></td>
                                    <td><?php echo $curaperturado->hora_ini;?></td>
                                    <td><?php echo $curaperturado->hora_fin;?></td>
                                    <?php $datacuraperturado = $curaperturado->id."*".$curaperturado->curso."*".$curaperturado->grupo."*".$curaperturado->hora_ini."*".$curaperturado->hora_fin;?>
                                    <td>
                                        <button type="button" class="btn btn-success btn-curaperturados" value="<?php echo $datacuraperturado;?>"><span class="fa fa-check"></span></button>
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