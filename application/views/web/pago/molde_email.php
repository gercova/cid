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

	<h3>Estimado(a) <?php echo $data_view->estudiante_nombre;?>.</h3>
	<p>Hemos recibido el registro de su pago mediante nuestra web, con el siguiente detalle : </p>

<ul>
	<li><label>Código de registro :</label>  
		<?php echo str_pad($data_view->id_pago, 10, "0", STR_PAD_LEFT); ?>
	</li>
	<li><label>Fecha registro:</label> <?php echo $data_view->fecha_registro; ?></li>

	<li><label>Curso :</label> <?php echo $data_view->curso_nombre; ?></li>
	<li><label>Días :</label> 
		<?php echo $data_view->dias; ?></li>
	<li><label>Horario :</label> 
		<?php echo $data_view->hora_inicio." - ".$data_view->hora_fin; ?></li>
	<li><label>Fecha inicio :</label> <?php echo $data_view->fecha_inicio; ?></p></li>

	<li><label>Datos de comprobante :</label> 
		<br>
		<p>
		<ul>
			<li><label>Fecha : </label><?php echo $data_view->fecha_pago; ?></li>
			<li><label>Descripción : </label><?php echo $data_view->descripcion; ?></li>
			<li><label>Código : </label><?php echo $data_view->codigo; ?></li>
			<li><label>Monto : </label><?php echo $data_view->monto; ?></li>
		</ul>
		</p>
	</li>

	<li><label>Comentario:</label> <?php echo $data_view->comentario; ?></li>
</ul>

<p>*El registro de pago será validado por personal del CTI-UNSM para su pronta actualización. </p>

	<br>

	<p>Saludos cordiales. Por favor no responda este correo.<br>
	<strong>Asistente web CTI-UNSM</strong> <br>
	ctiunsm@unsm.edu.pe <br>
	955-941-992 / 944-929-637
	</p>

</body>



