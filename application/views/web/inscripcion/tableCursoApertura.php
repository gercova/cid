<?php

?>

<table class="table table-bordered table-hover">
	<tr>
		<th style="width: 10px">#</th>
		<th>DÍAS </th>
		<th>HORARIO</th>
		<th>INICIO DE CURSO</th>
	</tr>

	<?php if (empty($curso_id) || $curso_id == "none"): ?>
	<tr>
		<td></td>
		<td colspan="3" style="text-align: left"> 
            <h4>Seleccione un curso para cargar los 
                <b> HORARIOS DISPONIBLES </b>. 
            </h4>

            <!--button type="button" class="btn btn-info btn-view-info" onclick="crearSolicitud()">
		        <span class="fa fa-plus"></span> CREAR SOLICITUD DE APERTURA (NUEVO HORARIO)
		    </button-->

		    <a onclick="crearSolicitud()" style="cursor: pointer;"> Quiero proponer un NUEVO HORARIO </a>
        </td>
	</tr>

	<?php elseif (empty($curso_aperturas)) : ?>
	<tr>
		<td></td>
		<td colspan="3" style="text-align: left">
			<h4>- No se ha encontrado ningún horario disponible.
      </h4>
			<h4>- Puede crear una solicitud de apertura del curso, donde podrá ingresar un horario tentativo.                    
      </h4>

     <!--button type="button" class="btn btn-info btn-view-info" onclick="crearSolicitud()">
		        <span class="fa fa-plus"></span> CREAR SOLICITUD DE APERTURA (NUEVO HORARIO)
		    </button-->

		    <a onclick="crearSolicitud()" style="cursor: pointer;"> Si deseas proponer un NUEVO HORARIO (Presiona aquí)  </a>
		</td>
	</tr>

	<?php elseif (!empty($curso_aperturas)) : ?>

	<?php foreach ($curso_aperturas as $value) : ?>
	<tr>
		<td><input type="radio" name="apertura_id" id="apertura_id" value="<?= $value['apertura_id'] ?>" checked> </td>
		<td><?= $value['dias'] ?></td>
		<td><?= strftime('%I:%M %p',strtotime($value['hora_inicio']))." a ".strftime('%I:%M %p',strtotime($value['hora_fin'])) ?></td>
		<td><?= fechaES(strftime('%d de %B',strtotime($value['fecha_inicio'])))  ?></td>
	</tr>    
	<?php endforeach; ?>
  <tr>
      <td colspan="4">
          <!--button type="button" class="btn btn-info btn-view-info" onclick="crearSolicitud()">
		        <span class="fa fa-plus"></span> CREAR SOLICITUD DE APERTURA (NUEVO HORARIO)
		    </button-->

		    <a onclick="crearSolicitud()" style="cursor: pointer;"> Si deseas proponer un NUEVO HORARIO (Presiona aquí)  </a>
      </td>
  </tr>
	<?php endif; ?>

</table>
