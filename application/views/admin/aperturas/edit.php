
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
        APERTURA
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
                        <?php if($this->session->flashdata("error")):?>
                            <div class="alert alert-danger alert-dismissible">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                <p><i class="icon fa fa-ban"></i><?php echo $this->session->flashdata("error"); ?></p>
                             </div>
                        <?php endif;?>
                        <form action="<?php echo base_url();?>movimientos/Aperturas/update" method="POST" >

							<input type="hidden" name="idapertura" value="<?php echo $apertura->id;?>">
							
                           <div class="form-group <?php echo form_error('curso') == true ? 'has-error':''?>">
                                <div class="col-md-6">
                                    <label for="">CURSO:</label>
                                        <input type="hidden" name="idcurso" id="idcurso" value="<?php echo form_error("idcurso") !=false ? set_value("idcurso") : $apertura->curso_id;?>">
                                        <input type="text" size="100%" class="form-control" name="curso" id="curso" readonly  value="<?php echo form_error("curso") !=false ? set_value("curso") : $apertura->descripcion." - ".$apertura->curso;?>">
                                    <?php echo form_error("curso","<span class='help-block'>","</span>");?>
                                </div> 
                            </div>

                            <div class="form-group <?php echo form_error('grupo') == true ? 'has-error':''?>">
                                <div class="col-md-6">
                                    <label for="">GRUPO DE CLASES :</label>
                                        <input type="hidden" name="idgrupo" id="idgrupo" value="<?php echo form_error("idgrupo") !=false ? set_value("idgrupo") : $apertura->grupo_id;?>">
                                        <input type="text" class="form-control" size="100%" data-toggle="modal" data-target="#modal-grupo" name="grupo" id="grupo" readonly  value="<?php echo form_error("grupo") !=false ? set_value("grupo") : $apertura->grupo." ".$apertura->hora_ini." ".$apertura->hora_fin;?>">
                                    <?php echo form_error("grupo","<span class='help-block'>","</span>");?>
                                </div> 
                            <div class="form-group col-md-12">           
                            </div>

                            <div class="form-group <?php echo form_error('fecha_ini') == true ? 'has-error' : '' ?>">
                                <div class="col-md-6">
                                    <label for="">FECHA INICIO (tentativa):</label>
                                        <input type="date"  class="form-control" name="fecha_ini" id="fecha_ini" value="<?php echo form_error("fecha_ini") !=false ? set_value("fecha_ini") : $apertura->fecha_ini;?>">
        
                                    <?php echo form_error("fecha_ini", "<span class='help-block'>", "</span>"); ?>
                                </div>
                            </div>
                            
                            <div class="form-group <?php echo form_error('sede_id') == true ? 'has-error':''?>">
                                <div class="form-group col-md-6">
                                    <label for="sede_id">Sede  : </label>
                                    <select  class="form-control" id="sede_id" name="sede_id">
                                        <?php foreach ($sedes as $s) : ?>
                                            <?php $sel = $apertura->sede_id==$s->id?'selected':'' ?>
                                        <option value="<?php echo $s->id;?>" <?php echo $sel; ?> ><?php echo $s->nombre;?></option>
                                        <?php endforeach; ?>
                                    </select>     
                                </div>                           
                            </div>

                            <div class="form-group <?php echo form_error('estado_inscripcion') == true ? 'has-error':''?>">
                                <div class="col-md-6">
                                <label for="estado">Inscripcion web : </label>
                                <select  class="form-control" id="estado_inscripcion" name="estado_inscripcion">
                                    <option <?= $apertura->estado_inscripcion=='abierto'? 'selected':'' ?> value="abierto">Abierto</option>
                                    <option <?= $apertura->estado_inscripcion=='cerrado'? 'selected':'' ?> value="cerrado">Cerrado</option>
                                </select>       
                                </div>                        
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



<div class="modal fade bd-example-modal-lg" id="modal-curso">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">LISTA DE CURSOS</h4>
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
                        <?php if(!empty($cursos)):?>
                            <?php foreach($cursos as $curso):?>
                                <tr>
                                    <td><?php echo $curso->id;?></td>
                                    <td><?php echo $curso->nombre;?></td>
                                    <?php $datacurso = $curso->id."*".$curso->nombre."*".$curso->costo;?>
                                    <td>
                                        <button type="button" class="btn btn-success btn-grupoape" value="<?php echo $datacurso;?>"><span class="fa fa-check"></span></button>
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





<div class="modal fade bd-example-modal-lg" id="modal-grupo">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">LISTA DE GRUPO DE ESTUDIOS</h4>
            </div>
            <div class="modal-body">
                <table id="example3" class="table table-bordered table-striped table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>DÍAS</th>
                            <th>HORA INICI</th>
                            <th>HORA FIN</th>
                            <th>OPCIÓN</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(!empty($grupos)):?>
                            <?php foreach($grupos as $grupo):?>
                                <tr>
                                    <td><?php echo $grupo->id;?></td>
                                    <td><?php echo $grupo->nombre;?></td>
                                    <td><?php echo $grupo->hora_ini;?></td>
                                    <td><?php echo $grupo->hora_fin;?></td>
                                    <?php $datagrupo = $grupo->id."*".$grupo->nombre."*".$grupo->hora_ini."*".$grupo->hora_fin;?>
                                    <td>
                                        <button type="button" class="btn btn-success btn-grupoape" value="<?php echo $datagrupo;?>"><span class="fa fa-check"></span></button>
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


