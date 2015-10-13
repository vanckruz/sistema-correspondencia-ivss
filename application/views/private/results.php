<?php
if($buscor->num_rows() > 0){
echo "<p style='color:gray;' id='mensaje_busqueda'>Se han encontrado ".$buscor->num_rows()." resultados.</p>";
}else if(empty($buscor->result())){
 echo "<p style='color:gray;'>No se han encontrado resultados.</p>";
}

 foreach($buscor->result() as $item){?>
				  <a href="#" class="list-group-item">
				    <h4 class="list-group-item-heading"><?=$item->asunto;?></h4>
				    <p class="list-group-item-text">
						<?=$item->dir_origen;?>,<?=$item->remitente;?><br>
						<?=strtolower(strip_tags(substr($item->descripcion,0,100)));?>...
				    </p>
			      </a>
<?php }?>