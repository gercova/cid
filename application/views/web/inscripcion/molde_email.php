
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
    <h3>Estimado(a) <?php echo $data_view->estudiante_nombre;?>: </h3>

    <p>A nombre de <strong>CTI-UNSM</strong> , le damos la más cordial bienvenida y le agradecemos por participar en el curso "<?php echo $data_view->curso_nombre;?>".</p>

    <p><strong>*Información registrada:</strong> 
	<ul>
		<li><label>Código inscripción : </label> <?php echo str_pad($data_view->id_inscripcion, 10, "0", STR_PAD_LEFT); ?></li>
		<li><label>Nombre Completo : </label><?php echo $data_view->estudiante_nombre; ?></li>
		<li><label>Num. documento : </label><?php echo $data_view->estudiante_num_documento; ?></li>
		<li><label>Correo : </label><?php echo $data_view->estudiante_email; ?></li>
		<li><label>Teléfono(s) : </label><?php echo $data_view->estudiante_celular.' / '.$data_view->estudiante_telefono; ?></li>

		<li><label>Curso : </label><?php echo $data_view->curso_nombre; ?></li>
		<li><label>Sede : <?php echo $data_view->sede_nombre; ?> </label></li>
		<li><label>Día(s) : </label><?php echo $data_view->dias; ?></li>
		<li><label>Horario : </label><?php echo strftime('%I:%M %p',strtotime($data_view->hora_inicio)) ." - ".strftime('%I:%M %p',strtotime($data_view->hora_fin)); ?></li>
		<li><label>Fecha inicio : </label><?php echo  $data_view->fecha_inicio;?></li>
	</ul>
	</p>

	<p class="letras_pequenas">* Es importante validar la información que registró en su inscripción.</p>

	<p class="letras_pequenas">* El pago se debe realizar en el Banco de la Nación, afectando al código correspondiente. Código de pago (pensión de enseñanza): 01843.</p>

	<p class="letras_pequenas">* De haber realizado el depósito correspondiente, puede notificar su pago en el siguiente enlace <a href="https://ctiunsm.pe/siscti/web/pago/" target="_blank"> https://ctiunsm.pe/siscti/web/pago/ </a> y enviarnos la constancia o voucher a uno de los siguiente WhatsApp: 955-941-992 | 944-929-637.</p>

	<p class="letras_pequenas">* Si necesita más información comuníquese usando los correos y teléfonos  indicados al final de este correo.</p>

	<br>

	<p>Saludos cordiales. Por favor no responda este correo.<br>
	<strong>Asistente web CTI-UNSM</strong> <br>
	cti@unsm.edu.pe <br>
	955-941-992 / 944-929-637
	</p>

</body>
</html>