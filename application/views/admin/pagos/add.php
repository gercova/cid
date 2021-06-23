
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
        PAGOS
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
                        <form action="<?php echo base_url();?>movimientos/pagos/store" method="POST" class="form-horizontal">

                            <div class="form-group <?php echo form_error('prematricula') == true ? 'has-error':''?>">
                                <label class="col-md-12" for="">Estudiante Prematriculado: </label>
                                    <div class="input-group col-md-12">
                                        <div class="col-md-2">   
                                            <input type="hidden" name="idprematricula" id="idprematricula" value="">
                                            <input type="text" class="form-control" readonly  name="dniestudiante" id="dniestudiante" >
                                        </div>
                                        <div class="col-md-3">
                                             <input type="text" class="form-control" placeholder="Seleccione estudiante" readonly name="estudiante" id="estudiante"  readonly data-toggle="modal" data-target="#modal-prematricula">
                                        </div>
                                        <div class="col-md-4">
                                             <input type="text" class="form-control"  readonly  class="form-control" readonly name="curso" id="curso" >
                                        </div>
                                        <div class="col-md-1">
                                            <input type="text"  style="color:red;text-align:center" readonly  class="form-control"  name="deuda" id="deuda" >
                                        </div>
                                    </div><!-- /input-group -->
                                <?php echo form_error("prematricula","<span class='help-block'>","</span>");?>
                            </div> 
                     
                            <div class="form-group">
                                <div class="col-md-2">
                                    <label for="">REFERENCIA VOUCHER:</label>
                                    <input type="text" class="form-control" id="descripcion" >
                                </div>
                                <div class="col-md-2">
                                    <label for="">MONTO:</label>
                                    <input type="text" class="form-control" id="monto" >
                                </div>
                                <div class="col-md-2">
                                    <label for="">CODIGO VOUCHER:</label>
                                    <input type="text" class="form-control" id="codigo" >
                                </div>
                                <div class="col-md-2">
                                    <label for="">FECHA PAGO:</label>
                                    <input type="date" class="form-control" id="fecha_pago" >
                                </div>
                                <div class="col-md-2">
                                    <label for="">&nbsp;</label>
                                    <button id="btn-agregar-pago" type="button" class="btn btn-success btn-flat btn-block"><span class="fa fa-plus"></span> Agregar</button>
                                </div>
                            </div>
                            <table id="tbpagos" class="table table-bordered table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th style='text-align:center'>DNI</th>
                                        <th style='text-align:center'>ESTUDIANTE</th>
                                        <th style='text-align:center'>REFERENCIA VOUCHER</th>
                                        <th style='text-align:center'>MONTO</th>
                                        <th style='text-align:center'>CODIGO VOUCHER</th>
                                        <th style='text-align:center'>FECHA PAGO</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                
                                </tbody>
                            </table>
                            <input type="hidden" name="contador" id="contador" value=""> 
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


<div class="modal fade bd-example-modal-lg" id="modal-prematricula">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">LISTA DE PREMATRICULADOS</h4>
            </div>
            <div class="modal-body">
                <table id="example5" class="table table-bordered table-striped table-hover">
                    <thead>
                         <tr>
                            <th>DNI</th>
                            <th>ESTUDIANTE</th>
                            <!-- <th>Apellido</th> -->
                            <th>CURSO</th>
                            <th>DEUDA</th>
                            <th>OPCIÓN</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if(!empty($prematriculas)):?>
                                    <?php foreach($prematriculas as $prematricula):?>
                                        <tr>
                                            <td><?php $prematricula->id;echo $prematricula->dni;?></td>
                                            <td><?php echo $prematricula->nombre;?></td>
                                          
                                            <td><?php echo $prematricula->curso;?> - <?php echo $prematricula->ape;?></td>
                                            <td><?php echo $prematricula->deuda;?></td>
                                             <?php $dataprematricula = $prematricula->id."*".$prematricula->dni."*".$prematricula->nombre."*".$prematricula->ape."*".$prematricula->curso."*".$prematricula->deuda;?>
                                            <td>
                                        <button type="button" class="btn btn-success btn-pagos" value="<?php echo $dataprematricula;?>"><span class="fa fa-check"></span></button>
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