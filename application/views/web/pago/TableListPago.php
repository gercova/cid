 <?php 
  ?>
<table class="table table-bordered table-striped">
	<tr>
        <th>Curso</th>
        <th>Horario</th>
        <th>Inicio</th>
        <th>Pago pendiente</th>
        <th>#</th>
	</tr>

	<?php if (count($list_pago)>0): ?>
	<?php foreach ($list_pago as $lp) : ?>
	<tr>
		<td><?= $lp['curso'] ?></td>
		<td><?= $lp['dias']." ". strftime('%H:%M',strtotime($lp['hora_inicio']))." a ".strftime('%H:%M',strtotime($lp['hora_fin'])) ?></td>
		<td><?= fechaES(strftime('%d de %B',strtotime($lp['fecha_inicio'])))  ?></td>
		<td><h4><?= 'S/. '.number_format($lp['deuda'],2) ?></h4></td>
		<td> <input type="radio" name="prematricula_id" id="prematricula_id" value="<?= $lp['id_pre'] ?>" checked> </td>
	</tr>
	
	<?php endforeach; ?>
	<tr>
		<td colspan="5">
		* Marqué el pago pendiente que desea registrar
		</td>
	</tr>
	<?php else: ?>
		<tr>
            <td></td>
            <td colspan="4" style="text-align: center">
	            <h3>No se ha encontrado ningún pago pendiente.</h3>
            </td>
        </tr>

	<?php endif; ?>

</table>



<script type="text/javascript">

	var cant_list_pagos_pendientes = "<?php echo count($list_pago);?>"; 

	Swal.fire({
            icon: "success",
            title: "Se han encontrado " +cant_list_pagos_pendientes+" pago(s) pendiente(s)." ,
        });
</script>