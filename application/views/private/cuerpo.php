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

<?php echo $menu; ?>
<!--Container 1-->
	<div class="container">
	<!--Row-->
		<div class="row">
		<!--Container Cuerpo-->
			<div class="col-xs-12" id="load">

<!-- Nav tabs -->
<ul class="nav nav-tabs" role="tablist">
  <li class="active"></span><a href="#home" role="tab" data-toggle="tab"><span class="glyphicon glyphicon-dashboard"> Asignación individual</a></li>
  <li><a href="#profile" role="tab" data-toggle="tab"><span class="glyphicon glyphicon-inbox"></span></span>  Oficios asignados a la dependencia</a></li>
  <li><a href="#oficioscontrol" role="tab" data-toggle="tab"><span class="glyphicon glyphicon-list-alt"></span>  Control de asignaciones</a></li>
  <li><a href="#estadisticas" role="tab" data-toggle="tab"><span class="glyphicon glyphicon-indent-right" style="font-size:1.3em;"></span> Analisis de oficios</a></li>
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
			<th>Fecha creación</th>
		</tr>
	</thead>

	<tfoot>
		<tr>
			<th>num control</th>
			<th>Enviado por</th>
			<th>Asunto</th>
			<th>Fecha creación</th>
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
<!--Paginación-->

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
			<p>Ver Mensajes</p>
			<span class="glyphicon glyphicon-envelope" style="margin-left:50px;"></span>
		</div>
<!--Ver mensajes y fin-->
	</div>

<style>
#menu{
		width: 160px;
		height:auto;
		position: absolute;
		/*z-index:1;*/
		top:80px;
		margin-left:0px;
		background-color:white;/* #3b5998;*/
		border-radius: 0px 20px 20px 0px;
		font-size:1.1em;
	}

#menuLateral li span{
 color:black;
}
/*	#menuLateral{
		list-style:none;
		display:block;
	}

	#menuLateral li{
		margin-top: 25px;
		padding:5px 0px 5px 0px;
		cursor:pointer;
	}

	#menuLateral li p span{
		color:black !important;
	}

	#menuLateral li:hover{
		border-left: 5px solid #3b5998;
	}*/

#menu ul li{
	cursor:pointer;
}
#ver_mensaje,#ver_mensaje2{
margin-top:0px;
padding-left:20px;
height:50px;
width:170px;
float:right;
cursor:pointer;
background:linear-gradient(#ffffff,#dde9f4);
}
#ver_mensaje:hover,#ver_mensaje2:hover{
	color:blue;
	border:1px dashed blue;
	font-weight: bold;
}
		#mensajes_oficio,#mensajes_oficio2{
			display:none;
			position:fixed;
			bottom:0px;
			left:0px;
			z-index:3;
		}
#cabeza_mensaje,#cabeza_mensaje2{
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

#chat,#chat2{
	background-color: #eee;
	margin: 20px auto 0;
	width: 400px;
}

#chat #header-chat,#chat2 #header-chat2{
	background-color: #555;
	color: white;
	padding: 10px 10px 10px 10px;
	text-shadow: 1px 1px 3px rgba(0,0,0,0.6);
}

#caja-mensaje,#caja-mensaje2{
	background-color: #A8DCF7;
	margin: 0 auto;
	padding: 10px;
	width: 400px;
}
#caja-mensaje input,#caja-mensaje2 input{
	border: solid 1px #4193BF;
	outline: none;
	padding: 10px;
	width: 310px;
}
#caja-mensaje button,#caja-mensaje2 button{
	border: 0;
	background-color: #4193BF;
	color: white;
	font-size: 16px;
	padding: 8px;
	width: 50px;
}

#chat #mensajes,#chat2 .mensajescontent{
	padding: 10px;
	height: 400px;
	width: 400px;
	overflow: hidden;
	overflow-y: scroll 
}

#chat #mensajes .mensaje-autor,#chat2 .mensajescontent .mensaje-autor{
	margin-bottom: 50px;

}
#chat #mensajes .mensaje-autor img, #chat #mensajes .mensaje-amigo img,#chat2 .mensajescontent .mensaje-autor img, #chat2 .mensajescontent .mensaje-amigo img{
	display: inline-block;
	vertical-align: top;
}
#chat #mensajes .mensaje-autor .contenido,#chat2 .mensajescontent .mensaje-autor .contenido{
	background-color: white;
	border-radius: 5px;
	box-shadow: 2px 2px 3px rgba(0,0,0,0.3);
	display: inline-block;
	font-size: 13px;
	padding: 15px;
	vertical-align: top;
	width: 280px;
}
#chat #mensajes .mensaje-autor .fecha,#chat2 .mensajescontent .mensaje-autor .fecha{
	color: #777;
	font-style: italic;
	font-size: 13px;
	text-align: right;
	margin-right: 35px;
	margin-top: 10px;
}
#chat #mensajes .mensaje-autor .flecha-izquierda,#chat2 .mensajescontent .mensaje-autor .flecha-izquierda{
	display: inline-block;
	margin-right: -6px;
	margin-top: 10px;
	width: 0; 
	height: 0; 
	border-top: 0px solid transparent;
	border-bottom: 15px solid transparent;
	border-right: 15px solid white;
}

#chat #mensajes .mensaje-amigo,#chat2 .mensajescontent .mensaje-amigo{
	margin-bottom: 50px;
}
#chat #mensajes .mensaje-amigo .contenido,#chat2 .mensajescontent .mensaje-amigo .contenido{
	background-color: #3990BF;
	border-radius: 5px;
	color: white;
	display: inline-block;
	font-size: 13px;
	padding: 15px;
	vertical-align: top;
	width: 280px;
}
#chat #mensajes .mensaje-amigo .flecha-derecha,#chat2 .mensajescontent .mensaje-amigo .flecha-derecha{
	display: inline-block;
	margin-left: -6px;
	margin-top: 10px;
	width: 0; 
	height: 0; 
	border-top: 0px solid transparent;
	border-bottom: 15px solid transparent;
	border-left: 15px solid #3990BF;
}
#chat #mensajes .mensaje-amigo img, #chat #mensajes .mensaje-autor img,#chat2 .mensajescontent .mensaje-amigo img, #chat2 .mensajescontent .mensaje-autor img{
	border-radius: 5px;
}
#chat #mensajes .mensaje-amigo .fecha,#chat2 .mensajescontent .mensaje-amigo .fecha{
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

<!--user ldap permisado-->
  <div class="tab-pane" id="profile">
		<div id="ultimos_asignados_grupo" style="margin-top:16px;">	
		
		<table class="table table-hover table-striped display" id="tablero_asignados_grupal">
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
	<?php foreach($oficios_asignados_dependencia as $asignacion_grupal){?>
	<?php 
	echo "<tr class='fila_data2' data-link2='".$this->config->base_url()."index.php/verOficios/oficioIndividual/".$asignacion_grupal->id_cor."' data-id2=".$asignacion_grupal->id_cor." >";
	echo "<td><b>".$asignacion_grupal->num_control."</b></td><td>".$asignacion_grupal->dir_origen.", ".$asignacion_grupal->remitente."</td><td>".$asignacion_grupal->asunto."</td><td>".$asignacion_grupal->fecha_creacion.", ".$asignacion_grupal->hora_creacion."</td></tr>";
	}
	?>
		</tbody>
	</table>
</div><!--Ultimos asignados del grupo-->
	<div id="volver2" style="display:none;">
		<span class='glyphicon glyphicon-hand-right'></span> Volver
	</div>

		<div id="oficioIndividual2" style="display:none;">
				
		</div>

<!--actualizar status-->
	<div id="actualizar_status_cor" style="display:none">
		<form id="form_status" >
		<input type="hidden" name="id_cor_status" id="id_cor_status">
			<select name="status" id="cambiar_status" class="form-control" style="cursor:pointer;width:200px !important;float:right;border-radius:0px;" required>
				<option value="" id="num1">--Cambiar estatus--</option>
				<option value="Creado">Creado</option>
				<option value="Rechazado">Rechazado</option>
				<option value="Asignado">Asignado</option>
				<option value="Pendiente">Pendiente</option>
				<option value="Procesado">Procesado</option>
			</select>
		</form>
	</div>
	<!--actualizar status-->

	<div id="respuesta2" style="display:none;">
		<p style="margin-top:15px;margin-left:21px;width:350px;float:left;">
			<img src="<?=$this->config->base_url();?>fronted/img/logogrande.png" width="30" height="30">
			 Mensajes de procesamiento de este oficio.  <font style="color:blue">>>></font>	
		</p>

		<div class="mensaje_opcion" id="ver_mensaje2" style="">
			<p>Mensajes de gestión</p>
			<span class="glyphicon glyphicon-envelope" style="margin-left:50px;"></span>
		</div>
<!--Ver mensajes y fin-->
	</div>
<br><p style="float:right;color:black;font-size:1.2em;display:none" id="nota_act_mensaje">Nota:si no ves tu mensaje presiona actualizar.</p>
<!--chattwos-->
	<div id="mensajes_oficio2">
<!--Mensajes estilo chat de red social :D-->
<div id="chat2"><!--inicio chat-->
	<div id="header-chat2">
		Mensajes en relación al oficio <span class="glyphicon glyphicon-remove" title="Cerrar Ventana" id="cerrar_mensaje2" style="color:white;float:right;cursor:pointer;margin-right:5px;"></span><span class="glyphicon glyphicon-minus" title="ocultar" id="ocultar_mensaje2" style="color:white;float:right;cursor:pointer;margin-right:10px;"></span> 
	</div>
	
	<!--Aqui se cargan los mensajes con ajax-->
	<div id="contenido_mensaje2">
		
	</div>
	<!--Aqui se cargan los mensajes con ajax-->

</div><!--Fin chat-->
<div id="caja-mensaje2">
	<input type="text" placeholder="Escribir mensaje..." id="enviarMensaje2">
	<button id="botonMensaje2">&#8594; </button>
</div>

<!--Fin de Mensajes estilo chat de red social :D-->
	</div>
<!--Respuesta y notificacion-->
	<!--Cabeza de mensaje -->
<div id="cabeza_mensaje2">
	Mensajes en relación al oficio <span class="glyphicon glyphicon-remove" title="Cerrar Ventana" id="cerrar_mensaje-abajo2" style="color:white;float:right;cursor:pointer;margin-right:5px;"></span><span class="glyphicon glyphicon-minus" title="ocultar" id="mostrar_mensaje-abajo2" style="color:white;float:right;cursor:pointer;margin-right:10px;"></span> 	
</div>
<!--chattwos-->

<!--Asignación-->
<?php 
$CI = &get_instance(); 
$CI->load->model("ivss_model");
$usuarios_ldap_depency=$CI->ivss_model->usuarios_grupos($id_del_grupo)->result();

 ?>
	<div id="asignacion" style="width:550px;padding:16px;margin:auto;margin-top:25px;border:1px dashed gray;display:none;">
		<form action="<?=$this->config->base_url();?>index.php/systemAdmin/asignar" id="form_asignar_asuario" method="post">
			<input type="hidden" id="id_cor" name="id_cor">
		<label for="Asignar" style="float:left;margin-right:20px;">Asignar al usuario: </label>
			<select name="usuario" id="" class="form-control" style="width:200px;float:left;margin-right:25px;border-radius:0px;">	
				<?php foreach($usuarios_ldap_depency as $empleado) { ?>
					<option value="<?=$empleado->id_usuarios?>"><?=$empleado->usuario ?></option>	
				<?php } ?>
			</select>
			<input type="button" id="asignar_a" class="btn" value="Asignar" style="float:left;margin-right:25px;padding:5px;background:#4285f4;padding:10px;color:white;">
		</form><div style="clear:both"></div>
	</div>
<!--Asignación-->	
<script>
$("#asignar_a").on("click",function(){
	alert("El oficio ha sido asignado al usuario indicado");
	$("#form_asignar_asuario").submit();
});
	
/*quitar asignacion*/
$("#lista_asignados tbody .quitar_asignacion").on("mouseover",function(){
 	$(this).css({"color":"red"}).attr("title","Quitar esta asignación");
});

$("#lista_asignados tbody .quitar_asignacion").on("mouseout",function(){
 	$(this).css({"color":"black"});
});

$("#lista_asignados tbody .quitar_asignacion").on("click",function(){

	$("div#alerta_asignacion_minus").dialog({title:"¿Esta usted seguro de eliminar esta asignación?",width:450,modal: true,buttons: true});

	$("#usuario_ldap_asignacion").val($(this).attr("data-user"));
	$("#id_cor_asignacion").val($(this).attr("data-ido"));
	$("#ejecutar_eliminacion_asignacion").val("Remover asignación a "+$(this).attr("data-user"));

	$("#ejecutar_eliminacion_asignacion").on("click",function(e){
		e.preventDefault();
		$("#form_quitar_asignacion").submit();
	});

});
/*quitar asignacion*/
</script>
<!--Fin tab-profile-->
 </div><!--Fin de tab-profile-->
<!--user,ldap permisado oficios grupales-->


<!--////////////////////////////////////////////////////////////////////////////////->
<!--panel de oficios control-->
<div id="oficioscontrol" class="tab-pane">
<style>
	#estatus_inicial{background-color:#D0D0D0;width:100%;height:100%;text-align:center;padding-top:35px;float: right;}
				#estatus_rechazado{background-color:#ee1111;color:white;width:100px;height:100px;text-align:center;padding-top:35px;float: right;}
				#estatus_pendiente{background-color:#ffc40d;width:100px;height:100px;text-align:center;padding-top:35px;float: right;}
				#estatus_procesado{background-color: #00a300;width:100px;height:100px;text-align:center;padding-top:35px;float: right;}
				#estatus_asignado{background-color:purple;color:white;width:100px;height:100px;text-align:center;padding-top:35px;float: right;}
				#estatus_por_defecto{background:linear-gradient(rgba(7, 70, 217, 0.96), rgba(12, 172, 240, 0.96)) !important;;color:white;width:100px;height:100px;text-align:center;padding-top:35px;float: right;}
				#estatus_inicial{background-color:#D0D0D0;width:100px;height:100px;text-align:center;padding-top:35px;float: right;}
</style>
<div style="height:16px;">
	
</div>
	<table id="lista_asignados" class="table" >
					<thead>
						<tr>
							<th>Num control </th>
							<th>Asignado a</th>
							<th>Estado</th>
						</tr>
					</thead>
					
					<tbody>
						<?php 
							foreach ($oficios_asignados_dependencia as $oficios_control) { ?>
							
							<tr>
								<td style="width:200px;"><b><?=$oficios_control->num_control ?></b></td>
								<td><!--Asignado a quien?-->
								<?php
								 
								 //print_r($CI->ivss_model->ver_asignaciones($oficios_control->id_cor)->result());

								 $asignados=$CI->ivss_model->ver_asignaciones($oficios_control->id_cor);

								 if(empty($asignados->result())){
								 	 	echo "Este oficio no ha sido otorgado a un usuario";
								 }else{
								 	 foreach ($asignados->result() as $quien){
									echo "<div style='border:1px solid gray;background-color:#f1f1f1;width:150px;float:left;padding:3px 0px 3px 3px;border-radius:3px;' class='content_asignaciones'>".$quien->usuario."<div style='float:right;' class='quitar_asignacion' data-user='".$quien->usuario."' data-ido='".$oficios_control->id_cor."'><span style='margin-right:3px;font-size:0.9em;cursor:pointer;position:relative;top:0px;right:0px;' class='glyphicon glyphicon-remove'></span></div></div>";
									}//else
								 }

								 ?>
								</td><!--Asignado a quien?-->
								<td style="width:150px;">
									<?php 
										switch ($oficios_control->estatus_cor ) {
											case 'Creado':
												echo "<div id='estatus_inicial' class='estatus_oficios'><span class='glyphicon glyphicon-cog' style='margin-bottom:10px;color:black;font-size:2em;'></span><p class='el_status'>".$oficios_control->estatus_cor."</p></div>";
											break;

											case 'Rechazado':
												echo "<div id='estatus_rechazado' class='estatus_oficios'><span class='glyphicon glyphicon-remove' style='margin-bottom:10px;color:white;font-size:2em;'></span><p class='el_status'>".$oficios_control->estatus_cor."</p></div>";
											break;
					
											case 'Asignado':
												echo "<div id='estatus_asignado' class='estatus_oficios'><span class='glyphicon glyphicon-user' style='margin-bottom:10px;color:white;font-size:2em;'></span><p class='el_status'>".$oficios_control->estatus_cor."</p></div>";
											break;

											case 'Pendiente':
												echo "<div id='estatus_pendiente' class='estatus_oficios'><span class='glyphicon glyphicon-pencil' style='margin-bottom:10px;color:black;font-size:2em;'></span><p class='el_status'>".$oficios_control->estatus_cor."</p></div>";
											break;

											case 'Procesado':
												echo "<div id='estatus_procesado' class='estatus_oficios'><span class='glyphicon glyphicon-ok' style='margin-bottom:10px;color:white;font-size:2em;'></span><p class='el_status'>".$oficios_control->estatus_cor."</p></div>";
											break;
					
											default:
												echo "<div id='estatus_por_defecto' class='estatus_oficios'><span class='glyphicon glyphicon-cog' style='margin-bottom:10px;color:white;font-size:2em;'></span><p class='el_status'>En proceso</p></div>";
											break;
				}
									
									?>
								</td>
							</tr>
						<?php }?>
					</tbody>

					<tfood>
						</tr>
							<th>Num control </th>
							<th>Asignado a</th>
							<th>Estado</th>
						</tr>
					</tfood>
		</table>

</div><!--Oficios control-->

	<!--pestaña estadisticas de usuarios y oficios-->
	<div id="estadisticas" class="tab-pane">
	<div style="height:16px;"></div>
		<table class="table" id="estadisticas_table">
			<thead>
				<tr style="font-size:1.2em;">
					<th>Usuario</th>
					<th>Total asignados</th>
					<th>Listado de asignaciones por numero de control</th>
				</tr>
			</thead>

			<tbody>
		 
			<?php foreach($usuarios_grupos as $empleado_ldap => $valor) { ?>
					<tr>
					<td style="width:200px !important;font-size:1.3em;"><?=$empleado_ldap ?></td>
					<td><?="<div style='color:black;font-size:1.3em;text-align:center'>".$CI->ivss_model->ver_oficios_asignados_usuarioldap($empleado_ldap)->num_rows()."</div>"; ?></td>
					<td id="ver_oficios_asignados_a_este_usuario">
						<ol>
					<?php $asignados_listado=$CI->ivss_model->ver_oficios_asignados_usuarioldap($empleado_ldap)->result()?>
						<?php foreach($asignados_listado as $ver_lista_asignacion){
							echo "<li><div style='width:150px;height:25px;border-radius:5px;border:1px solid #EEE;background.#f1f1f1;padding:3px;color:blue;'>".$ver_lista_asignacion->num_control."</li></div>";
						} ?>
						</ol>
					</td>
		
					</tr>	
				<?php } ?>

			</tbody>

			<tfood>
				<tr>
					<th>Usuario</th>
					<th>Total asignados</th>
					<th>Listado de asignaciones por numero de control</th>
				</tr>
			</tfood>
		</table>
	</div>
	<!--pestaña estadisticas de usuarios y oficios-->

</div><!--Fin pestañero-->

</div>
<!-- Fin del contenedor del cuerpo dinamico ajax-->
</div>
<!--Row-->
</div>
<!--Container Cuerpo-->
<!--PIE-->
<div class="container colorTema">
	<div class="row">
		<div class="col-xs-2 col-xs-offset-1">
			<div class="fondologo">
				<img src="<?=$this->config->base_url();?>fronted/img/logogrande.png" width="60" height="60">
			</div>
		</div>

		<div class="col-xs-9">
			<p style="font-size:1em;padding-top:25px;font-family:Arial;color:white;">
				Diseñado por la dirección general de informática del IVSS. <span class="glyphicon glyphicon-copyright-mark"></span> 2015.<br>
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

/*Bandeja de asignados grupales*/


$("table#tablero_asignados_grupal tbody ").on("click",".fila_data2",function(){
			

			var link2=$(this).attr("data-link2");
			var id2=$(this).attr("data-id2");
			
			$("#ver_mensaje2,#asignacion").attr("data-id",id2);
			$("#id_cor").val($("#asignacion").attr("data-id"));
			$("#id_cor_status").val($("#ver_mensaje2").attr("data-id"));

			$.post(link2,function(resp){
			$("#oficioIndividual2").html(resp);
			});

			$("#ultimos_asignados_grupo").slideUp();

			$("#oficioIndividual2").slideDown();

			$("#volver2").show();

			$("#actualizar_status_cor").show();

			$("#respuesta2").show();

			$("#asignacion").show();

			$("#nota_act_mensaje").show();
		/*volver a bandeja grupal*/
			$("#volver2").click(function(){
				$("#oficioIndividual2").slideUp();
				$("#volver2").hide();
				$("#ultimos_asignados_grupo").slideDown();
				$("#actualizar_status_cor").hide();
				$("#respuesta2").hide();
				$("#mensajes_oficio2").hide();
				$("#cabeza_mensaje2").hide();
				$("#status option#num1").attr("selected","selected");
				$("#asignacion").hide();
				$("#nota_act_mensaje").hide();
			});
		/*volver a bandeja grupal*/

});
/*Bandeja de asignados grupales*/

/*Actualizar status*/

$("#cambiar_status").on("change",function(){
		$.post("<?=$this->config->base_url()?>index.php/systemAdmin/actualizar_status",$("#form_status").serialize(),function(){

		}).done(function(resp){
		
			switch($("#cambiar_status").val()){
			case "Creado":
				$(".status_oficios").css({"background":"#D0D0D0","color":"black"});
				$(".status_oficios").html("<span class='glyphicon glyphicon-cog' style='margin-bottom:10px;color:black;font-size:2em;'></span><p class='el_status'></p>");
				$(".status_oficios .el_status").html($("#cambiar_status").val());
			break;

			case "Rechazado":
				$(".status_oficios").css({"background":"#ee1111","color":"white"});
				$(".status_oficios").html("<span class='glyphicon glyphicon-remove' style='margin-bottom:10px;color:white;font-size:2em;'></span><p class='el_status'></p>");
				$(".status_oficios .el_status").html($("#cambiar_status").val());
			break;

			case "Asignado":
				$(".status_oficios").css({"background":"purple","color":"white"});
				$(".status_oficios").html("<span class='glyphicon glyphicon-user' style='margin-bottom:10px;color:white;font-size:2em;'></span><p class='el_status'></p>");
				$(".status_oficios .el_status").html($("#cambiar_status").val());
			break;

			case "Pendiente":
				$(".status_oficios").css({"background":"#ffc40d","color":"black"});
				$(".status_oficios").html("<span class='glyphicon glyphicon-pencil' style='margin-bottom:10px;color:black;font-size:2em;'></span><p class='el_status'></p>");
				$(".status_oficios .el_status").html($("#cambiar_status").val());
			break;

			case "Procesado":
				$(".status_oficios").css({"background":"#00a300"});
				$(".status_oficios").html("<span class='glyphicon glyphicon-ok' style='margin-bottom:10px;color:white;font-size:2em;'></span><p class='el_status'></p>");	
				$(".status_oficios .el_status").html($("#cambiar_status").val());
			break;
			
			}//switch
			
		});
});
/*actualizar status*/

////////////////////////////////////////////////////////////////////////////////////

/*Mensajes en relación a los oficios todos los usuarios que vean este oficio.*/
$("#ver_mensaje2").on("click",function(){

	//var id_this2=$(this).attr("data-id");
	
	$(this).css({"background":"lime"});
	$(this).html("<p style='font-weight:bold;'>Actualizar Mensajes </p><span class='glyphicon glyphicon-refresh' style='margin-left:50px;'></span>");

	$.post("<?=$this->config->base_url();?>index.php/systemAdmin/mensajes/"+$("#ver_mensaje2").attr("data-id")+"",function(data){
	$("#contenido_mensaje2").html(data); });
	
	$("#mensajes_oficio2").slideDown();
	if($("#mensajes_oficio2").css("display") == "none"){
	 	$("#cabeza_mensaje2").show();
	}else if($("#mensajes_oficio2").css("display") == "block"){
	 	$("#cabeza_mensaje2").hide();
	}
	/*fin respuesta click*/

/*Enviar Mensaje*/		
function enviarMessage(){
	if($("#enviarMensaje2").val() !=""){
		$.ajax({
		type:"post",
		url:"<?=$this->config->base_url();?>index.php/systemAdmin/crearMensaje",
		data:{mensaje:$("#enviarMensaje2").val(),id_cor:$("#ver_mensaje2").attr("data-id"),autor:"<?=$usuario;?>"},
		}).done(function(){
				$.post("<?=$this->config->base_url();?>index.php/systemAdmin/mensajes/"+$("#ver_mensaje2").attr("data-id")+"",function(data2){
				$("#contenido_mensaje2").html(data2); });
			});

	$.post("<?=$this->config->base_url();?>index.php/systemAdmin/mensajes/"+$("#ver_mensaje2").attr("data-id")+"",function(data2){
	$("#contenido_mensaje2").html(data2); });

	}else{
		$("#enviarMensaje2").attr("placeholder","Ingresa un texto para el mensaje .......");
	}
}

$("#botonMensaje2").on("click",function(){
	enviarMessage();
	$("#enviarMensaje2").val("");  
});

$("#enviarMensaje2").on("keydown",function(e){
		if(e.keyCode==13){
			enviarMessage();
			$("#enviarMensaje2").val("");  
		}
	});
/*Enviar mensaje*/

/*control de la ventanita de chat*/
	$("#ocultar_mensaje2").on("click",function(){
				$("#mensajes_oficio2").slideUp("fast",function(){
					$("#cabeza_mensaje2").show();	
				});
			/*fin respuesta click*/
			});

			 $("#mostrar_mensaje-abajo2").on("click",function(){
			 	$("#cabeza_mensaje2").hide();
			 	$("#mensajes_oficio2").slideDown();
			 });

			 $("#cerrar_mensaje2").on("click",function(){
			 	$("#mensajes_oficio2").fadeOut();
			 });

			  $("#cerrar_mensaje-abajo2").on("click",function(){
			 	$("#cabeza_mensaje2").fadeOut();
			 });
/*Control de l ventanita de chat*/
});
/*Fin chat grupal 2222*/

	$("#oficioIndividual2").on("click",".container .row .col-xs-12 #correspondencia #archivos .img_oficios",function(ev){

			ev.preventDefault();
			
			 var src=$(this).attr("src");
					
			$("#zoom_img_contenedor").slideDown(1000);

			$("#descargar").attr("href",$(this).attr("src"));

			$("#marco_img").html("<img src='"+src+"' id='img_zoom_dinamico' data-zoom-image='"+src+"' width=600 >");

			$("#img_zoom_dinamico").elevateZoom({scrollZoom:true});
			
			$("#cerrar_zoom_img").on("click",function(e){
			e.preventDefault();

			$("#img_zoom_dinamico,.zoomLens,.zoomContainer,.zoomWindowContainer").remove();
			$("#zoom_img_contenedor").fadeOut(1000); });	

		});
///////////////////////////////////////////////////////////////////////////////////////////
//asignados personal
/*Bandeja de oficios asignados*/
		$("table#tablero_asignados tbody ").on("click",".fila_data",function(e){
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

/*Bandeja de oficios asignados*/

/*Mensajes de procesamiento del oficio y efectos*/
$("#ver_mensaje").on("click",function(){

	//var id_this=$("#ver_mensaje").attr("data-id");
	
	$(this).css({"background":"lime"});
	$(this).html("<p style='font-weight:bold;'>Actualizar Mensajes </p><span class='glyphicon glyphicon-refresh' style='margin-left:50px;'></span>");

	$.post("<?=$this->config->base_url();?>index.php/systemAdmin/mensajes/"+$("#ver_mensaje").attr("data-id")+"",function(data){
	$("#contenido_mensaje").html(data); });

	$("#mensajes_oficio").slideDown();
	if($("#mensajes_oficio").css("display") == "none"){
	 	$("#cabeza_mensaje").show();
	}else if($("#mensajes_oficio").css("display") == "block"){
	 	$("#cabeza_mensaje").hide();
	}
/*Fin respuesta click ver mensajes*/

/*Enviar Mensaje*/		
function enviarMensaje(){
	var campoMensaje=$("#enviarMensaje").val();
	if(campoMensaje !=""){
		$.ajax({
		type:"post",
		url:"<?=$this->config->base_url();?>index.php/systemAdmin/crearMensaje",
		data:{mensaje:$("#enviarMensaje").val(),id_cor:$("#ver_mensaje").attr("data-id"),autor:"<?=$usuario;?>"},
		}).done(function(){
				$.post("<?=$this->config->base_url();?>index.php/systemAdmin/mensajes/"+$("#ver_mensaje").attr("data-id")+"",function(data){
				$("#contenido_mensaje").html(data); });
			});

	$.post("<?=$this->config->base_url();?>index.php/systemAdmin/mensajes/"+$("#ver_mensaje").attr("data-id")+"",function(data){
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
			  $("#tablero_asignados,#tablero_asignados_grupal,#lista_asignados,#estadisticas_table").dataTable({
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
.ligthbox{
	top:0;
	left:0;
	right:0;
	bottom:0;
	position:fixed;
	z-index:1;
	width:100%;
	height:100%;
	overflow:auto;
	outline:0;
	display:none;
	}

#cerrar{
position:absolute;
top:16px;
right:100px;
font-size:2em;
cursor:pointer;
color: rgba(0, 0, 0, 0.7);
}

#cerrar:hover{
color:red;
opacity:0.8;
}

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


::-webkit-scrollbar {
      width:10px;
      border-radius:5px;
}

::-webkit-scrollbar-track {
     background-color:transparent;
}
::-webkit-scrollbar-thumb {
      background-color: rgba(0, 0, 0, 0.2);
}
::-webkit-scrollbar-button {
      background-color: rgba(0, 0, 0, 0.5);
}
::-webkit-scrollbar-corner {
      background-color: black;
}

#formIngreso{
	top:0;
	left:14%;
	position:absolute;
	margin:auto;
	width:600px;
	height:auto;
	/*background:rgba(255,255,255,0.7);*/
	background:#f1f1f1;
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

.fila_data,.fila_data2{
cursor:pointer;
border:1px solid #EEE;
padding:5px;
}

#volver,#volver2{
	text-align:right;
	cursor:pointer;
	display:none;
	margin-top:16px;
}


#activar_respuesta{

}

#respuesta,#respuesta2{
background-color:rgba(0, 0, 255, 0.1);
margin-top:50px;
height: 50px;
/*padding:21px;*/
}
</style>


<div id="zoom_img_contenedor" style="display:none;width:100%;height:100%;top:0px;left:0px;background:rgba(0,0,0,0.4);position:fixed;">
		<div id="cerrar_zoom_img" style='position:absolute;right:100px;top:43px;font-size:1.5em;cursor:pointer;color:white;width:25px;height:25px;' title='cerrar'>
			<span class='glyphicon glyphicon-remove'></span>	
		</div>
		
	<a id="descargar" download><button class="btn" style="color:white;position:absolute;right:200px;top:100px;font-size:1.2em;background:#4cae4c;">Descargar</button></a>

		<div id="marco_img" style="margin:auto;width:800px;height:410px;margin-top:150px;">
			
		</div>
</div>

<div id="alerta_asignacion_minus" style="background:#f1f1f1;width:500px;display:none">
	<form action="<?=$this->config->base_url()?>index.php/systemAdmin/quitar_asignacion" method="post" id="form_quitar_asignacion">
		<input type="hidden" id="usuario_ldap_asignacion" name="usuario_ldap_asignacion">
		<input type="hidden" id="id_cor_asignacion" name="id_cor_asignacion">
	</form>
	<div id="options_asignacion" style="margin:auto;margin-top:25px;width:200px;">
		<input type="button" class="btn btn-danger" value="Remover asignación" id="ejecutar_eliminacion_asignacion">
	</div>
	<div id="mensaje_ejecutar">
		
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