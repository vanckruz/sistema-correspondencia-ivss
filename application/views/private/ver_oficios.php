<link rel="stylesheet" href="http://localhost/Cor_ivss/fronted/css/bootstrap-3/css/bootstrap.css">
<div id="caja_tabla">
<table class="table table-bordered table-responsive table-hover" id="tabla_general">
	<tr>
		<th colspan="9" style="font-size:2em;text-align:center;background-color:#EEE;">
			Control de la correspondencia
		</th>
	</tr>
	<tr>
		<th>Num de control</th>
		<th>Fecha de Creación</th>
		<th>Hora de Creación</th>
		<th>Prioridad</th>
		<th>Remitente</th>
		<th>Asunto</th>
		<th style="text-align:center;">Detalle</th>
		<th>Observaciones</th>
	</tr>

	<?php foreach($oficios->result() as $campo){ ?>
	<tr>
		<td style="text-align:justify;width:50px;overflow:hidden;">
			<?=$campo->num_control ?>
		</td>

		<td style="text-align:justify;width:100px;overflow:hidden;">
			<?=$campo->fecha_creacion ?>
		</td>

		<td style="text-align:justify;width:50px;overflow:hidden;">
			<?=$campo->hora_creacion ?>
		</td>
		
		<td style="text-align:justify;width:50px;overflow:hidden;">
			<?=$campo->prioridad ?>
		</td>

		<td style="text-align:justify;width:50px;overflow:hidden;">
			<?=$campo->remitente ?>
		</td>
					
		<td style="text-align:justify;width:100px;overflow:hidden;">
			<?=$campo->asunto ?>
		</td>

		<td style="text-align:justify;width:350px;overflow:hidden;">
			<?=$campo->descripcion ?>
		</td>
		
		<td style="text-align:justify;width:250px;overflow:hidden;">
			<?=$campo->observacion ?>
		</td>
	</tr>
		<?php }?>
</table>
	 
</div>
