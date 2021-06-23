
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
        CERTIFICADO
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
                        <form action="<?php echo base_url();?>matriculas/Duplicados/update" method="POST" >

                            <div class="form-group <?php echo form_error('alumno') == true ? 'has-error':''?>" >
                                <div class="col-md-6">                        
                                    <label for="">ESTUDIANTE:</label>
                                        <div class="input-group">
                                            <input type="hidden" name="idcertificado" id="idcertificado" value="<?php echo form_error("idcertificado") !=false ? set_value("idcertificado") : $certificado->id;?>">
                                            <input type="text"  size="100%"  placeholder="Clic Buscar estudiante" class="form-control" name="alumno" id="alumno" readonly  value="<?php echo form_error("alumno") !=false ? set_value("alumno") : $certificado->alumno;?>">
                                        </div><!-- /input-group -->
                                    <?php echo form_error("alumno","<span class='help-block'>","</span>");?>
                                </div> 

                            <div class="form-group <?php echo form_error('nivel') == true ? 'has-error':''?>">
                                <div class="col-md-6">
                                    <label for="">CURSO / EVENTO:</label>
                                        <div class="input-group">
                                          <input type="text"  placeholder="Descripción"  size="100%" class="form-control" name="curso" id="curso" readonly  value="<?php echo form_error("curso") !=false ? set_value("curso") : $certificado->curso;?>">
                                    </div><!-- /input-group -->
                                    <?php echo form_error("nivel","<span class='help-block'>","</span>");?>
                                </div> 
                            </div>

                            <div class="form-group col-md-12">           
                            </div>

                            <div class="form-group">
                                <div class="col-md-2 <?php echo form_error('folio') == true ? 'has-error':''?>">
                                    <label for=""> FOLIO :</label>
                                    <input type="text" name="folio" readonly class="form-control" id="folio" value="<?php echo form_error("folio") !=false ? set_value("folio") : $certificado->folio;?>" >
                                    <?php echo form_error("folio","<span class='help-block'>","</span>");?>
                                </div>
                                <div class="col-md-2 <?php echo form_error('descuento') == true ? 'has-error':''?>">
                                    <label for=""># CORRELATIVO :</label>
                                    <input type="text" name="correlativo" readonly class="form-control" id="correlativo" value="<?php echo form_error("correlativo") !=false ? set_value("correlativo") : $certificado->correlativo;?>">
                                    <?php echo form_error("correlativo","<span class='help-block'>","</span>");?>
                                </div>
                                <div class="col-md-2 <?php echo form_error('fecha') == true ? 'has-error':''?>">
                                    <label for="">FECHA DE IMPRESIÓN:</label>
                                    <input type="date" name="fecha" class="form-control" id="fecha" value="<?php echo form_error("fecha") !=false ? set_value("fecha") : $certificado->fecha_dupli;?>">
                                    <?php echo form_error("fecha","<span class='help-block'>","</span>");?>
                                </div>
                                <div class="col-md-2 <?php echo form_error('cara') == true ? 'has-error':''?>">
                                    <label for="">CERTIFICADO:</label>
                                    <input type="text" name="cara" class="form-control" id="cara" value="<?php echo form_error("cara") !=false ? set_value("cara") : $certificado->img;?>">
                                    <?php echo form_error("cara","<span class='help-block'>","</span>");?>
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
