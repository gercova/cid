
<div class="row">
	<div class="col-xs-6">	
		<b>CURSO</b><br>
		<b>Nombre:</b> <?php echo $curso->nombre;?> <br>
		<b>Costo:</b> <?php echo $curso->costo;?><br>
	</div>	
</div>
<br>
<div class="row">
	<div class="col-xs-12">
		<table class="table table-bordered">
			<thead>
				<tr>
					<th>Codigo</th>
					<th>Nombre</th>
					<th>Abreviatura</th>
					<th>Horas</th>
				</tr>
			</thead>
			<tbody>
				<?php $suma=0;foreach($modulo as $modulos):?>
				<tr>
					<td><?php echo $modulos->id;?></td>
					<td><?php echo $modulos->nombre;?></td>
					<td><?php echo $modulos->abreviatura;?></td>
					<td><?php echo $modulos->hora;?></td>
					<?php $suma=$modulos->hora + $suma;?>
				</tr>
				<?php endforeach;?>
			</tbody>
			<tfoot>
				<tr>
					<td colspan="3" class="text-right"><strong>Total de Horas:</strong></td>
					<td><?php echo $suma;?></td>
				</tr>
			</tfoot>
		</table>
	</div>
</div>