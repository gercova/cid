<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
        PREMATRICULAS
        <small>Listado</small>
        </h1>
    </section>
    <!-- Main content -->
    <section class="content">
        <!-- Default box -->
        <div class="box box-solid">
            <div class="box-body">
                <div class="row">    
                    <div class="col-md-14">
                        <form action="<?php echo current_url();?>" method="POST" >
                            <div class="form-group ">
                              
                                <label for="" class="col-md-2 control-label" >CURSO APERTURADO: </label>
                                <div class="col-md-5">
                                     <input type="hidden" name="idapertura" id="idapertura" value="<?php echo set_value("idapertura");?>" >
                                    <input type="text" size="180%" class="form-control" name="informacion" id="informacion" readonly  data-toggle="modal" data-target="#modal-curaperturado" value="<?php echo set_value("informacion"); ?>">
                                </div>
                                
                                <div class="col-md-3">
                                    <!-- <input type="submit" name="buscar" value="Buscar" class="btn btn-primary"> -->
                                    <button class="btn btn-primary" type="button" id="btn_searchMatr">Buscar</button>
                                   <a href="<?php echo base_url();?>movimientos/prematriculas" class="btn btn-danger">Restablecer</a> 
                                    
                                </div>

                            </div>
                        </form>
                    </div>
                </div>
                <hr>
                <div id="prematriculas">
                </div>
                                  
            </div><!-- /.box-body -->
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
        <h4 class="modal-title">INDORMACIÓN DE LA PREMATRICULA</h4>
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
                            <th>ALUMNOS</th>
                            <th>OPCIÓN</th>
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
                                    <td><?php echo $curaperturado->alumnos;?></td>
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