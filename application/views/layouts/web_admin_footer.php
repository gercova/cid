        <footer class="main-footer">
            <div class="pull-right hidden-xs">
                <b>Version</b> 1.0.0
            </div>
            <strong>CTI &copy; 2019 <a href="https://www.unsm.edu.pe">UNSM-T</a></strong>
        </footer>
    </div>
    <!-- ./wrapper -->

<!-- highcharts 3 -->
<!--script src="<?php echo base_url();?>assets/template/highcharts/highcharts.js"></script>
<script src="<?php echo base_url();?>assets/template/highcharts/exporting.js"></script-->

<!-- jQuery 3 -->
<script src="<?php echo base_url();?>assets/template/jquery/unojquery.min.js"></script>
<script src="<?php echo base_url();?>assets/template/jquery/jquery.print.js"></script>
<script src="<?php echo base_url();?>assets/template/jquery-print/jquery.print.js"></script>

<!-- timepicker 3.3.7 -->
<!--script src="<?php echo base_url();?>assets/template/timepicker/bootstrap-timepicker.min.js"></script>
<script src="<?php echo base_url();?>assets/template/timepicker/bootstrap-timepicker.js"></script-->

<!-- Bootstrap 3.3.7 -->
<script src="<?php echo base_url();?>assets/template/bootstrap/js/bootstrap.min.js"></script>
<script src="<?php echo base_url();?>assets/template/jquery-ui/jquery-ui.js"></script>
<!-- SlimScroll -->
<script src="<?php echo base_url();?>assets/template/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- DataTables -->
<script src="<?php echo base_url();?>assets/template/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url();?>assets/template/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>

<!-- data table export  3 -->
<script src="<?php echo base_url();?>assets/template/datatablesexport/js/dataTables.buttons.min.js"></script>
<script src="<?php echo base_url();?>assets/template/datatablesexport/js/buttons.flash.min.js"></script>
<script src="<?php echo base_url();?>assets/template/datatablesexport/js/jszip.min.js"></script>
<script src="<?php echo base_url();?>assets/template/datatablesexport/js/pdfmake.min.js"></script>
<script src="<?php echo base_url();?>assets/template/datatablesexport/js/vfs_fonts.js"></script>
<script src="<?php echo base_url();?>assets/template/datatablesexport/js/buttons.html5.min.js"></script>
<script src="<?php echo base_url();?>assets/template/datatablesexport/js/buttons.print.min.js"></script>


<!-- FastClick -->
<script src="<?php echo base_url();?>assets/template/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="<?php echo base_url();?>assets/template/dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?php echo base_url();?>assets/template/dist/js/demo.js"></script>
<script>

var base_url = "<?php echo base_url();?>";

$(document).ready(function () {
	
	var year = (new Date).getFullYear();
	//  datagrafico(base_url,year);

	$('#data_table').DataTable({
		"language": {
			"lengthMenu": "Mostrar _MENU_ registros por pagina",
			"zeroRecords": "No se encontraron resultados en su busqueda",
			"searchPlaceholder": "Buscar registros",
			"info": "Mostrando registros de _START_ al _END_ de un total de  _TOTAL_ registros",
			"infoEmpty": "No existen registros",
			"infoFiltered": "(filtrado de un total de _MAX_ registros)",
			"search": "Buscar:",
			"paginate": {
				"first": "Primero",
				"last": "Último",
				"next": "Siguiente",
				"previous": "Anterior"
			},
		},
		"order": [[ 0, 'desc' ]]
	});

	

});

$(".btn-view-info").on("click", function(){
		var id = $(this).val();
		var controlador_mantenimiento = $("#controlador_mantenimiento").val();
		
		$.ajax({
			url: base_url + controlador_mantenimiento +"/view/" + id,
			type:"POST",
			success:function(resp){
				$("#modal-info .modal-body").html(resp);
				//alert(resp);
			}

		});

	});


</script>
</body>
</html>
