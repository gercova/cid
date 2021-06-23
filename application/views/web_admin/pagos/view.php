<style type="text/css">
	.campo{
		width: 0.8rem;
	}
</style>

<p> <strong>Identificador del pago web:</strong>  <?php echo $data_view->id_pago; ?></p>
<p><strong>Fecha registro:</strong> <?php echo $data_view->fecha_registro; ?></p>

<p><strong>Estudiante :</strong> <?php echo $data_view->estudiante_nombre; ?></p>
<p><strong>Estudiante núm. documento :</strong> <?php echo $data_view->estudiante_num_documento; ?></p>

<p><strong>Curso :</strong> <?php echo $data_view->curso_nombre; ?></p>
<p><strong>Horario:</strong> <?php echo $data_view->dias." ".$data_view->hora_inicio." - ".$data_view->hora_fin; ?></p>
<p><strong>Fecha de inicio:</strong> <?php echo $data_view->fecha_inicio; ?></p>

<p><strong>Deuda actual:</strong> <?php echo $data_view->deuda; ?></p>

<p><strong>Datos del comprobante:</strong> 
	<ul>
		<li><strong>Fecha: </strong><?php echo $data_view->fecha_pago; ?></li>
		<li><strong>Descripción: </strong><?php echo $data_view->descripcion; ?></li>
		<li><strong>Codigo: </strong><?php echo $data_view->codigo; ?></li>
		<li><strong>Monto: </strong><?php echo $data_view->monto; ?></li>
	</ul>
</p>

<p><strong>Comentario:</strong> <?php echo $data_view->comentario; ?></p>

<p><img  style="max-width: 100%" src="<?= $upload_path.$data_view->imagen ?>" alt="Imagen de pago web nro. <?=$data_view->id_pago?>">
	<br>
	<a class="btn btn-link" href="<?php echo $upload_path.$data_view->imagen;?>" target="_blank"> Ver imagen completa</a>
</p>




