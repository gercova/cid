<div class="row">
	<div class="col-xs-12">	
		<b>Codigo Prematricula :</b> <?php echo $prematricula->id;?><br>
		<b>Estudiante :</b> <?php echo $prematricula->nombre;?> <br>
		<b>Curso :</b> <?php echo $prematricula->curso;?><br>
		<b>Grupo :</b> <?php echo $prematricula->grupo;?><br>
		<b>Hora Inicio :</b> <?php echo $prematricula->hora_ini;?>&nbsp;&nbsp; <b>Hora Fin :</b> <?php echo $prematricula->hora_fin;?><br>
		<b>Costo :</b> <?php echo $prematricula->costo;?> &nbsp;&nbsp;<b> Nivel de Estudios :</b> <?php echo $prematricula->nivel." ".$prematricula->porcentaje."%";?><br>
		<b>Descuento :</b> <?php echo $prematricula->descuento;?>&nbsp;&nbsp; <b>Descripcion  :</b> <?php echo $prematricula->descripcion;?><br>
		<b>Monto a Pagar :</b> <?php $motopago=$prematricula->monto; echo $prematricula->monto;?><br>
	</div>	
</div>
<br>

<div class="row">
	<div class="col-xs-12">
		<table class="table table-bordered">
			<thead>
                    <tr> 
                    <th>ID</th>
                    <th>Documento</th>
                     <th>Monto</th>
                    <th>Codigo Boucher</th>
                    <th>Fecha de Pago</th>
                    <th></th>
                </tr>
			</thead>
            <tbody>
                <?php $suma=0;if(!empty($pagocuo)):?>
                    <?php foreach($pagocuo as $pagocuos):?>
                     <tr>
                        <td><?php echo $pagocuos->id;?></td>
                        <td><?php echo $pagocuos->descripcion;?></td>
                        <td><?php echo $pagocuos->monto;?></td>
                        <td><?php echo $pagocuos->codigo;?></td>
                        <td><?php echo $pagocuos->fecha_pago;?></td>
                        <?php $suma=$pagocuos->monto + $suma;?>
                    </tr>
                    <?php endforeach;?>
                    <?php endif;?>
                    </tbody>

			<tfoot>
				<tr>
					<td colspan="2" class="text-right"><strong>Total Pagado:</strong></td>
					<td><?php echo $suma;?></td>
				</tr>
				<tr>
					<td colspan="2" class="text-right"><strong>El Estudiante Debe:</strong></td>
					<td><a style="color: red "><?php echo $total=$motopago-$suma;?></a></td>
				</tr>
			</tfoot>
		</table>
	</div>
</div>