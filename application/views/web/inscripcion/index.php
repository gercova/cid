<div class="callout callout-warning">
	<p> <strong>ATENCIÓN!</strong> Llene y corrobore sus datos que serán usados para su Certificación (no olvide las tildes).</p>
</div>

<?php $msjType = $this->session->flashdata("error")? "error":"success";
				msjFlashAlert( $this->session->flashdata($msjType), $msjType);?>

<form action="<?php echo base_url($controlador.'guardar_inscripcion');?>" method="POST" enctype="multipart/form-data" id="form-inscripcion">

<div class="box box-info">
	<div class="box-header with-border">
		MIS DATOS PERSONALES
	</div>
	<div class="box-body">
		<div class="row">

			<div class="col-xs-12 col-md-3">
				<div class="form-group">
					<label for="tipo_documento_id">Tipo de Documento </label>
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
               
			<div class="col-xs-12 col-md-4">
				<div id="fecha_nacimiento_div" class="form-group">
					<label for="fecha_nacimiento">Fecha nacimiento </label>
					<input type="date" id="fecha_nacimiento" name="fecha_nacimiento" class="form-control">
				</div>
			</div>

			<div class="col-xs-12 col-md-8">
				<div id="nombre_nuevo" class="form-group">
					<label for="nombre">Apellidos y nombres</label>
				<!-- <input id="nombre" name="nombre" class="form-control" placeholder="Ingrese su número de documento" readonly="readonly"> -->
					<input id="nombre" name="nombre" class="form-control" placeholder="Ingrese su número de documento">
				</div>
			</div>

			<div class="col-xs-12 col-md-4">
				<div class="form-group">
					<label for="sexo">Sexo </label>
					<select id="sexo_id" name="sexo_id" class="form-control" style="width: 100%;">
						<option value="1" selected="selected">Masculino</option>
						<option value="2">Feminino</option>
						<option value="3">Sin Especificar</option>
					</select>
				</div>
			</div>

			<div class="col-xs-12 col-md-4">
				<div class="form-group">
					<label for="carrera_id">Carrera / Especialidad </label>
					<select required  id="carrera_id" name="carrera_id" class="form-control select2" style="width: 100%;">
						<option value="30" selected="selected">-- Seleccione una opción --</option>
						<?php foreach ($carreras as $n) : ?>
							<option value="<?=$n->id;?>" ><?=$n->nombre;?></option>
						<?php endforeach; ?>
					</select>
				</div>
			</div>

			<div class="col-xs-12 col-md-4">
				<div id="telefono_contacto" class="form-group">
					<label for="telefono">Celular o teléfono </label>
					<input id="telefono" name="telefono" class="form-control input-number" placeholder="Ingrese su número de celular o teléfono" maxlength="12">
				</div>
			</div>

			<div class="col-xs-12 col-md-4">
				<div id="email_contacto" class="form-group">
					<label for="email">Correo </label>
					<input id="email" name="email" class="form-control" placeholder="Ingrese su correo">
				</div>
			</div>			

			<div class="col-xs-12 col-md-12">
				<div id="direccion_contacto" class="form-group">
					<label for="direccion">Dirección actual</label>
					<input id="direccion" name="direccion" class="form-control" placeholder="Ingrese su dirección ">
				</div>
			</div>

		</div>

	</div>
</div>

<div class="box box-info">
	<div class="box-header with-border">
		
	</div>
	<div class="box-body">
		<div class="row">

			<div class="col-xs-12 col-md-4">
				<div class="form-group">
					<label for="nivel_id">Categoría de estudiante </label>
					<select required  id="nivel_id" name="nivel_id" class="form-control select2" style="width: 100%;">
						<option value="" selected="selected">-- Seleccione una opción --</option>
						<?php foreach ($niveles as $n) : ?>
						<option value="<?=$n->id;?>" ><?=$n->nombre;?></option>
						<?php endforeach; ?>
					</select>
				</div>
			</div>	
			
			<div class="col-xs-12 col-md-4">
				<div class="form-group">
					<label for="sede_id"> Lugar </label>
					<select required id="sede_id" name="sede_id" class="form-control select2" onchange="getCursoApertura()" style="width: 100%;">
						<!--option value="" selected="selected">-- Seleccione una opción --</option-->
						<?php foreach ($sedes as $s) : ?>
						<option value="<?=$s->id;?>" ><?=$s->nombre;?></option>
						<?php endforeach; ?>
					</select>
				</div>
			</div>

			<div class="col-xs-12 col-md-4">
				<div class="form-group">
					<label for="curso_id">Cursos Disponibles</label>
					<select required id="curso_id" name="curso_id" class="form-control select2" onchange="getCursoApertura()" style="width: 100%;">
						<option value="" selected="selected">-- Seleccione una opción --</option>
						<?php foreach ($cursos as $c) : ?>
						<option value="<?=$c->id;?>" ><?=$c->nombre;?></option>
						<?php endforeach; ?>
					</select>
				</div>
			</div>

			<div class="col-xs-12 col-md-12" id="table-curso-apertura">
				<p> Cargando ... </p>
			</div>
			
		</div>
	</div>
</div>

<div class="row center-block text-center">
	<div class="col-md-8 col-lg-8 ">
		<div class="form-group">
		     <a class="btn btn-success btn-block btn-lg" id="BtnSave1">ENVIAR INSCRIPCIÓN</a> 
		</div>
	</div>
</div>

</form>

<script type="text/javascript">
    var base_url= "<?php echo base_url();?>"; 
</script>
