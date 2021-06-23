<style type="text/css">
	.campo{
		width: 0.8rem;
	}
</style>

<p> <strong>Identificador de la solicitud:</strong>  <?php echo $data_view->id; ?></p>
<p><strong>Fecha :</strong> <?php echo $data_view->fecha_server; ?></p>
<p><strong>Curso :</strong> <?php echo $data_view->curso_nombre; ?></p>
<p><strong>Interesado:</strong> <?php echo $data_view->solicitud_persona; ?></p>
<p><strong>Celular:</strong> <?php echo $data_view->solicitud_celular; ?></p>
<p><strong>Correo:</strong> <?php echo $data_view->solicitud_correo; ?></p>


<p><strong>Días propuestos:</strong> 
	<ul>
		<?php echo ($data_view->lunes == "1") ? '<li>Lunes</li>':''; ?>
		<?php echo ($data_view->martes == 1) ? '<li>Martes</li>':''; ?>
		<?php echo ($data_view->miercoles == 1) ? '<li>Miercoles</li>':''; ?>
		<?php echo ($data_view->jueves == 1) ? '<li>Jueves</li>':''; ?>
		<?php echo ($data_view->viernes == 1) ? '<li>Viernes</li>':''; ?>
		<?php echo ($data_view->sabado == 1) ? '<li>Sabado</li>':''; ?>
		<?php echo ($data_view->domingo == 1) ? '<li>Domingo</li>':''; ?>
	</ul>

</p>

<p><strong>Hora propuesta:</strong> <?php echo $data_view->hora_tentativa; ?></p>
<p><strong>Mensaje:</strong> <?php echo $data_view->mensaje; ?></p>


