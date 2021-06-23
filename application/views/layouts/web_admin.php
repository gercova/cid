<?php

include "header.php";

echo $this->layout->css; 

include "aside.php";
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>
			<?= isset($titulo)? $titulo:"" ?>
			<small><?= isset($subtitulo)? $subtitulo:"" ?></small>
		</h1>
	</section>
	<!-- Main content -->
	<section class="content">

	<?php echo $content_for_layout; ?>

	</section>
	<!-- /.content -->
</div>
<!-- /.content-wrapper -->


<!-- Modal informativo -->
<div class="modal fade" id="modal-info">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">Información</h4>
			</div>
			<div class="modal-body">
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Cerrar</button>
			</div>
		</div>
		<!-- /.modal-content -->
	</div>
	<!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<?php

include "web_admin_footer.php";

	echo $this->layout->js; 

?>



