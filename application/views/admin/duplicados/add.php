
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
        DUPLICADO
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
                        <form action="<?php echo base_url();?>matriculas/Duplicados/store" method="POST" >
                            <div class="form-group <?php echo form_error('oculto') == true ? 'has-error':''?>" >
                                <div class="col-md-6">                        
                                    <label for="">ESTUDIANTE:</label>
                                        <div class="input-group">
                                            <input type="hidden" name="idprematricula" id="idprematricula" value="<?php echo set_value("idprematricula");?>">
                                            <input type="hidden" name="oculto" id="oculto" value="">
										    <input type="text"  size="100%"  placeholder="Clic Buscar estudiante" class="form-control" name="alumno" id="alumno" readonly  data-toggle="modal" data-target="#modal-duplicados" value="<?php echo set_value("alumno") ;?>">
                                        </div><!-- /input-group -->
                                    <?php echo form_error("oculto","<span class='help-block'>","</span>");?>
                                </div> 
                            </div>
                            <div class="form-group <?php echo form_error('nivel') == true ? 'has-error':''?>">
                                <div class="col-md-6">
                                    <label for="">CURSO / EVENTOS:</label>
                                        <div class="input-group">
                                          <input type="text"  placeholder="Descripción"  size="100%" class="form-control" name="curso" id="curso" readonly  value="<?php echo set_value("curso");?>">
                                    </div><!-- /input-group -->
                                    <?php echo form_error("nivel","<span class='help-block'>","</span>");?>
                                </div> 
                            </div>

                            <div class="form-group col-md-12">           
                            </div>
                            <div class="form-group">
                                <div class="col-md-2 <?php echo form_error('costo') == true ? 'has-error':''?>">
                                    <label for=""> FOLIO :</label>
                                    <input type="text" name="folio" class="form-control" id="folio"  readonly value="<?php echo set_value("folio");?>" >
                                    <?php echo form_error("folio","<span class='help-block'>","</span>");?>
                                </div>
                                <div class="col-md-2 <?php echo form_error('descuento') == true ? 'has-error':''?>">
                                    <label for="">CORRELATIVO :</label>
                                    <input type="text" name="correlativo" class="form-control" id="correlativo" readonly value="<?php echo set_value("correlativo");?>">
                                    <?php echo form_error("correlativo","<span class='help-block'>","</span>");?>
                                </div>
                                <div class="col-md-3 <?php echo form_error('fecha') == true ? 'has-error':''?>">
                                    <label for="">FECHA DE IMPRESION DEL DUPLICADO :</label>
                                    <input type="date" name="fecha" class="form-control" id="fecha" value="<?php echo set_value("fecha");?>">
                                    <?php echo form_error("fecha","<span class='help-block'>","</span>");?>
                                </div>
                                <div class="col-md-2">
									<label for="">&nbsp;</label>
									<button id="btn-agregar-duplicado" type="button" class="btn btn-success btn-flat btn-block"><span class="fa fa-plus"></span> Agregar</button>
								</div>
                            </div>

                            <div class="form-group col-md-12">           
                            </div>

                            <table id="tbduplicado" class="table table-bordered table-striped table-hover">
								<thead>
									<tr>
                                        <th width="30%">ESTUDIANTE</th>
                                        <th width="30%">CURSO</th>
										<th>FOLIO</th>
                                        <th>CORRELATIVO</th>
                                        <th>IMPRESIÓN</th>
										<th>OPCIÓN</th>
									</tr>
								</thead>
								<tbody>

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
<div class="modal fade bd-example-modal-lg" id="modal-duplicados">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">LISTA DE CERTIFICADOS</h4>
            </div>
            <div class="modal-body">
                <table id="example6" class="table table-bordered table-striped table-hover">
                    <thead>
                        <tr>
                            <th>DNI</th>
                            <th>ALUMNO</th>
                            <th>CURSO</th>
                            <th>FOLIO</th>
                            <th>CORRE</th>
                            <th>OPCIÓN</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(!empty($certificados)):?>
                            <?php foreach($certificados as $certificado):?>
                                <tr>
                                    <td><?php  $certificado->id;?><?php echo $certificado->num_documento;?></td>
                                    <td><?php echo $certificado->estudiante;?></td>
                                    <td><?php echo $certificado->curso;?></td>
                                    <td><?php echo $certificado->folio;?></td>
                                    <td><?php echo $certificado->correlativo;?></td>
                                    <?php $datacertificado = $certificado->id."*".$certificado->estudiante."*".$certificado->curso."*".$certificado->folio."*".$certificado->correlativo;?>
                                    <td>
                                        <button type="button" class="btn btn-success btn-certificado" value="<?php echo $datacertificado;?>"><span class="fa fa-check"></span></button>
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