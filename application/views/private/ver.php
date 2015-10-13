<meta charset="UTF-8">
<style>
	#correspondencia{
		padding:10px;
	}

	#asunto{
		font-size: 1.2em;
		border-bottom:1px solid #EEE;
	}

	#remitente{
		background-color:#f1f1f1;
		padding:10px 25px 10px 25px;
	}

	#archivos{
		border-top:1px dotted gray;
	}

	#descripcion{
		border-top:1px solid gray;
		padding:25px;
	}

	#fecha_limite{
		float:right;
		margin-bottom:5px;
	}

	#observaciones{
		margin-top: 25px;
		text-align:justify;
	}
.status_oficios{cursor:pointer;}
.img_oficios{width:125px;}
#estatus_creado{background-color:#D0D0D0;width: 100px;height: 100px;text-align:center;padding-top:35px;float: right;}
#estatus_rojo{background-color:#ee1111;color:white;width: 100px;height: 100px;text-align:center;padding-top:35px;float: right;}
#estatus_amarillo{background-color:#ffc40d;width: 100px;height: 100px;text-align:center;padding-top:35px;float: right;}
#estatus_verde{background-color: #00a300;width: 100px;height: 100px;text-align:center;padding-top:35px;float: right;}
#estatus_purpura{background-color:purple;color:white;width: 100px;height: 100px;text-align:center;padding-top:35px;float: right;}
#estatus_default{background:linear-gradient(rgba(7, 70, 217, 0.96), rgba(12, 172, 240, 0.96)) !important;;color:white;width: 100px;height: 100px;text-align:center;padding-top:35px;float: right;}
</style>
<link rel="stylesheet" href="<?=$this->config->base_url();?>fronted/css/bootstrap-3/css/bootstrap.min.css">
<div class="container" style="">
	<div class="row">
		<div class="col-xs-12">

		<div id="correspondencia">
	
		<?php

		/*	if($cor->prioridad == 'urgente'){			
				echo '<div id="prioridad" style="width:50px;height:50px;background-color: green; border-radius: 50%;float:right;"></div>';
			}elseif($cor->prioridad == 'normal'){
					echo '<div id="prioridad" style="width: 50px; height: 50px;background-color:#FFC40D;border-radius:50%;float:right;"></div>';
				}
		*/

		foreach ($oficompletos[0]->result() as $cor){
			if($cor->asunto == null) echo "<p style='font-size:1.3em;'>(Sin Asunto)</p>";
			else echo "<div id='asunto' style='font-size:1.3em;'>".$cor->asunto."</div>";
			
			echo "<div id='remitente'><p style='float: left;font-size:1.2em'>".$cor->remitente."<p><div id='fecha_limite'><b>Num de control:</b> ".$cor->num_control."<br><b>Creado en: </b>";
			echo $cor->fecha_creacion.", ".$cor->hora_creacion."<br><b>Fecha limite: </b>".$cor->fecha_limite."</div><div id='nada' style='clear:both;'></div></div>";
			
			echo "<div id='descripcion' style='text-align:justify;'>".$cor->descripcion."</div>";
							
			echo "<div id='observaciones'><p style='color:#261300;font-size:1.1em;'>Observaciones:</p>".$cor->observacion."</div>";
				switch ($cor->estatus_cor){
					case 'Creado':
						echo "<div id='estatus_creado' class='status_oficios'><span class='glyphicon glyphicon-cog' style='margin-bottom:10px;color:black;font-size:2em;'></span><p class='el_status'>".$cor->estatus_cor."</p></div>";
					break;

					case 'Rechazado':
						echo "<div id='estatus_rojo' class='status_oficios'><span class='glyphicon glyphicon-remove' style='margin-bottom:10px;color:white;font-size:2em;'></span><p class='el_status'>".$cor->estatus_cor."</p></div>";
					break;
					
					case 'Asignado':
						echo "<div id='estatus_purpura' class='status_oficios'><span class='glyphicon glyphicon-user' style='margin-bottom:10px;color:white;font-size:2em;'></span><p class='el_status'>".$cor->estatus_cor."</p></div>";
					break;

					case 'Pendiente':
						echo "<div id='estatus_amarillo' class='status_oficios'><span class='glyphicon glyphicon-pencil' style='margin-bottom:10px;color:black;font-size:2em;'></span><p class='el_status'>".$cor->estatus_cor."</p></div>";
					break;

					case 'Procesado':
						echo "<div id='estatus_verde' class='status_oficios'><span class='glyphicon glyphicon-ok' style='margin-bottom:10px;color:white;font-size:2em;'></span><p class='el_status'>".$cor->estatus_cor."</p></div>";
					break;
					
					default:
						echo "<div id='estatus_default' class='status_oficios'><span class='glyphicon glyphicon-cog' style='margin-bottom:10px;color:white;font-size:2em;'></span><p class='el_status'>En proceso</p></div>";
					break;
				}
				echo '<div class="datamult" style="display:none;"><div class="id_cor_dat">'.$cor->id_cor.'</div><div class="num_control_dat">'.$cor->num_control.'</div><div class="prioridad_dat">'.$cor->prioridad.'</div><div class="fecha_final_dat">'.$cor->fecha_limite.'</div><div class="asunto_dat">'.$cor->asunto.'</div><div class="descripcion_dat">'.strip_tags($cor->descripcion).'</div><div class="observacion_dat">'.strip_tags($cor->observacion).'</div></div>';
			}
		?>		
		
	<div id="archivos">
	<p style='color:#16499A;'>
	<?php
		if($oficompletos[1]->num_rows() == 1){
			
			foreach($oficompletos[1]->result() as $file_info){
				if ($file_info->archivo == null) {
					echo "No hay archivos adjuntos.";
				}else{echo $oficompletos[1]->num_rows()." archivo adjunto";}
			}#fin foreach.
		#fin primer if.
		}else if($oficompletos[1]->num_rows() > 1){
			echo $oficompletos[1]->num_rows()." archivos adjuntos";
		}
		else{
			echo "El documento no tiene adjuntos asociados.";
		}
	?>
		
	</p>

		<?php
		foreach($oficompletos[1]->result() as $campo){

			switch($campo->archivo){
					case null:
						echo "<img src='".$this->config->base_url()."fronted/img/iconos/glyphicons/glyphicons_036_file.png' width=50 >";	
					break;

					case !null:
					//case true:
					/*Validación de los tipos de archivos y zoom jpg añadir clase para imagenes para manipular en jquery y controlador y vista para zoom con ajax*/
					/*
						if(end(explode(".",$campo->archivo)) == "pdf"){
							echo "<a href='".$this->config->base_url()."uploads/$campo->archivo' title='$campo->archivo'><img src='".$this->config->base_url()."fronted/img/iconos/pdf.png'></a>";
						}else{
							echo "<img src='".$this->config->base_url()."uploads/$campo->archivo' class='img_oficios' style='cursor:pointer' data-zoom-image='".$this->config->base_url()."uploads/$campo->archivo'>";
						}
					*/
						$archivo=end(explode(".",$campo->archivo));
							switch ($archivo) {
								case 'jpg':
									echo "<img src='".$this->config->base_url()."uploads/$campo->archivo'  title='Ver imagen $campo->archivo' class='img_oficios' style='cursor:pointer' data-zoom-image='".$this->config->base_url()."uploads/$campo->archivo'>";
								break;

								case 'png':
									echo "<img src='".$this->config->base_url()."uploads/$campo->archivo'  title='Ver imagen $campo->archivo' class='img_oficios' style='cursor:pointer' data-zoom-image='".$this->config->base_url()."uploads/$campo->archivo'>";
								break;

								case 'ods':
									echo "<a href='".$this->config->base_url()."uploads/$campo->archivo' title='Descargar $campo->archivo' ><img src='".$this->config->base_url()."fronted/img/iconos/word-logo.png' width=100 ></a>";
								break;

								case 'odt':
									echo "<a href='".$this->config->base_url()."uploads/$campo->archivo' title='Descargar $campo->archivo'><img src='".$this->config->base_url()."fronted/img/iconos/word-logo.png' width=100 ></a>";
								break;

								case 'doc':
									echo "<a href='".$this->config->base_url()."uploads/$campo->archivo' title='Descargar $campo->archivo'><img src='".$this->config->base_url()."fronted/img/iconos/word-logo.png' width=100 ></a>";
								break;

								case 'docx':
									echo "<a href='".$this->config->base_url()."uploads/$campo->archivo' title='Descargar $campo->archivo'><img src='".$this->config->base_url()."fronted/img/iconos/word-logo.png' width=100 ></a>";
								break;

								case 'pdf':
									echo "<a href='".$this->config->base_url()."uploads/$campo->archivo' title='Descargar $campo->archivo'><img src='".$this->config->base_url()."fronted/img/iconos/pdf.png' width=100 ></a>";
								break;

								case 'xls':
									echo "<a href='".$this->config->base_url()."uploads/$campo->archivo' title='Descargar $campo->archivo'><img src='".$this->config->base_url()."fronted/img/iconos/Excel.png' width=100 ></a>";
								break;

								case 'xlsx':
									echo "<a href='".$this->config->base_url()."uploads/$campo->archivo' title='Descargar $campo->archivo'><img src='".$this->config->base_url()."fronted/img/iconos/Excel.png' width=100 ></a>";
								break;

								default:
									# code...
								break;
							}//switch anidado

							
							
						/*if($archivo == "jpg" or $archivo == "png"){
							echo "<img src='".$this->config->base_url()."uploads/$campo->archivo' class='img_oficios' style='cursor:pointer' data-zoom-image='".$this->config->base_url()."uploads/$campo->archivo'>";
						}else{
							echo "<img src='".$this->config->base_url()."fronted/img/iconos/glyphicons/glyphicons_134_inbox_in.png'>";
						}//if anidado*/

					/*Validación de los tipos de archivos y zoom jpg*/
					break;

					default:
						echo "El documento no tiene archivos asociados";
					break;
				}
		?>
		<?php } ?>


	</div><!--Archivos-->

</div><!--DIV CORRESPONDENCIA-->
</div><!--DIV COL-XS-12-->
</div><!--DIV ROW-->
</div><!--DIV CONTAINER -->
