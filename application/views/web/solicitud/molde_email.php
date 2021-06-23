<style type="text/css">
	.campo{
		width: 0.8rem;
	}

    body {font-family: Verdana, Geneva, sans-serif}

    h3 {color:#4C628D}

    label { 
	    float: left; 
	    min-width: 200px; 
	    margin-right: 15px; 
	    text-align: right; 
	    font-size: small;
	}
</style>

<body>

	<h3>Estimado(a) <?php echo $data_view->solicitud_persona;?>: </h3>

	<p>Hemos recibido el registro de solicitud de NUEVO HORARIO mediante nuestra web, con el siguiente detalle : </p>

	<p><strong>*Información registrada :</strong> 

	<ul>
		<li><label>Código de solicitud : </label>  
			<?php echo str_pad($data_view->id, 10, "0", STR_PAD_LEFT); ?>
		</li>

		<li><label>Celular contacto :</label> <?php echo $data_view->solicitud_celular; ?></li>
		<li><label>Correo contacto :</label> <?php echo $data_view->solicitud_correo; ?></li>


		<li><label>Curso :</label> <?php echo $data_view->curso_nombre; ?></li>
		<li><label>Días propuestos :</label>  <br>
		<ul>
			<?php echo ($data_view->lunes == "1") ? '<li>Lunes</li>':''; ?>
			<?php echo ($data_view->martes == 1) ? '<li>Martes</li>':''; ?>
			<?php echo ($data_view->miercoles == 1) ? '<li>Miercoles</li>':''; ?>
			<?php echo ($data_view->jueves == 1) ? '<li>Jueves</li>':''; ?>
			<?php echo ($data_view->viernes == 1) ? '<li>Viernes</li>':''; ?>
			<?php echo ($data_view->sabado == 1) ? '<li>Sabado</li>':''; ?>
			<?php echo ($data_view->domingo == 1) ? '<li>Domingo</li>':''; ?>
		</ul>
		</li>
		<li><label>Hora propuesta :</label> <?php echo $data_view->hora_tentativa; ?></li>
		<li><label>Mensaje :</label> <?php echo $data_view->mensaje; ?></li>

	</ul>

	<p>*El personal del CTI-UNSM se pondrá en contacto con usted, para coordinar su solicitud. </p>

	<br>
	<p>Saludos cordiales. Por favor no responda este correo.<br>
	<strong>Asistente web CTI-UNSM</strong> <br>
	ctiunsm@unsm.edu.pe <br>
	955-941-992 / 944-929-637
	</p>

</body>