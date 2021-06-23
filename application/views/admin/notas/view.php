<div class="row">
	<div class="col-xs-12">
		<b>Codigo</b> <?php echo $apertura->id; ?> <br>
		<b> <?php echo $apertura->curso; ?> </b><br><br>
		<b>Días:</b> <?php echo $apertura->grupo; ?> <br>
		<b>Horario:</b> <?php echo $apertura->hora_ini; ?> ::: <?php echo $apertura->hora_fin; ?><br>
		<b>Fecha:</b> <?php echo $apertura->fecha_ini; ?> ::: <?php echo $apertura->fecha_fin; ?><br>
		<b>Docente: </b> <?php echo  $apertura->docente; ?><br>
		<b>Aula: </b> <?php echo $apertura->aula; ?> <br>
	</div>
</div>
<br>
<div class="row">
	<div class="col-xs-12">
		<table class="table table-bordered table-hover">
			<thead>
				<tr>
					<th style="text-align:center; width: 5%;">####</th>
					<th style="text-align:center; width: 7%;">DNI</th>
					<th style="text-align:center; width: 45%;">APELLIDOS Y NOMBRES</th>
					<th style="text-align:center; width: 48%;">NOTAS</th>
				</tr>
			</thead>
			<tbody>

				<?php  $cont=1;foreach ($nota as $notas) : ?>
					<tr>
						<td>
							<?php echo $cont; $cont=$cont+1; ?>
						</td>
						<td>
							<?php echo $notas->dni; ?>
						</td>
						<td>
							<?php echo $notas->nombre; ?>
						</td>
						<td style="text-align:center;">
							<?php foreach ($jalado as $jalados) : ?>
								<?php if ($notas->idpre == $jalados->idpre) : ?>
									<input type="text" value="<?php echo $jalados->nota ?>" style="width:42px;border:1px solid gray; border-radius:4px; margin-right: 3px; text-align:center" title="<?php echo $jalados->abreviatura; ?>">
								<?php endif; ?>
							<?php endforeach; ?>
						</td>
					</tr>

				<?php endforeach; ?>

			</tbody>
		</table>

	</div>
</div>
<br>
<br>
<br>
<br>
<b>Firama:</b>-----------------------------------<br>
<b>Docente: </b> <?php echo  $apertura->docente; ?><br>
