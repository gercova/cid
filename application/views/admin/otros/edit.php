
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
        PAGOS VARIOS
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
                        <form action="<?php echo base_url();?>movimientos/otros/update" method="POST" class="form-horizontal">

                            <div class="form-group <?php echo form_error('prematricula') == true ? 'has-error':''?>">
                                <div class="col-md-12">
                                    <div class="col-md-6">
                                    <label for="">ESTUDIANTE</label>
                                        <input type="hidden" name="idpago" id="idpago" value="<?php echo $pago->id;?>" >
                                        <input type="text" class="form-control" name="estudiante" id="estudiante" disabled  value="<?php echo $pago->estudiante ;?>">
                                    </div>    
                                    <div class="col-md-6">
                                    <label for="">CONCEPTO</label>
                                    <input type="hidden" name="idconcepto" id="idconcepto" value="<?php echo $pago->concepto_id;?>" >
                                        <input type="text" class="form-control" placeholder="Seleccione concepto" readonly name="concepto" id="concepto" value="<?php echo $pago->concepto;?>"   readonly data-toggle="modal" data-target="#modal-concepto"> 
                                      
                                    </div><!-- /input-group -->
                                    <?php echo form_error("prematricula","<span class='help-block'>","</span>");?>
                                </div> 
                              <!--  <div class="col-md-3">
                                    <label for="">Fecha:</label>
                                    <input type="date" class="form-control" name="fecha" required>
                                </div>-->
                            </div>
                            <div class="form-group">
                                <div class="col-md-3">
                                    <label for="">DOCUMENTO:</label>
                                    <input type="text" class="form-control" id="descripcion"  name="descripcion" value="<?php echo $pago->descripcion;?>" >
                                </div>
                                <div class="col-md-2">
                                    <label for="">MONTO:</label>
                                    <input type="text" class="form-control" id="monto" name="monto" value="<?php echo $pago->monto;?>" >
                                </div>
                                <div class="col-md-2">
                                    <label for="">CODIGO VOUCHER:</label>
                                    <input type="text" class="form-control" id="codigo" name="codigo"  value="<?php echo $pago->codigo;?>" >
                                </div>
                                <div class="col-md-2">
                                    <label for="">FECHA DE PAGO:</label>
                                    <input type="date" class="form-control" id="fecha_pago" name="fecha_pago"  value="<?php echo $pago->fecha_pago;?>" >
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