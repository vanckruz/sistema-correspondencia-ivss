   <form action="<?=$this->config->base_url();?>index.php/crearCorrespondencia" method="post" name="" id="" role="form">
<table class="table">
	<tr style="background-color:#e6e6e6;">
		<th col-span="3">Tipo de correspondencia</th>
		<th col-span="3">Tipo de documento</th>
		<th col-span="3">Prioridad</th>
	</tr>
	<tr>

	    <td>
			<select name="tipo_cor" id="" class="form-control">
 				<option value="salida">Salida</option>
 				<option value="interna">Interna</option>
  			</select>
  		</td>

		<td>
			<select name="tipo_doc" id="" class="form-control">
 				<option value="Oficios">Oficios</option>
 				<option value="Memorando">Memorando</option>
 				<option value="Cartas">Cartas</option>
 				<option value="Otros">Otros</option>
  			</select>
  		</td>
		
		<td>
			<input type="radio" name="prioridad" value="normal">Normal <br>
 			<input type="radio" name="prioridad" value="urgente">Urgente
		</td>
	</tr>

	<tr style="background-color:#e6e6e6;">
		<th colspan="2">Numero de control</th>
		<th>Fecha estimada de revisión</th>
	</tr>

<tr>
	<td colspan="2">
	<input type="number" class="form-control" placeholder="Numero de control" name="num_control">	
	</td>
	
	<td>
		 <input type="datetime"  id="date" class="form-control" name="fecha_limite">
	</td>
</tr>

<tr style="background-color:#e6e6e6;border-radius:5px;">
	<th>Dirección Remitente</th>
	<th colspan="2">usuario remitente</th>
</tr>	
<tr>
	<th><input type="text" class="form-control" name="dir_origen" placeholder="Dirección de salida"></th>
	<th colspan="2"><input type="text" class="form-control" name="remitente" placeholder="Usuario remitente"></th>
</tr>	

<tr style="background-color:#e6e6e6;border-radius:5px;">
	<th>Dirección de destino</th>
	<th colspan="2">Para Usuario</th>
</tr>	
<tr>
	<th><input type="text" class="form-control" name="dir_destino" placeholder="Dirección de destino"></th>
	<th colspan="2"><input type="text" class="form-control" name="destinatario" placeholder="Para el usuario"></th>
</tr>	


<tr style="background-color:#e6e6e6;">
	<th colspan="3">Asunto</th>	
</tr>
<tr>
	<th colspan="3"><input type="text" class="form-control" placeholder="Asunto de la correspondencia" name="asunto"></th>	
</tr>

	<tr style="background-color:#e6e6e6;">
		<th colspan="3">Subir documentos</th>
	</tr>

	<tr>
		<td colspan="3">
			<input type="file" name="archivo" class="form-control" style="padding-bottom:10px;"><br>
		</td>
	</tr>

	<tr style="background-color:#e6e6e6;">
		<th colspan="3">Descripción</th>
	</tr>
	
	<tr>
		<td colspan="3">
		 <textarea class="form-control" id="area1" style="width: 300px; height: 100px;" rows="3" placeholder="Escribe un comentario" name="descripcion">
		 </textarea>
		</td>
	</tr>

	<tr style="background-color:#e6e6e6;">
		<th colspan="3">Observaciones</th>
	</tr>

	<tr>
	 <td colspan="3">
		 <textarea class="form-control" style="width: 300px; height: 100px;" rows="3" placeholder="Escribe un comentario" name="observaciones">
		 </textarea>
	 </td>
	</tr>
	  
	 <tr>
	 	<td colspan="3">
	 		<input type="submit" class="btn btn-primary" value="Guardar" style="float:right;">
	 	</td>
	 </tr>
</table>
</form>	
