<div class="callout callout-warning">
	<p> <strong>ATENCIÓN!</strong> Llene y corrobore sus datos que serán ingresados para su Certificación (no olvide las tildes).</p>
</div>

<?php $msjType = $this->session->flashdata("error")? "error":"success";
				msjFlashAlert( $this->session->flashdata($msjType), $msjType);?>

<form id="f_nuevo_pago" action="<?php echo base_url($controlador.'guardar_pago');?>" method="POST" enctype="multipart/form-data">

<div class="box box-info">
	<div class="box-header with-border">
		MIS DATOS PERSONALES
	</div>
	<div class="box-body">
		<div class="row">

			<div class="col-xs-12 col-md-3">
				<div class="form-group">
					<label>Tipo de Documento </label>
					<select id="tipo_documento_id" name="tipo_documento_id" class="form-control " style="width: 100%;">
						<option value="1" selected="selected" length_valid="8">DNI</option>
						<option value="2" length_valid="11" >RUC</option>
						<option value="3" length_valid="12" >Pasaporte</option>
					</select>
				</div>
			</div>

			<div  class="col-xs-12 col-md-5">
				<div class="form-group">
					<label for="num_documento">Nro. Documento </label>
					<input id="num_documento" name="num_documento" class="form-control input-number" autofocus  placeholder="Ingrese su número de documento para la búsqueda de su información">
				</div>
			</div>

			<?php 
				$data_personal_left = array(
						"fecha_nacimiento"=>"Fecha nacimiento",
						"nombre" => "Nombre completo",
						"carrera"=> "Carrera o Especialidad",
						"sexo"=> "Sexo"
					); 
				$data_personal_right = array(
						"direccion"=> "Dirección",
						"celular"=> "Celular",
						"email"=> "Correo"
					); 
			?>

			<div  class="col-xs-12 col-md-6">
				<table class="table table-hover table-striped" >					
					<tbody>
						<?php 
						foreach ($data_personal_left as $key => $val) {
							echo "<tr><th> $val : </th>";
							echo "<td id='$key' class='text-right'></td></tr>";
						}
						?>						
		            </tbody>
				</table>
			</div>

			<div  class="col-xs-12 col-md-6">
				<table class="table table-hover table-striped">					
					<tbody>
						<?php 
						foreach ($data_personal_right as $key => $val) {
							echo "<tr><th> $val : </th>";
							echo "<td id='$key' class='text-right'></td></tr>";
						}
						?>						
		            </tbody>
				</table>
			</div>
			

		</div>

	</div>
</div>

<div class="box box-info">
	<div class="box-header with-border">
		INSCRIPCIONES PENDIENTES DE PAGO
	</div>
		<div class="box-body">
		<div class="row">

			<div class=" col-xs-12 col-md-12" id="table-lista-pago">
				<table class="table table-bordered table-striped">
	            <tr>
		            <th>Curso</th>
		            <th>Horario</th>
		            <th>Inicio</th>
		            <th>Pago pendiente</th>
		            <th>#</th>
	            </tr>

		            <tr>
			            
			            <td colspan="4" style="text-align: center">
				            <h4>Ingresé su número de documento, para cargar sus pagos pendientes.</h4>
			            </td>
			            <td></td>
		            </tr>

            </table>
			</div>

		</div>
	</div>
</div>
<div class="box box-info">
		<div class="box-header with-border">
		INFORMACIÓN DEL DEPOSITO REALIZADO
	    </div>

	<div class="box-body"> 
		<div class="row">
           <div class="col-xs-12 col-md-3">
				<div  class="form-group">
					<label for="fecha_pago">Fecha </label>
					<input  type="date" id="fecha_pago" name="fecha_pago" class="form-control" value="<?= date('Y-m-d') ?>" >
				</div>
			</div>
	
			<div    class="col-xs-12 col-md-3">
			  	<label for="descripcion">Documento </label>
			  	<div class="form-group">
					<!--input  type="text" id="descripcion" name="descripcion" class="form-control" placeholder="Banco de la nacion | Banco BCP " -->
					<select id="descripcion" name="descripcion" class="form-control">
						<option value="Banco de la nación">Banco de la nación</option>
						<option value="Banco de Crédito del Perú"> Banco de Crédito del Perú </option>
					</select>
			  	</div>
			</div>
			<div    class="col-xs-6 col-md-3">
			  <div class="form-group">
			  <label for="codigo">Código Boucher</label>
					<input  type="text" id="codigo" name="codigo" class="form-control" placeholder="Ingrese codigo del boucher">
				</div>
			</div>
			<div    class="col-xs-6 col-md-3">
			  <div class="form-group">
			  <label for="monto">Monto </label>
					<input  type="number" id="monto" name="monto" class="form-control" placeholder="120.00" >
				</div>
			</div>
           <div class="col-xs-12 col-md-4">
				<div class="form-group">
					<label> PDF/JPG/PNG </label>
					<input type="file" id="imagen_pago" name="imagen_pago" class="form-control" >
				</div>
			</div>

			<div    class="col-xs-12 col-md-8">
			  <div class="form-group">
			  <label for="num_documento">Comentario </label>
					
					<textarea id="comentario" name="comentario" class="form-control" placeholder="Si tiene algun comentario, por favor enviarlo ..." ></textarea>
				</div>
			</div>
		</div>

	</div>
</div>

 <div class="row center-block text-center">
	<div class="col-md-8 col-lg-8 ">
		<div class="form-group">
		     <a class="btn btn-success btn-block btn-lg" id="BtnSave2">ENVIAR REGISTRO DE PAGO</a> 
		</div>
	</div>
</div>

</form>

<script type="text/javascript">
    var base_url= "<?php echo base_url();?>"; 
</script>
