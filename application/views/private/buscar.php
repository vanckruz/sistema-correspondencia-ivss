<script src="<?=$this->config->base_url()?>fronted/js/jquery-2.1.1.min.js"></script>
<script>
$(document).on("ready",function(){
function buscar(){
	var cadenaBusqueda=$("#buscar").val();
	if(cadenaBusqueda != ""){
$.post("<?=$this->config->base_url();?>index.php/buscar/results",{buscar:$("#buscar").val()},function(resp){
	$("#respuesta").html(resp);});
	}else{$("#mensajeBusqueda").html("Por favor ingresa palabras claves de busqueda.");}
/*
Con el operador ternario:
cadenaBusqueda=(cadenaBusqueda !="")? $.post("<?=$this->config->base_url();?>index.php/buscar/results",{buscar:$("#buscar").val()},function(resp){
$("#respuesta").html(resp);}):$("#mensajeBusqueda").html("Por favor ingresa palabras claves de busqueda.");
*/	
}

$("#buscador").on("click",function(){
	buscar();   
});

$("#buscar").on("keydown",function(e){
		if(e.keyCode==13)
		{
		buscar();
		}
	});
/*Fin del evento ready !*/
});
</script>
<link rel="stylesheet" href="<?=$this->config->base_url();?>fronted/css/bootstrap-3/css/bootstrap.css">

<div style="width:100%;height:70px;background-color:#f1f1f1;padding:20px;">
<div class="container" style="">
	<!--Buscador-->

<div class="row">
		<div class="col-xs-1">
			<img src="<?=$this->config->base_url();?>fronted/img/logogrande.png" width="40" title="IVSS">
		</div>

	<div class="col-xs-9">		
		<input type="search" name="buscar" id="buscar" class="form-control" placeholder="Busquedas por asunto, fecha en formato AAAA-MM-DD, num control, usuarios, archivos." style="float:left;width:90%;border-radius:0px 0px 0px 0px !important;">
		<button class="btn" id="buscador" style="linear-gradient(top,#4387fd,#4683ea);background-color:#4285f4;height:34px;width:60px;font-size:1.2em;float:left;color:white;border-radius:0px 5px 5px 0px !important;">
			<span class="glyphicon glyphicon-search"></span>
		</button>
	</div>

</div>
	<!--Buscador-->		
</div>
</div>

<div class="container" style="height:50px;">
	<div class="row">
	 	<div class="col-xs-12">
	 		
 		</div>
 	</div>
</div>

<div class="container">
	<div class="row">
		<div class="col-xs-10">
			
			<div class="list-group" id="respuesta">
				<p id="mensajeBusqueda" style="color:gray;"></p>
			</div>
			<!--Lista de grupo de los resultados-->
		</div>
	</div>
</div>