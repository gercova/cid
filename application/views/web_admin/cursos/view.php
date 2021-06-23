<p><strong>Codigo:</strong> <?php echo $data_view->codigo_curso; ?></p>
<p><strong>Nombre:</strong> <?php echo $data_view->nombre_curso; ?></p>
<p><strong>Descripcion:</strong> <?php echo $data_view->descripcion_curso; ?></p>
<p><strong>Abreviatura:</strong> <?php echo $data_view->abreviatura_curso; ?></p>
<p><strong>Enlace Web:</strong> <?php echo $data_view->enlace_web_curso; ?></p>
<p><strong>Enlace web Informacion:</strong> <?php echo $data_view->enlace_web_informacion_curso; ?></p>

<p><strong>Estado:</strong> <?php echo $data_view->estado; ?></p>

<p><strong>Creado:</strong> <?php echo $data_view->fecha_creacion; ?></p>

<p><img  style="max-width: 100%" src="<?= $upload_path.$data_view->imagen_curso ?>" alt="Imagen de <?=$data_view->nombre_curso?>"></p>


