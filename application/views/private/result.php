<?php
if($busqueda_asignados->num_rows() > 0){
	if($busqueda_asignados->num_rows()==1){echo "<p style='color:gray;' id='mensaje_busqueda'>Se han encontrado ".$busqueda_asignados->num_rows()." resultado.</p>";}else{echo "<p style='color:gray;' id='mensaje_busqueda'>Se han encontrado ".$busqueda_asignados->num_rows()." resultados.</p>";}
}else if(empty($busqueda_asignados->result())){
 echo "<p style='color:gray;'>No se han encontrado resultados.</p>";
}

 foreach($busqueda_asignados->result() as $item){?>
		<?php echo "<div class='fila_data' data-link='".$this->config->base_url()."index.php/verOficios/oficioIndividual/".$item->id_cor."'><pre>".$item->fecha_creacion.", ".$item->hora_creacion."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".$item->dir_origen.", ".$item->remitente."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".$item->asunto."</pre></div>";?>	
<?php }?>