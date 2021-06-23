<p><strong>Identificador evento:</strong> <?php echo $data_view->evento_id; ?></p>
<p><strong>Fecha inicio:</strong> <?php echo $data_view->fecha_inicio; ?></p>
<p><strong>Fecha fin:</strong> <?php echo $data_view->fecha_fin; ?></p>
<p><strong>Titulo:</strong> <?php echo $data_view->titulo_evento; ?></p>
<p><strong>Sub - titulo:</strong> <?php echo $data_view->subtitulo_evento; ?></p>
<p><strong>Descripcion:</strong> <?php echo $data_view->descripcion_evento; ?></p>

<p><strong>Creado:</strong> <?php echo $data_view->fecha_creacion; ?></p>

<p><img  style="max-width: 100%" src="<?= $upload_path.$data_view->imagen_evento ?>" alt="Imagen de <?=$data_view->titulo_evento?>"></p>


