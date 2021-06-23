
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
        PAGOS VARIOS
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
                        <form action="<?php echo base_url();?>movimientos/otros/store" method="POST" class="form-horizontal">

                            <div class="form-group <?php echo form_error('prematricula') == true ? 'has-error':''?>">
                                <label class="col-md-6" for="">ESTUDIANTE  </label>
                                    <div class="input-group col-md-12">
                                        <div class="col-md-2">   
                                            <input type="hidden" name="idestudiante" id="idestudiante" value="">
                                            <input type="text" class="form-control" readonly  name="dniestudiante" id="dniestudiante" >
                                        </div>
                                        <div class="col-md-6">
                                             <input type="text" class="form-control" placeholder="Seleccione estudiante" readonly name="estudiante" id="estudiante"  readonly data-toggle="modal" data-target="#modal-estudiante">
                                        </div>
                                     <div class="col-md-3"> 
                                        <input type="hidden" name="idconcepto" id="idconcepto" value="">
                                        <input type="text" class="form-control" placeholder="Seleccione concepto" readonly name="concepto" id="concepto"  readonly data-toggle="modal" data-target="#modal-concepto">           
                                    </div>
                                <?php echo form_error("prematricula","<span class='help-block'>","</span>");?>
                                </div>
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
                                    <button id="btn-agregar-otropago" type="button" class="btn btn-success btn-flat btn-block"><span class="fa fa-plus"></span> Agregar</button>
                                </div>
                            </div>
                            <table id="tbpagos" class="table table-bordered table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th style='text-align:center'>DNI</th>
                                        <th style='text-align:center'>ESTUDIANTE</th>
                                        <th style='text-align:center'>CONCEPTO</th>
                                        <th style='text-align:center'>REFERENCIA</th>
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
                            <th>DNI</th>
                            <th>APELLIDOS Y NOMBRES</th>
                            <th>OPCIÓN</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(!empty($estudiantes)):?>
                            <?php foreach($estudiantes as $estudiante):?>
                                <tr>
                                    <td><?php echo $estudiante->id;?></td>
                                    <td><?php echo $estudiante->num_documento;?></td>
                                    <td><?php echo $estudiante->nombre;?></td> 
                                    <?php $dataestudiante = $estudiante->id."*".$estudiante->num_documento."*".$estudiante->nombre;?>
                                    <td>
                                        <button type="button" class="btn btn-success btn-pagoestudiante" value="<?php echo $dataestudiante;?>"><span class="fa fa-check"></span></button>
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

<div class="modal fade bd-example-modal-lg" id="modal-concepto">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">LISTA DE CONCEPTOS</h4>
            </div>
            <div class="modal-body">
                <table id="example2" class="table table-bordered table-striped table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>CONCEPTO</th>
                            <th>OPCIÓN</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(!empty($conceptos)):?>
                            <?php foreach($conceptos as $concepto):?>
                                <tr>
                                    <td><?php echo $concepto->id;?></td>
                                    <td><?php echo $concepto->nombre;?></td>
                                    <?php $dataconcepto = $concepto->id."*".$concepto->nombre;?>
                                    <td>
                                        <button type="button" class="btn btn-success btn-concepto" value="<?php echo $dataconcepto;?>"><span class="fa fa-check"></span></button>
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