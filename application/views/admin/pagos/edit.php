
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
        Pagos
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
                        <form action="<?php echo base_url();?>movimientos/pagos/update" method="POST" class="form-horizontal">

                            <div class="form-group <?php echo form_error('prematricula') == true ? 'has-error':''?>">
                                <div class="col-md-12">
                                    <div class="col-md-6">
                                    <label for="">ESTUDIANTE</label>
                                        <input type="hidden" name="idprematricula" id="idprematricula" value="<?php echo $pago->prematricula_id;?>" >
                                        <input type="text" class="form-control" name="prematricula" id="prematricula" disabled  value="<?php echo $pago->nombre ;?>">
                                    </div>    
                                    <div class="col-md-6">
                                    <label for="">CURSO</label>
                                        <input type="text" class="form-control" name="OO" id="OO" disabled  value="<?php echo $pago->curso." - ".$pago->ape;?>">
                                        <input type="hidden" name="monto" id="monto" value="<?php echo $pago->monto;?>">
                                        <!-- <span class="input-group-btn">
                                            <button class="btn btn-primary" type="button" disabled data-toggle="modal" data-target="#modal-prematricula" ><span class="fa fa-search"></span> Buscar</button>
                                        </span> -->
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
                                    <input type="text" class="form-control" id="descripcion" disabled >
                                </div>
                                <div class="col-md-2">
                                    <label for="">MONTO:</label>
                                    <input type="text" class="form-control" id="monto" disabled >
                                </div>
                                <div class="col-md-2">
                                    <label for="">CODIGO VOUCHER:</label>
                                    <input type="text" class="form-control" id="codigo"  disabled>
                                </div>
                                <div class="col-md-2">
                                    <label for="">FECHA PAGOs:</label>
                                    <input type="date" class="form-control" id="fecha_pago"  disabled>
                                </div>
                                <div class="col-md-2">
                                    <label for="">&nbsp;</label>
                                    <button id="btn-agregar-pago" type="button" disabled class="btn btn-success btn-flat btn-block"><span class="fa fa-plus"></span> Agregar</button>
                                </div>
                            </div>
                            <table id="tbpagos" class="table table-bordered table-striped table-hover">
                                <thead>
                                    <tr> 
                                        <th>ID</th>
                                        <th>DOCUMENTO</th>
                                        <th>MONTO</th>
                                        <th>CODIGO VOUCHER</th>
                                        <th>FECHA PAGO</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php if(!empty($pagocuo)):?>
                                    <?php foreach($pagocuo as $pagocuos):?>
                                        <tr>
                                            <td><input type="hidden" class="form-control" name="idpago[]" value="<?php echo $pagocuos->id;?>"> <label class="form-control"><?php echo $pagocuos->id;?></label></td>
                                            <td><input type="text" class="form-control" name="descripcionpago[]" value="<?php echo $pagocuos->descripcion;?>"></td>
                                            <td><input type="text" class="form-control" name="montopago[]" value="<?php echo $pagocuos->monto;?>"></td>
                                            <td><input type="text" class="form-control" name="codigopago[]" value="<?php echo $pagocuos->codigo;?>"></td>
                                            <td><input type="date" class="form-control" name="fechapago[]" value="<?php echo $pagocuos->fecha_pago;?>"></td>
                                        </tr>
                                    <?php endforeach;?>
                                <?php endif;?>
                            </tbody>
                            </table>

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

