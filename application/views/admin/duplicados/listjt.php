<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>
			DUPLICADOS
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
                              
                                <label for="" class="col-md-2 control-label" >FECHA DE BUSQUEDA : </label>
                                <div class="col-md-3">
                                        <input type="date" size="180%" class="form-control" name="fechabuscar" id="fechabuscar" value="<?php echo set_value("fechabucar"); ?>">
                                </div>
                                
                                <div class="col-md-3">
                                    <!-- <input type="submit" name="buscar" value="Buscar" class="btn btn-primary"> -->
                                    <button class="btn btn-primary" type="button" id="btn_buscarfecha">Buscar</button>
                                   <a href="<?php echo base_url();?>matriculas/Dupliados" class="btn btn-danger">Restablecer</a> 
                                    
                                </div>

                            </div>
                        </form>
                    </div>
                </div>
                
				<hr>
				<div id="duplicados">
				</div>	
			</div>
			<!-- /.box-body -->
		</div>
		<!-- /.box -->
	</section>
	<!-- /.content -->
</div>
<!-- /.content-wrapper -->