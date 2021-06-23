<p><strong>Identificador del servicio:</strong> <?php echo $data_view->id; ?></p>
<p><strong>Nombre:</strong> <?php echo $data_view->titulo; ?></p>
<p><strong>Descripcion:</strong> <?php echo $data_view->text; ?></p>
<p><strong>Enlace:</strong> <?php echo $data_view->enlace; ?></p>
<p><strong>Creado:</strong> <?php echo $data_view->fecha_creacion; ?></p>

<p><img  style="max-width: 100%" src="<?= $upload_servicio_path.$data_view->imagen ?>" alt="Imagen de <?=$data_view->titulo?>"></p>


