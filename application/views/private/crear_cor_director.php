<?php 

$dependencias = &get_instance(); 
$dependencias->load->model("ivss_model");
$direcciones_generales  = $dependencias->ivss_model->ver_direcciones_generales()->result();
$grupos 				= $dependencias->ivss_model->ver_grupos()->result();
$this_direccion_interna	= $dependencias->ivss_model->ver_direccion_interna_especifica($this->session->userdata("director"))->result();


foreach ($this_direccion_interna as $dir) {
	$id_de_esta_direccion = $dir->id_dir;
	$nombre_direccion     = $dir->nombre;
	$id_dir_general       = $dir->id_dir_general;
} 




$this_direccion_general=$dependencias->ivss_model->ver_direccion_general_especifica($id_dir_general)->result();

foreach ($this_direccion_general as $dir_gen) {
	$correlativo_dir_general = $dir_gen->correlativo_dir_general;
	$siglas_dir_general 	 = $dir_gen->siglas_direccion_general; 	
}


$correlativo_dir_general=str_pad($correlativo_dir_general,10,0,STR_PAD_LEFT);

$correlativo=$siglas_dir_general.$correlativo_dir_general;

?>

<style>
#CrearCorrespondencia input,#CrearCorrespondencia textarea,#CrearCorrespondencia select{
	border-radius:0px;
}

#CrearCorrespondencia textarea{
background: rgba(255,255,255,0.7);
}

#CrearCorrespondencia select{
	cursor: pointer;
}

#CrearCorrespondencia button{
border-radius:0px;
border:1px outset transparent;

}

label{
font-size:1.1em;
}

.cuanto{
	width:400;
	margin-top:5px;
	margin-bottom:5px;
	margin-right:5px;
	float:left;
}

</style>

<div class="ligthbox" style="background:rgba(0,0,0,0.7);">
<span id="cerrar" class="glyphicon glyphicon-remove-sign" title="Cerrar" style="color:white"></span>
<div id="formIngreso" style="width:950px;height:635px;margin-top:25px;border-radius:0px;">
<div class="row" style="border-bottom:1px dotted gray;">
	<div class="col-xs-12">
		<p style="font-size:1.5em">Nuevo registro de correspondencia</p>
	</div>
</div>	
	<form action="<?=$this->config->base_url();?>index.php/director/crear_cor" method="post" name="" id="CrearCorrespondencia" role="form" enctype="multipart/form-data">
<div class="row" style="">

	<div class="col-xs-2">
		<label for="">Prioridad</label><br>
		<div class="radio" style="font-size:1.2em;">
	  		<label>
	  			<input type="radio" name="prioridad" value="normal" checked="checked">Normal
			</label>
		</div>

			<div class="radio" style="font-size:1.2em;">
	  			<label>
	 				<input type="radio" name="prioridad" value="urgente">Urgente
	 			</label>
			</div>
	</div>

	<div class="col-xs-5">
		<label for="">Tipo de correspondencia</label>
		<select name="tipo_cor" class="form-control">
 			<option value="salida">Salida</option>
 			<option value="interna">Interna</option>
  		</select>

  		<label for="">Tipo de documento</label>
			<select name="tipo_doc" class="form-control">
 				<option value="Oficios">Oficios</option>
 				<option value="Memorando">Memorando</option>
 				<option value="Cartas">Cartas</option>
 				<option value="Cartas">Actas</option>
 				<option value="Otros">Otros</option>
  			</select>
	</div>
	
	<div class="col-xs-5">
		<label for="">Numero de correlativo</label>
		<div class="inner-addon left-addon">
			<i class="glyphicon glyphicon-certificate"></i>
			<input type="text" class="form-control" name="num_control" readonly value="<?=$correlativo?>">	
		</div>

		<label for="">Fecha limite</label>
		<div class="inner-addon left-addon">
			<i class="glyphicon glyphicon-calendar"></i>
			<input type="text"  id="date" class="form-control" name="fecha_limite">
		</div>
	</div>
</div>

<input type="hidden" value="<?=$correlativo_dir_general?>" name="correl">
<input type="hidden" value="<?=$id_de_esta_direccion?>" name="id_de_esta_direccion">
<input type="hidden" value="<?=$id_dir_general?>" name="id_dir_gen_ivss">


<div class="row">
	<div class="col-xs-6">
		<label for="">Dirección remitente</label>
		<div class="inner-addon left-addon">
				<i class="glyphicon glyphicon-home"></i>
				<input type="text" class="form-control" name="dir_origen" placeholder="Dirección de salida" value="<?php echo $siglas_dir_general." - ".$nombre_direccion ?>" readonly>
		</div>				
	</div>
	
	<div class="col-xs-6">
		<label for="">Usuario remitente</label>
			<div class="inner-addon left-addon">
				<i class="glyphicon glyphicon-user"></i>
				<input type="text" class="form-control" name="remitente" value="<?=$this->session->userdata('nombre');?>" readonly>
			</div>				
	</div>	
</div>


<div class="row">
	<div class="col-xs-6">
		<label for="">Dirección de destino</label>
			
			<!--Volcado de Direcciones-->
				<select name="dir_destino" id="dir_destino" class="form-control chosen" data-placeholder="Seleccione una dirección de destino.">
					<?php foreach($direcciones_generales as $direccion){ ?>
							<option value="<?=$direccion->nombre_direccion_general?>">
								<?=$direccion->siglas_direccion_general."-".$direccion->nombre_direccion_general?>
							</option>
					<?php } ?>

					<?php /* foreach($grupos as $grupo){ ?>
						<option value="<?=$grupo->nombre_grupo?>">
							<?php
							//Ojo aqui va siglas dir_general - nombre grupo.
								foreach($dependencias->ivss_model->ver_direccion_general_especifica($grupo->id_dir_general)->result() as $direccion_general) {
									echo $direccion_general->siglas_direccion_general." - ".$grupo->nombre_grupo;
								}
							?>
						</option>
					<?php  } */?>
				</select>
			<!--Volcado de Direcciones-->
	</div>

	<div class="col-xs-6">
		<label for="">Asunto</label>
		<div class="inner-addon left-addon">
		<i class="glyphicon glyphicon-envelope"></i>
		<input type="text" class="form-control" placeholder="Asunto de la correspondencia" name="asunto" maxlength="71"></th>	
		</div>
	</div>
</div>



<div style="border:1px dotted grey;margin:10px 0px 10px 0px;"></div>

<div class="row" style="margin-bottom:5px;">
	<div class="col-xs-10 " id="archive" style="height:110px;overflow-y:auto;border-right:1px dashed gray;border-bottom:1px solid gray;padding-bottom:10px;">
	<label for="" style="clear:both;">Adjuntar archivos </label><div style="border:1px dotted grey;margin:10px 0px 10px 0px;"></div>
		<div class="cuanto">
			<div class="inner-addon left-addon">
				<i class="glyphicon glyphicon-folder-open"></i>
				<input type="file" name="archivo[]" class="form-control" style="padding-bottom:10px;">
			</div>
		</div>
	</div>

	<div class="col-xs-2">
		<div id="content_botons" style="margin-top:25px;">
			<button id="mas_file" class="btn btn-primary" title="Agregar otro archivo">
				<span class="glyphicon glyphicon-plus"></span>
			</button>
			<button id="menos_file" class="btn btn-danger" title="Eliminar el ultimo archivo">
				<span class="glyphicon glyphicon-minus"></span>
			</button>
		</div>
	</div>
</div>
		
<div class="row">
	<div class="col-xs-5">
		<label for="">Descripción de la correspondencia</label> 
		<textarea class="form-control cont" style="width:400px;height:85px;margin-right:25px;resize: none" name="descripcion" style="resize:none;">
	
		</textarea>
	</div>
	
	<div class="col-xs-1"></div>
	<div class="col-xs-5">
		<label for=""> Observaciones</label> 
		<textarea class="form-control cont" style="width:400px;height:85px;margin-right:25px;resize: none" name="observaciones">
		
		</textarea>
	</div>

</div>

	<div class="row">
		<div class="col-xs-12">
			<button type="submit" id="crecor" class="btn" value="Guardar" style="float:right;background:#357EBD;padding:3px 7px 3px 7px;font-size:1.2em;color:white;float:right;margin-top:10px;">
		 	Enviar <span class="glyphicon glyphicon-send"></span>
			</button>
		</div>
	</div>
</form>
</div><img src="<?=$this->config->base_url();?>fronted/img/logogrande.png"  style="position:absolute;z-index:2;opacity:0.1;left:910px;width:200px;height:200px;top:30px;transform:rotate(15deg);-moz-transform:rotate(15deg);-webkit-transform:rotate(15deg);">
</div>

<script>
$(document).on("ready",function(){
	$("#dir_destino").chosen({allow_single_deselect: true,width:"425px"});

$("textarea.cont").html("");
$("textarea.cont").jqEasyCounter({	
			'maxChars': 256,
			'maxCharsWarning': 120,
			'msgFontSize': '13px',
			'msgfontcolor': '#000',
			'msgfontfamily': 'verdana',
			'msgtextalign': 'left',
			'msgwarningcolor': '#f00',
			'msgappendmethod': 'insertbefore'				
		});

});
</script>

