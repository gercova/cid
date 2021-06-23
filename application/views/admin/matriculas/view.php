
<div class="row">
	<div class="col-xs-12">	
		<b>Codigo</b> <?php echo $matricula->id;?> <br>
		<b> <?php echo $matricula->curso;?> </b><br><br>
        <b>Días:</b> <?php echo $matricula->grupo;?> <br>
		<b>Horario:</b> <?php echo $matricula->hora_ini;?> ::: <?php echo $matricula->hora_fin;?><br>
        <b>Fecha:</b> <?php echo $matricula->fecha_ini;?> ::: <?php echo $matricula->fecha_fin;?><br>
		<b>Docente: </b> <?php echo  $matricula->docente;?><br>
        <b>Aula: </b> <?php echo $matricula->aula;?> <br>
	</div>	
</div>
<br>
<div class="row">
	<div class="col-xs-12">
		<table id="example1" class="table table-bordered table-hover">
			<thead>
				<tr>
				<th>N°</th>
                <th>DNI</th>
                <th>APELLIDOS Y NOMBRES</th>
                
				<th>CELULAR</th>
				</tr>
			</thead>
			<tbody>
				<?php $con=0; foreach($prematriculado as $prematriculados):?>
				<tr>
				<?php $con=$con+1;?>
					<td><?php echo $con;?></td>
					<td><?php echo $prematriculados->dni;?></td>
					<td><?php echo $prematriculados->nombre;?></td>
					
					<td><?php echo $prematriculados->celular;?></td>
					
				</tr>
				<?php endforeach;?>
			</tbody>
			<tfoot>
				<tr>
					<td colspan="3" class="text-right"><strong>Total de Matriculados:</strong></td>
					<td  class="text-right"><strong> <?php echo $con;?></strong></td>
				</tr>
			</tfoot>
		</table>
	</div>
</div>