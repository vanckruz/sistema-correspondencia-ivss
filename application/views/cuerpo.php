<body>
<!--Container 1-->
<div class="header colortema">
	<div class="container colorTema mas">
		
		<div class="row">
			<div class="col-xs-1">
				<div class="fondologo">
					<img src="<?=$this->config->base_url();?>fronted/img/logogrande.png"  width="65" height="65">
				</div>
			</div>

			<div class="col-xs-8 titulo">

  					<h1>IVSS <small style="color:#CCC;"> Sistema de correspondencia</small></h1>

			</div>

			<div class="col-xs-2 rol">
				<p><?=$usuario ?></p>
			</div>
				
			<div class="col-xs-1 rol">
				<div class="user">
					<span class="glyphicon glyphicon-user"></span>
				</div>
			</div>	

		</div>

	</div>
</div>


<!--Container 1-->
	<div class="container">
	<!--Row-->
		<div class="row">
		<!--Container Cuerpo-->
			<div class="col-xs-12" id="load">

<!-- Nav tabs -->
<ul class="nav nav-tabs" role="tablist">
  <li class="active"></span><a href="#home" role="tab" data-toggle="tab"><span class="glyphicon glyphicon-dashboard"> Bandeja de asignaciones</a></li>
  <!--<li><a href="#profile" role="tab" data-toggle="tab"><span class="glyphicon glyphicon glyphicon-file"></span><span class="glyphicon glyphicon glyphicon-star-empty"></span>Importantes</a></li>-->
</ul>

<!-- Tab panes -->
<div class="tab-content">
	<!--Formulario-->
<div class="tab-pane active" id="home">
<!--
posible guia de migas de pan para los usuarios
 <ol class="breadcrumb" style="background-color:#E1EEF4;margin-top:25px;">
  <li><span class="glyphicon glyphicon-home"></span><a href="#">Inicio</a></li>
  <li><span class="glyphicon glyphicon-floppy-disk"></span><a href="#">Registro</a></li>
  <li class="active"><span class="glyphicon glyphicon-list-alt"></span>nuevo</li>
</ol>
-->

<!--Bandeja de asignados con buscador-->
<div id="ultimos_asignados" style="margin-top:16px;font-family:Arial">
<table class="table table-hover table-striped display" id="tablero_asignados">
	<thead>
		<tr>
			<th>num control</th>
			<th>Enviado por</th>
			<th>Asunto</th>
			<th>Fecha asignación</th>
		</tr>
	</thead>

	<tfoot>
		<tr>
			<th>num control</th>
			<th>Enviado por</th>
			<th>Asunto</th>
			<th>Fecha asignación</th>
		</tr>
	</tfoot>
	<tbody>
<?php foreach($oficios_asignados->result() as $asignacion){?>
<?php 
echo "<tr class='fila_data' data-link='".$this->config->base_url()."index.php/verOficios/oficioIndividual/".$asignacion->id_cor."' data-id=".$asignacion->id_cor." >";
echo "<td>".$asignacion->num_control."</td><td>".$asignacion->dir_origen.", ".$asignacion->remitente."</td><td>".$asignacion->asunto."</td><td>".$asignacion->fecha_creacion.", ".$asignacion->hora_creacion."</td></tr>";
}
?>
	</tbody>
</table>
</div>
 <!--Probando la paginación-->

<div id="volver" style="display:none;">
		<span class='glyphicon glyphicon-hand-right'></span> Volver
</div>
<div id="oficioIndividual" style="display:none;">
				
</div>

<!--Respuesta y notificacion-->
	<div id="respuesta" style="display:none;">
		<p style="margin-top:15px;margin-left:21px;width:350px;float:left;">
			<img src="<?=$this->config->base_url();?>fronted/img/logogrande.png" width="30" height="30">
			 Mensajes de procesamiento de este oficio.  <font style="color:blue">>>></font>	
		</p>

		<div class="mensaje_opcion" id="ver_mensaje" style="">
			<p>Mensajes de gestión</p>
			<span class="glyphicon glyphicon-envelope" style="margin-left:50px;"></span>
		</div>
<!--Ver mensajes y fin-->
	</div>

<style>
#ver_mensaje{
margin-top:0px;
padding-left:15px;
height:50px;
width:170px;
float:right;
cursor:pointer;
background:linear-gradient(#ffffff,#dde9f4);
}
#ver_mensaje:hover{
	color:blue;
	border:1px dashed blue;
	font-weight: bold;
}
		#mensajes_oficio{
			display:none;
			position:fixed;
			bottom:0px;
			left:0px;
			z-index:3;
		}
#cabeza_mensaje{
	display:none;
	position:fixed;
	bottom:0px;
	left:0px;
	z-index:3;
	background-color: #555;
	color: white;
	padding: 10px 10px 10px 10px;
	text-shadow: 1px 1px 3px rgba(0,0,0,0.6);
	width:400px;
}	

#chat{
	background-color: #eee;
	margin: 20px auto 0;
	width: 400px;
}
#chat #header-chat{
	background-color: #555;
	color: white;
	padding: 10px 10px 10px 10px;
	text-shadow: 1px 1px 3px rgba(0,0,0,0.6);
}

#caja-mensaje{
	background-color: #A8DCF7;
	margin: 0 auto;
	padding: 10px;
	width: 400px;
}
#caja-mensaje input{
	border: solid 1px #4193BF;
	outline: none;
	padding: 10px;
	width: 310px;
}
#caja-mensaje button{
	border: 0;
	background-color: #4193BF;
	color: white;
	font-size: 16px;
	padding: 8px;
	width: 50px;
}

#chat #mensajes{
	padding: 10px;
	height: 400px;
	width: 400px;
	overflow: hidden;
	overflow-y: scroll 
}

#chat #mensajes .mensaje-autor{
	margin-bottom: 50px;

}
#chat #mensajes .mensaje-autor img, #chat #mensajes .mensaje-amigo img{
	display: inline-block;
	vertical-align: top;
}
#chat #mensajes .mensaje-autor .contenido{
	background-color: white;
	border-radius: 5px;
	box-shadow: 2px 2px 3px rgba(0,0,0,0.3);
	display: inline-block;
	font-size: 13px;
	padding: 15px;
	vertical-align: top;
	width: 280px;
}
#chat #mensajes .mensaje-autor .fecha{
	color: #777;
	font-style: italic;
	font-size: 13px;
	text-align: right;
	margin-right: 35px;
	margin-top: 10px;
}
#chat #mensajes .mensaje-autor .flecha-izquierda{
	display: inline-block;
	margin-right: -6px;
	margin-top: 10px;
	width: 0; 
	height: 0; 
	border-top: 0px solid transparent;
	border-bottom: 15px solid transparent;
	border-right: 15px solid white;
}

#chat #mensajes .mensaje-amigo{
	margin-bottom: 50px;
}
#chat #mensajes .mensaje-amigo .contenido{
	background-color: #3990BF;
	border-radius: 5px;
	color: white;
	display: inline-block;
	font-size: 13px;
	padding: 15px;
	vertical-align: top;
	width: 280px;
}
#chat #mensajes .mensaje-amigo .flecha-derecha{
	display: inline-block;
	margin-left: -6px;
	margin-top: 10px;
	width: 0; 
	height: 0; 
	border-top: 0px solid transparent;
	border-bottom: 15px solid transparent;
	border-left: 15px solid #3990BF;
}
#chat #mensajes .mensaje-amigo img, #chat #mensajes .mensaje-autor img{
	border-radius: 5px;
}
#chat #mensajes .mensaje-amigo .fecha{
	color: #777;
	font-style: italic;
	font-size: 13px;
	text-align: left;
	margin-top: 10px;
}
</style>

	<div id="crear_mensaje" style="display:none;">
		<textarea name="" id="" cols="30" rows="10"></textarea>
	</div>

	<div id="mensajes_oficio">
<!--Mensajes estilo chat de red social :D-->
<div id="chat"><!--inicio chat-->
	<div id="header-chat">
		Mensajes en relación al oficio <span class="glyphicon glyphicon-remove" title="Cerrar Ventana" id="cerrar_mensaje" style="color:white;float:right;cursor:pointer;margin-right:5px;"></span><span class="glyphicon glyphicon-minus" title="ocultar" id="ocultar_mensaje" style="color:white;float:right;cursor:pointer;margin-right:10px;"></span> 
	</div>
	
	<div id="contenido_mensaje"></div>

</div><!--Fin chat-->
<div id="caja-mensaje">
	<input type="text" placeholder="Escribir mensaje..." id="enviarMensaje">
	<button id="botonMensaje">&#8594; </button>
</div>

<!--Fin de Mensajes estilo chat de red social :D-->
	</div>
<!--Respuesta y notificacion-->
	<!--Cabeza de mensaje -->
<div id="cabeza_mensaje">
	Mensajes en relación al oficio <span class="glyphicon glyphicon-remove" title="Cerrar Ventana" id="cerrar_mensaje-abajo" style="color:white;float:right;cursor:pointer;margin-right:5px;"></span><span class="glyphicon glyphicon-minus" title="ocultar" id="mostrar_mensaje-abajo" style="color:white;float:right;cursor:pointer;margin-right:10px;"></span> 	
</div>
<!--Cabeza de mensaje -->
<!--contenido de los oficios respuesta busqueda-->

<!---->
  </div>
  <!--Fin formulario-->

 <!-- <div class="tab-pane" id="profile">
	<script> 
$(document).on("ready",function(){
	$("#img_01").elevateZoom({scrollZoom : true});
});
</script>
		<h1>Oficio 1337-2095 Prueba-oficios:</h1>
		<img id="img_01" src="<?=$this->config->base_url();?>fronted/img/visor/small/oficio.jpg" data-zoom-image="<?=$this->config->base_url();?>fronted/img/visor/large/oficio.jpg"/>
  </div>-->

</div>

</div>
<!-- Fin del contenedor del cuerpo dinamico ajax-->
</div>
<!--Row-->
</div>
<!--Container Cuerpo-->
<!--PIE-->
<div class="container colorTema">
	<div class="row">
		<div class="col-xs-3 col-xs-offset-1">
			<div class="fondologo">
				<img src="<?=$this->config->base_url();?>fronted/img/logogrande.png" width="60" height="60">
			</div>
		</div>

		<div class="col-xs-8">
			<p style="font-size:1em;padding-top:25px;font-family:Arial;color:white;">
				Diseñado por la dirección general de informática del IVSS.<br>
			</p>
						
		</div>
	</div>
</div>
<!--PIE-->
</body>

<script>
	$('#myTab a').click(function (e) {
  e.preventDefault()
  $(this).tab('show')
});

	$(document).on("ready",function (){
		$("#asignados_inicio").on("click",function(){
			location.reload();
		});
		/*Recarga de la pagina*/
		
		$("#registrar").on("click",function(){
			$(".ligthbox").fadeIn();
			$(".ligthbox, html , body").css({"overflow":"auto"});
		});

		$("#cerrar").on("click",function(){
			$(".ligthbox").fadeOut(500);
			$(" html , body").css({"overflow":"auto"});
		});

		$("#ver_docs").on("click",function(){
			$(".vertabla").fadeIn();
		});

		$("#cerrartabla").on("click",function(){
			$(".vertabla").fadeOut(500);
		});

		/*Bandeja de asignados*/
		$("table tbody ").on("click",".fila_data",function(e){
			e.preventDefault();

			var link=$(this).attr("data-link");
			var id=$(this).attr("data-id");
			
			$("#ver_mensaje").attr("data-id",id);

			/*sino get*/
			$.post(link,function(resp){
			$("#oficioIndividual").html(resp);
			});

			$("#ultimos_asignados").slideUp();

			$("#oficioIndividual").slideDown();

			$("#volver").show();

			$("#respuesta").show();	

/*Mensajes de procesamiento oficio efectos*/
$("#ver_mensaje").on("click",function(){

	var id_this=$(this).attr("data-id");
	
	$(this).css({"background":"lime"});
	$(this).html("<p style='font-weight:bold;'>Actualizar Mensajes </p><span class='glyphicon glyphicon-refresh' style='margin-left:50px;'></span>");

	$.post("<?=$this->config->base_url();?>index.php/correspondencia/mensajes/"+id_this+"",function(data){
	$("#contenido_mensaje").html(data); });

	/*
	Se optimizo para no entorpecer la configuración del servidor de desarrollo
	que no acepta multiples peticiones.En caso de querer ver los mensajes cada 1 segundo
	es la siguiente función:
	setInterval(ver_mensajes,500);
	function ver_mensajes(){
		$.post("<?=$this->config->base_url();?>index.php/correspondencia/mensajes/"+id_this+"",function(data){
		$("#contenido_mensaje").html(data); });
	}
	*/
	
	$("#mensajes_oficio").slideDown();
	if($("#mensajes_oficio").css("display") == "none"){
	 	$("#cabeza_mensaje").show();
	}else if($("#mensajes_oficio").css("display") == "block"){
	 	$("#cabeza_mensaje").hide();
	}
	/*fin respuesta click*/

/*Enviar Mensaje*/		
function enviarMensaje(){
	var campoMensaje=$("#enviarMensaje").val();

	id_this=$("#ver_mensaje").attr("data-id");

	if(campoMensaje !=""){
		$.ajax({
		type:"post",
		url:"<?=$this->config->base_url();?>index.php/correspondencia/crearMensaje",
		data:{mensaje:$("#enviarMensaje").val(),id_cor:id_this,autor:"<?=$usuario;?>"},
		}).done(function(){
				$.post("<?=$this->config->base_url();?>index.php/correspondencia/mensajes/"+id_this+"",function(data){
				$("#contenido_mensaje").html(data); });
			});

	$.post("<?=$this->config->base_url();?>index.php/correspondencia/mensajes/"+id_this+"",function(data){
	$("#contenido_mensaje").html(data); });

	}else{
		$("#enviarMensaje").attr("placeholder","Ingresa un texto para el mensaje .......");
	}
}

$("#botonMensaje").on("click",function(){
	enviarMensaje(); 
	$("#enviarMensaje").val("");  
});

$("#enviarMensaje").on("keydown",function(e){
		if(e.keyCode==13){
			enviarMensaje();
			$("#enviarMensaje").val("");  
		}
	});
/*Enviar mensaje*/
});
/*llave de cierre de crear mensaje y abajo ver mensaje*/
});
/*Mensajes de procesamiento oficio efectos*/
/*Ocultar mensaje*/
			$("#ocultar_mensaje").on("click",function(){
				$("#mensajes_oficio").slideUp("fast",function(){
					$("#cabeza_mensaje").show();	
				});
			/*fin respuesta click*/
			});

			 $("#mostrar_mensaje-abajo").on("click",function(){
			 	$("#cabeza_mensaje").hide();
			 	$("#mensajes_oficio").slideDown();
			 });

			 $("#cerrar_mensaje").on("click",function(){
			 	$("#mensajes_oficio").fadeOut();
			 });

			  $("#cerrar_mensaje-abajo").on("click",function(){
			 	$("#cabeza_mensaje").fadeOut();
			 });

/*Mensajes de procesamiento oficio efectos*/
		});

/*Mensajes de procesamiento oficio efectos*/

/*Bandeja de asignados*/
		/*volver*/
			$("#volver").click(function(){
				$("#oficioIndividual").slideUp();
				$("#volver").hide();
				$("#ultimos_asignados").slideDown();
				$("#respuesta").hide();
				$("#mensajes_oficio").hide();
				$("#cabeza_mensaje").hide();
			});
		/*volver*/
		
		/*datatable*/
			  $('#tablero_asignados').dataTable({
			  	"processing": true
			  	});
		/*datatable*/

/*Validaciones del zoom de imagenes*/	
		$("#oficioIndividual").on("click",".container .row .col-xs-12 #correspondencia #archivos .img_oficios",function(ev){

			ev.preventDefault();
			
			 var src=$(this).attr("src");

			// $("#img_zoom").fadeIn(1000);

			// $("#img_zoom_dinamico").attr("src",src);
		
			// $("#img_zoom_dinamico").attr("data-zoom-image",src);
			
			// $("#img_zoom_dinamico").elevateZoom({scrollZoom : true});


					
			$("#zoom_img_contenedor").slideDown(1000);

			$("#descargar").attr("href",$(this).attr("src"));

			$("#marco_img").html("<img src='"+src+"' id='img_zoom_dinamico' data-zoom-image='"+src+"' width=600 >");

			$("#img_zoom_dinamico").elevateZoom({scrollZoom:true});
			
			$("#cerrar_zoom_img").on("click",function(e){
			e.preventDefault();

			$("#img_zoom_dinamico,.zoomLens,.zoomContainer,.zoomWindowContainer").remove();
			$("#zoom_img_contenedor").fadeOut(1000); });	

		});
/*Fin Validaciones del zoom de imagenes*/	
</script>

<style>
/*
.ui-dialog-titlebar,.ui-widget-header{
background:#234181 linear-gradient(#639ACA,#6095C4 20%,#3368A0 60%,#234181 100%);
color: white;
border-radius:0px;
padding: 5px;
box-shadow: 5px 7px 7px #888888;
}
.ui-dialog-content,.ui-widget-content{
background:linear-gradient(#ffffff,#dde9f4);
}
*/
#buscador_tablero{
	border-radius:0px;
}

.inner-addon { 
    position: relative; 
}

/* style icon */
.inner-addon .glyphicon {
  position: absolute;
  padding: 10px;
  pointer-events: none;
}

/* align icon */
.left-addon .glyphicon  { left:  0px;}
.right-addon .glyphicon { right: 0px;}

/* add padding  */
.left-addon input  { padding-left:  34px;}
.right-addon input { padding-right: ;}

#formIngreso{
	top:0;
	left:14%;
	position:absolute;
	margin:auto;
	width:600px;
	height:auto;
	background:white;
	opacity:0.95;
	border-radius:5px;
	z-index:2;
	padding:25px;
	overflow:auto;
}

#cerrarbuscador{
position:absolute;
top:16px;
right:100px;
font-size:2em;
cursor:pointer;
color: rgba(0, 0, 0, 0.7);
}

#cerrar:hover{
color:#ee1111;;
opacity:0.8;
}


#cerrarbuscador:hover{
	color:#ee1111;;
	opacity:0.8;
}

#ventana_al_buscador{
	width:100%;
	height:100%;
	border:0;
	overflow: hidden;
}

.fila_data{
cursor:pointer;
border:1px solid #EEE;
padding:5px;
}

#volver{
	text-align:right;
	cursor:pointer;
	display:none;
	margin-top:16px;
}


#activar_respuesta{

}

#respuesta{
background-color:rgba(0, 0, 255, 0.1);
margin-top:50px;
height: 50px;
/*padding:21px;*/
}
</style>

<script>

</script>

<div id="zoom_img_contenedor" style="display:none;width:100%;height:100%;top:0px;left:0px;background:rgba(0,0,0,0.4);position:fixed;">
		<div id="cerrar_zoom_img" style='position:absolute;right:100px;top:43px;font-size:1.5em;cursor:pointer;color:white;width:25px;height:25px;' title='cerrar'>
			<span class='glyphicon glyphicon-remove'></span>	
		</div>
		
	<a id="descargar" download><button class="btn" style="color:white;position:absolute;right:200px;top:100px;font-size:1.2em;background:#4cae4c;">Descargar</button></a>

		<div id="marco_img" style="margin:auto;width:800px;height:410px;margin-top:150px;">
			
		</div>
</div>


<script type="text/javascript">
window.onload = function () {
    if (typeof history.pushState === "function") {
        history.pushState("jibberish", null, null);
        window.onpopstate = function () {
            history.pushState('newjibberish', null, null);
        };
    }
    else {
        var ignoreHashChange = true;
        window.onhashchange = function () {
            if (!ignoreHashChange) {
                ignoreHashChange = true;
                window.location.hash = Math.random();
            }
            else {
                ignoreHashChange = false;   
            }
        };
    }
}
</script>