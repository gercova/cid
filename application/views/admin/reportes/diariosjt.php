<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>
			REPORTE
			<small>INGRESOS SEGÚN FECHA DE REGISTRO</small>
		</h1>
	</section>
	<!-- Main content -->
	<section class="content">
		<!-- Default box -->
		<div class="box box-solid">
			<div class="box-body">

				<div class="row">
					<form action="<?php echo current_url(); ?>" method="POST" class="form-horizontal">
						<div class="form-group">
							<label for="" class="col-md-1 control-label">DESDE: </label>
							<div class="col-md-2">
								<input type="date" class="form-control" id="fechainicio" name="fechainicio" value="<?php echo set_value("fechainicio"); ?>">
							</div>
							<label for="" class="col-md-1 control-label">HASTA: </label>
							<div class="col-md-2">
								<input type="date" class="form-control" id="fechafin" name="fechafin" value="<?php echo set_value("fechafin"); ?>">
							</div>
							<label for="" class="col-md-1 control-label">SEGÚN FECHA: </label>
							<div class="col-md-2">
							    <select name="fechaselec" id="fechaselec" class="form-control" >
                                    <option value="1">REGISTRO</option>
                                    <option value="2">CANCELACIÓN</option>
                                </select>
                            </div>
							<div class="col-md-3">
							<button class="btn btn-primary" type="button" id="btn_buscarpago">Buscar</button>
								<a href="<?php echo base_url(); ?>reportes/diarios" class="btn btn-danger">RESTABLECER</a>
							</div>

						</div>

					</form>
				</div>
				<div id="reportediario">

				</div>
			</div>
			<!-- /.box-body -->
		</div>
		<!-- /.box -->
	</section>
	<!-- /.content -->
</div>
<!-- /.content-wrapper -->
