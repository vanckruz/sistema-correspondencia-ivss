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
  <li class="active"><a href="#home" role="tab" data-toggle="tab"><span class="glyphicon glyphicon-inbox"> Bandeja de entrada</a></li>
  <li><a href="#oficios_asignados" role="tab" data-toggle="tab"><span class="glyphicon glyphicon-list-alt"></span> Control asignaciones</a></li>
  <li><a href="#profile" role="tab" data-toggle="tab"><span class="glyphicon glyphicon-indent-right" style="font-size:1.3em;"></span> Analisis de correspondencia</a></li>
  <li><a href="#gestion_admin" role="tab" data-toggle="tab"><span class="glyphicon glyphicon-cog"></span> Gestión administrativa</a></li>
</ul>

<!-- Tab panes -->
<div class="tab-content">
	<!--Formulario-->
<div class="tab-pane active" id="home">

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

<!--Upddle-->
	<div id="options_Core" style="display:none;float:left;">
		<!--<div id="menu_ud">
			<button id="tigger_ud" class="btn " style="background:rgba(0, 0, 0, 0.8);color:white;">
				<span class="glyphicon glyphicon-align-justify"></span> Menu
			</button>
		</div>-->
		<div id="ud_edit" style="font-size:1.2em;text-align:center;padding:10px;width:250px;float:left;cursor:pointer;border: 1px solid #6095C4;background: linear-gradient(#639ACA, #6095C4 20%, #3368A0 60%, #234181 100%) repeat scroll 0% 0% #234181;color:white;">
			Editar
		</div>

		<div id="ud_delete" style="font-size:1.2em;text-align:center;padding:10px;width:250px;float:left;cursor:pointer;color:white;border:1px solid red;background:#E11;">
			Eliminar
		</div>

	</div>
		
<!--Upddle-->

<div id="volver" style="display:none;">
	<span class='glyphicon glyphicon-hand-right'></span> Volver
</div>
<div id="oficioIndividual" style="display:none;">
				
</div>

	<!--actualizar status-->
	<div id="actualizar_status_cor" style="display:none" required>
		<form id="form_status" >
		<input type="hidden" name="id_cor_status" id="id_cor_status">
			<select name="status" id="status" class="form-control" style="cursor:pointer;width:200px !important;float:right;border-radius:0px;">
				<option value="">--Cambiar estatus--</option>
				<option value="Creado">Creado</option>
				<option value="Rechazado">Rechazado</option>
				<option value="Asignado">Asignado</option>
				<option value="Pendiente">Pendiente</option>
				<option value="Procesado">Procesado</option>
			</select>
		</form>
	</div>
	<!--actualizar status-->

<!--Respuesta y notificacion-->
<div id="respuesta" style="display:none;">
		<p style="margin-top:15px;margin-left:21px;width:350px;float:left;">
			<img src="<?=$this->config->base_url();?>fronted/img/logogrande.png" width="30" height="30">
			 Mensajes en relación a este oficio.  <font style="color:blue">>>></font>	
		</p>

<div id="vaciar_a_papelera" style="display:none;background:rgba(0,0,0,1,0.5);">
	<div style='margin:auto;margin-top:7px;width:300px;background:#f1f1f1;padding:21px;'>
		<form action="<?=$this->config->base_url()?>index.php/admin_grupo/del_messages" method="post">
			<input type="hidden"  name="id_core_trash" id="id_core_trash">
			<input type="submit" value="Vaciar los mensajes de este oficio" class="btn" style="background:#D43F3A;color:white;border-radius:0px;">
		</form>
	</div>
</div>

<div id="eliminar_mensajes" style="margin-top:0px;padding:11px;height:50px;width:50px;float:right;cursor:pointer;font-size:1.3em;background:darkmagenta;color:white;border:2px outset mediumpurple;" title="Eliminar los mensajes relacionados a este oficio.">
<span class="glyphicon glyphicon-trash"></span>
</div>
		<div class="mensaje_opcion" id="ver_mensaje" style="" title="Ver los mensajes asociados a este oficio.">
			<p>Mensajes del oficio</p>
			<span class="glyphicon glyphicon-envelope" style="font-size:1.2em;padding-left:50px;"></span>
		</div>
<!--Ver mensajes y fin-->

</div><!--Respuesta-->
<!--End div respuesta-->
<p style="float:right;color:black;font-size:1.2em;display:none;width:400px;" id="nota_act_mensaje">Nota:si no ves tu mensaje presiona actualizar.</p>
<!--Asignación-->
	<div id="asignacion" style="width:550px;padding:16px;float:right;margin:auto;margin-top:25px;border:1px dashed gray;display:none;">
		<form action="<?=$this->config->base_url();?>index.php/admin_grupo/asignar" id="form_asignar_asuario" method="post">
			<input type="hidden" id="id_cor" name="id_cor">
		<label for="Asignar" style="float:left;margin-right:20px;">Asignar al usuario: </label>
			<select name="usuario" id="" class="form-control" style="width:200px;float:left;margin-right:25px;border-radius:0px;">	
				<?php foreach($usuarios_grupos as $empleado => $value) { ?>
					<option value="<?=$value?>"><?=$empleado ?></option>	
				<?php } ?>
			</select>
			<input type="button" id="asignar_a" class="btn" value="Asignar" style="float:left;margin-right:25px;padding:5px;background:#4285f4;padding:10px;color:white;">
		</form>
	</div>
<!--Asignación-->


<!--Mensajes-->
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

<!--pestaña muestra los oficios aignados-->
<div class="tab-pane" id="oficios_asignados" style="padding-top:21px;">
		
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
							foreach ($oficios_asignados->result() as $oficios_control) { ?>
							
							<tr>
								<td><?="<b>".$oficios_control->num_control."</b>" ?></td>
								<td id="asignaciones_cell"><!--Asignado a quien?-->
								<?php
								 $CI = &get_instance(); 
								 $CI->load->model("ivss_model");
								 //print_r($CI->ivss_model->ver_asignaciones($oficios_control->id_cor)->result());

								 $asignados=$CI->ivss_model->ver_asignaciones($oficios_control->id_cor);

								 if(empty($asignados->result())){
								 	 	echo "Este oficio no ha sido asignado a un usuario";
								 }else{
								 	 foreach ($asignados->result() as $quien){
									echo "<div style='border:1px solid gray;background-color:#f1f1f1;width:150px;float:left;padding:3px 0px 3px 3px;border-radius:3px;' class='content_asignaciones'>".$quien->usuario."<div style='float:right;' class='quitar_asignacion' data-user='".$quien->usuario."' data-ido='".$oficios_control->id_cor."'><span style='margin-right:3px;font-size:0.9em;cursor:pointer;position:relative;top:0px;right:0px;' class='glyphicon glyphicon-remove'></span></div></div>";
									}//foreach
								 }//else

								 ?>
								</td><!--Asignado a quien?-->
								<td>
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
 </div>
<!--pestaña mustra los oficios asignados-->

<!--pestaña de estadistica-->
  <div class="tab-pane" id="profile" style="padding-bottom:21px;">
		<table class="table" id="estadisticas">
			<thead>
				<tr>
					<th>Usuario</th>
					<th>Total asignados</th>
					<th>Listado de asignaciones por numero de control</th>
				</tr>
			</thead>

			<tbody>
		 
			<?php foreach($usuarios_grupos as $empleado_ldap => $valor) { ?>
					<tr>
					<td><?="<p style='font-size:1.3em;'>".$empleado_ldap."</p>" ?></td>
					<td><?="<div style='color:black;font-size:2em;'>".$CI->ivss_model->ver_oficios_asignados_usuarioldap($empleado_ldap)->num_rows()."</div>"; ?></td>
					<td id="ver_oficios_asignados_a_este_usuario">
					<?php $asignados_listado=$CI->ivss_model->ver_oficios_asignados_usuarioldap($empleado_ldap)->result()?>
						<?php foreach($asignados_listado as $ver_lista_asignacion){
							echo "<div style='width:150px;height:25px;border-radius:5px;border:1px solid #EEE;background.#f1f1f1;padding:3px;color:blue;'>".$ver_lista_asignacion->num_control."</div>";
						} ?>
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
<!--pestaña de estadistica-->

<!--pestaña gestion administrativa-->
<div class="tab-pane" id="gestion_admin" style="width:600px;margin:auto;margin-top:-100px;">
<style>
.user_list{cursor:pointer;}
#mas_user,#menos_user{float:right;border-radius:0px;}
.contenedor_cajas_centrales{width:500px;margin:auto;}
#btn_guardar_user{position:absolute;top:0px;right:0px;border-radius:0px;}
#estatus_inicial{background-color:#D0D0D0;width:100px;height:100px;text-align:center;padding-top:35px;float: right;}
#estatus_rechazado{background-color:#ee1111;color:white;width:100px;height:100px;text-align:center;padding-top:35px;float: right;}
#estatus_pendiente{background-color:#ffc40d;width:100px;height:100px;text-align:center;padding-top:35px;float: right;}
#estatus_procesado{background-color: #00a300;width:100px;height:100px;text-align:center;padding-top:35px;float: right;}
#estatus_asignado{background-color:purple;color:white;width:100px;height:100px;text-align:center;padding-top:35px;float: right;}
#estatus_por_defecto{background:linear-gradient(rgba(7, 70, 217, 0.96), rgba(12, 172, 240, 0.96)) !important;;color:white;width:100px;height:100px;text-align:center;padding-top:35px;float: right;}
</style>

<ul class="nav nav-tabs" role="tablist" style="margin-top:150px;">
  <li class="active"></span><a href="#gestion_usuarios_view" role="tab" data-toggle="tab"><span class="glyphicon glyphicon-user"> Gestión de usuarios</a></li>
  <li><a href="#gestion_permisos_view" role="tab" data-toggle="tab"><span class="glyphicon glyphicon glyphicon-star"></span><span class="glyphicon glyphicon glyphicon-star-empty"></span>Gestión de permisos<span class="glyphicon glyphicon glyphicon-star-empty"></span><span class="glyphicon glyphicon glyphicon-star"></span></a></li>
  </ul>

<!--gestion_usuarios_view-->
<div class="tab-content">
<div id="gestion_usuarios_view" class="tab-pane active">
	<div class="contenedor_cajas_centrales" id="agregar_al_grupo">
	<div id="titulo" style="background:#EEE;color:black;padding:21px;font-size:1.2em;text-align:center;">Asociar usuarios LDAP a esta dependencia</div>
	<form action="<?=$this->config->base_url()?>index.php/admin_grupo/crear_usuarios" id="crear_usuarios" name="crear_usuarios" method="post">
		<input type="hidden" value="<?=$id_del_grupo;?>" name="id_grupo">
		<table style="width:100%;">
        <tr>
          	<td>
				<div class="inner-addon left-addon cuantos_user">
				<i class="glyphicon glyphicon-user"></i>
				<input type="text" name="trabajadores[]" class="form-control usuarios" placeholder="Usuario de ldap IVSS" style="width:100%;border-radius:0px;" required="required">
				</div>
      		</td>

        <td>
			<div class="inner-addon left-addon">
				<i class="glyphicon glyphicon-briefcase"></i>
				<input type="text" name="cargo[]" class="form-control cargos_employes usuarios" placeholder="Cargo del empleado" style="width:100%;border-radius:0px;" required="required">
			</div>
      	</td>
      </tr>
      </table>
      <!--<input type="submit" value="Guardar" class="btn" id="btn_guardar_user" style="position:absolute;top:300px;left:760px;background:#00A300;color:white;font-size:1.3em;">-->
      <button type="submit" class="btn" id="btn_guardar_user" style="position:absolute;top:300px;left:760px;background:#00A300;color:white;font-size:1.3em;"><span class="glyphicon glyphicon-floppy-disk"></span> Guardar</button>
	</form>
		<button id="menos_user" class="btn btn-danger" title="Quitar el ultimo usuario">
			<span class="glyphicon glyphicon-minus"></span>
		</button>
		
		<button id="mas_user" class="btn btn-primary" title="Agregar otro usuario">
			<span class="glyphicon glyphicon-plus"></span>
		</button>
      </div><!--contenedor interno gestion_usuarios_view-->
</div>

<!--gestion_usuarios_view-->
<div id="gestion_permisos_view" class="tab-pane">
	<table class="table table-bordered" style="width:100% !important;background:#f1f1f1;">
		<tr>
			<th style="text-align:center;">Seleccione usuario</th>
			<th style="text-align:center;">Seleccionar permiso</th>
			<th style="text-align:center;">Cambiar permiso</th>
		</tr>

		<tr>
		<form action="admin_grupo/cambiar_rol" method="post" id="cambiar_roles_ldap">
			<td>
				<select name="usuario_ldap_asociado" class="form-control" style="width:200px;float:left;margin-right:25px;border-radius:0px;">	
				<?php foreach($usuarios_grupos as $usuario_permiso => $valor) { ?>
					<option value="<?=$valor?>"><?=$usuario_permiso ?></option>	
				<?php } ?>
				</select>
			</td>
			
			<td>
				<select name="permisologia" class="form-control" style="border-radius:0px;">
					<option value="0">Usuario normal</option>
					<option value="1">Administrador</option>
				</select>
			</td>

			<td>
				<!--<input type="submit" value="Guardar Cambio" class="btn btn-default" id="cambiar_ese_permiso">-->
				<button type="submit" class="btn btn-default" id="cambiar_ese_permiso"><span class="glyphicon glyphicon-floppy-disk"></span> Guardar</button>
			</td>
			</form>
		</tr>
	</table>
	
</div>
<!--gestion_usuarios_view-->

</div><!--Contenedor del panel interno de 3 opciones-->


<!--Contenedor del panel pestaña admin-->

<!------------------------------------------------------>
<script>
	$(document).on("ready",function(a){
		a.preventDefault();
	//alertar cuando se guarda un usuario
		$("#btn_guardar_user").on("click",function(ev){
			ev.preventDefault();
			
			if($("#crear_usuarios .usuarios").val() != ""){	
				$("#crear_usuarios").submit();
				alert("Los usuarios ldap indicados, han sido relacionados con esta dependencia.");
			}else{alert("Por favor, complete todos los campos con la información correcta.");}
		});
	//alertar cuando se guarda un usuario

		//alertar en permisos			
		$("#cambiar_ese_permiso").on("click",function(p){
			p.preventDefault();
			alert("Los permisos del usuarios ldap indicado han sido modificados.");
			$("#cambiar_roles_ldap").submit();

		});
		//alertar en permisos	

/*EDI_ACT_ELI oficio*/
$("#ud_edit").on("click",function(){
	$("#editar_core").dialog({title:"Editar el oficio "+$(".num_control_dat").html(),width:600,modal: true,buttons: true});
	
	$("#fecha_final").datepicker({dateFormat: 'yy-mm-dd'});
		
	$("#id_cor_referens").val($(".id_cor_dat").html());
	$("#fecha_final").val($(".fecha_final_dat").html());
	$("#asunto_edit").val($(".asunto_dat").html());
	$("#descripcion_edit").val($(".descripcion_dat").html());
	$("#observaciones_edit").val($(".observacion_dat").html());
});

$("#ud_delete").on("click",function(){
	$("#hid_core").val($("#options_Core").attr("data-id"));
	$("#eliminar_core").dialog({title:"¿Esta usted seguro de eliminar este oficio?",width:450,modal: true,buttons: true});	
});
/*EDI_ACT_ELI oficio*/


/*quitar asignacion*/
/*
$(".quitar_asignacion").on("mouseover",function(){
 	$(this).css({"color":"red"}).attr("title","Quitar esta asignación");
});

$(".quitar_asignacion").on("mouseout",function(){
 	$(this).css({"color":"black"});
});
*/

$("table#lista_asignados tbody tr td#asignaciones_cell div.content_asignaciones").on("mouseover",".quitar_asignacion",function(){
 	$(this).css({"color":"red"}).attr("title","Quitar esta asignación");
});

$("table#lista_asignados tbody tr td#asignaciones_cell div.content_asignaciones").on("mouseout",".quitar_asignacion",function(){
 	$(this).css({"color":"black"});
});

$("table tbody tr td div.content_asignaciones").on("click",".quitar_asignacion",function(){

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

/*Validación de creación de campos en creacion de usuarios*/
function agregar(){
var miembro="<tr><td><div class='inner-addon left-addon cuantos_user usuarios_rel'>";
	miembro+="<i class='glyphicon glyphicon-user'></i>";
	miembro+="<input type='text' name='trabajadores[]' class='form-control usuarios' placeholder='Usuario de ldap IVSS' style='width:100%;border-radius:0px;'></div></td>";
	miembro+="<td><div class='inner-addon left-addon cargos_employes'><i class='glyphicon glyphicon-briefcase'></i>";
	miembro+="<input type='text' name='cargo[]' class='form-control usuarios' placeholder='Cargo del empleado' style='width:100%;border-radius:0px;'></div></td></tr>";

var nuevo_miembro=$(miembro);
$("#agregar_al_grupo form table").append(nuevo_miembro);
}
//function agregar

		$("#mas_user").on("click",function(e){
			e.preventDefault();
			if($(".cuantos_user").length < 5){agregar();}	
		});

		$("#menos_user").on("click",function(e){
			e.preventDefault();
			if($(".cuantos_user").length > 1){$(".cuantos_user:last,.cargos_employes:last").remove();}
		});
/*Validación de creación de campos en creacion de usuarios*/
		
		/*Validacion para ajax del zoom de imagenes*/	
		$("#oficioIndividual").on("click",".container .row .col-xs-12 #correspondencia #archivos .img_oficios",function(ev){

			ev.preventDefault();
			
			 var src=$(this).attr("src");

			// $("#img_zoom").fadeIn(1000);

			// $("#img_zoom_dinamico").attr("src",src);
		
			// $("#img_zoom_dinamico").attr("data-zoom-image",src);
			
			// $("#img_zoom_dinamico").elevateZoom({scrollZoom : true});

					
			$("#img_zoom").slideDown(1000);

			$("#descargar").attr("href",$(this).attr("src"));

			$("#control_img").html("<img src='"+src+"' id='img_zoom_dinamico' data-zoom-image='"+src+"' width=600 >");

			$("#img_zoom_dinamico").elevateZoom({scrollZoom:true});
				
		});

		$("#cerrar_zoom").on("click",function(e){
			e.preventDefault();
			$("#img_zoom_dinamico,.zoomLens,.zoomContainer,.zoomWindowContainer").remove();
			$("#img_zoom").fadeOut(1000);
		});
		/*Validacion para ajax del zoom de imagenes*/	

});
</script>
<!--___________________________________________________________________________________________-->
		</div>
	<!--pestaña gestion administrativa-->
</div>

</div>
<!-- Fin del contenedor del cuerpo dinamico home-->
</div>

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
	$('#myTab a').click(function(e){
  e.preventDefault()
  $(this).tab('show')
});

	$(document).on("ready",function(evento){
		evento.preventDefault();
		$("#asignados_inicio").on("click",function(){
			location.reload();
		});
		/*Recarga de la pagina*/
		
		$("#registrar").on("click",function(){
			$(".ligthbox").slideDown(500);
			$(".ligthbox, html , body").css({"overflow":"auto"});
		});

		$("#cerrar").on("click",function(){
			$(".ligthbox").toggle("scale",1100);/*effect("explode",{pieces:12});*/
			$(" html , body").css({"overflow":"auto"});
		});

		$("#ver_docs").on("click",function(){
			$(".vertabla").fadeIn();
		});

		$("#cerrartabla").on("click",function(){
			$(".vertabla").fadeOut(500);
		});


/*Actualizar status*/
$("#status").on("change",function(){
		$.post("<?=$this->config->base_url()?>index.php/admin_grupo/actualizar_status",$("#form_status").serialize(),function(){

		}).done(function(resp){
			
			switch($("#status").val()){
			case "Creado":
				$(".status_oficios").css({"background":"#D0D0D0","color":"black"});
				$(".status_oficios").html("<span class='glyphicon glyphicon-cog' style='margin-bottom:10px;color:black;font-size:2em;'></span><p class='el_status'></p>");
				$(".status_oficios .el_status").html($("#status").val());
			break;

			case "Rechazado":
				$(".status_oficios").css({"background":"#ee1111","color":"white"});
				$(".status_oficios").html("<span class='glyphicon glyphicon-remove' style='margin-bottom:10px;color:white;font-size:2em;'></span><p class='el_status'></p>");
				$(".status_oficios .el_status").html($("#status").val());
			break;

			case "Asignado":
				$(".status_oficios").css({"background":"purple","color":"white"});
				$(".status_oficios").html("<span class='glyphicon glyphicon-user' style='margin-bottom:10px;color:white;font-size:2em;'></span><p class='el_status'></p>");
				$(".status_oficios .el_status").html($("#status").val());
			break;

			case "Pendiente":
				$(".status_oficios").css({"background":"#ffc40d","color":"black"});
				$(".status_oficios").html("<span class='glyphicon glyphicon-pencil' style='margin-bottom:10px;color:black;font-size:2em;'></span><p class='el_status'></p>");
				$(".status_oficios .el_status").html($("#status").val());
			break;

			case "Procesado":
				$(".status_oficios").css({"background":"#00a300"});
				$(".status_oficios").html("<span class='glyphicon glyphicon-ok' style='margin-bottom:10px;color:white;font-size:2em;'></span><p class='el_status'></p>");	
				$(".status_oficios .el_status").html($("#status").val());
			break;
			
			}//switch
			
		});
});
/*actualizar status*/

///////////////////////////////////////////////////////////////////////////////////////

		/*Bandeja de asignados*/
		$("table tbody ").on("click",".fila_data",function(e){
			e.preventDefault();

			var link=$(this).attr("data-link");
			var id=$(this).attr("data-id");
						
			$("#ver_mensaje,#asignacion,#id_cor_status,#options_Core,#eliminar_mensajes").attr("data-id",id);
			$("#id_cor").val($("#asignacion").attr("data-id"));

			$("#id_cor_status").val($(this).attr("data-id"));
			
			$("#asignar_a").on("click",function(e){
				e.preventDefault();
					alert("Oficio asignado");
				$("#form_asignar_asuario").submit();
			});

			/*sino get*/
			$.post(link,function(resp){
			$("#oficioIndividual").html(resp);
			});

			$("#ultimos_asignados").slideUp();

			$("#oficioIndividual").slideDown();

			$("#volver").show();

			$("#asignacion").show();

			$("#respuesta").show();	

			$("#actualizar_status_cor").show();
			
			$("#options_Core").show();	

/*Mensajes de procesamiento oficio efectos*/
$("#ver_mensaje").on("mouseover",function(){
	$(this).css({"border":"1px dashed darkgrey"});
});

$("#ver_mensaje").on("mouseout",function(){
	$(this).css({"border":"none"});
});


$("#ver_mensaje").on("click",function(){
var id_this=$(this).attr("data-id");


$.post("<?=$this->config->base_url();?>index.php/admin_grupo/mensajes/"+id_this+"",function(data){
		$("#contenido_mensaje").html(data);});

$(this).css({"background":"lime","border":"1px inset #3c763d"});
	$(this).html("<p style='font-weight:bold;'>Actualizar Mensajes </p><span class='glyphicon glyphicon-refresh' style='margin-left:50px;'></span>");

$("#nota_act_mensaje").show();	
	/*
	setInterval(ver_mensajes,1000);
	function ver_mensajes(){
	$.post("<?=$this->config->base_url();?>index.php/correspondencia/mensajes/"+id_this+"",function(data){
		$("#contenido_mensaje").html(data);});
	}*/
	
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
		url:"<?=$this->config->base_url();?>index.php/admin_grupo/crearMensaje",
		data:{mensaje:$("#enviarMensaje").val(),id_cor:id_this,autor:"<?=$usuario;?>"},
		}).done(function(resp){
					$.post("<?=$this->config->base_url();?>index.php/admin_grupo/mensajes/"+id_this+"",function(data){
					$("#contenido_mensaje").html(data);});
				});
	$.post("<?=$this->config->base_url();?>index.php/admin_grupo/mensajes/"+id_this+"",function(data){
	$("#contenido_mensaje").html(data);});

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

/*Vaciar mensajes*/
$("#eliminar_mensajes").on("click",function(){

	$("#id_core_trash").val($(this).attr("data-id"));
	$("#vaciar_a_papelera").dialog({title:"¿Desea usted eliminar los mensajes en este oficio?",width:450,modal: true,buttons: true});	
});
/*Vaciar mensajes*/

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
				$("#asignacion").hide();
				$("#cabeza_mensaje").hide();
				$("#actualizar_status_cor").hide();
				$("#options_Core").hide();
				$("#nota_act_mensaje").hide();	
			});
		/*volver*/
		
		/*datatable*/
			  $('#tablero_asignados,#lista_asignados,#estadisticas').dataTable({
			  	"processing": true
			  	});
		/*datatable*/

</script>

<style>

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

#ver_mensaje{
margin-top:0px;
padding-left:15px;
height:50px;
width:170px;
float:right;
cursor:pointer;
background:linear-gradient(#ffffff,#dde9f4);
}

#eliminar_mensajes:hover{
border:1px dashed white;
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
	background:#f1f0f0;
	border-radius:5px;
	z-index:2;
	padding:25px;
	/*overflow:auto;*/
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
	width: 100px;
	float: right;
}


#activar_respuesta{

}

#respuesta{
background-color:rgba(0, 0, 255, 0.1);
margin-top:50px;
height: 50px;
/*padding:21px;*/
}

.ligthbox,.vertabla, #ventanabuscar,#ver_grupos{
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

#cerrartabla,#cerrarbuscador,#cerrar{
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

</style>

<div id="img_zoom" style="display:none;width:100%;height:100%;top:0px;left:0px;background:rgba(0,0,0,0.4);position:fixed;">
		<span class='glyphicon glyphicon-remove' id='cerrar_zoom' style='position:absolute;right:100px;top:43px;font-size:1.5em;cursor:pointer;color:white;' title='cerrar'></span>
		<a id="descargar" download><button class="btn" style="color:white;position:absolute;right:200px;top:100px;font-size:1.2em;background:#4cae4c;">Descargar <span class="glyphicon glyphicon-download-alt"></span></button></a>
		<div id="control_img" style="margin:auto;width:800px;height:410px;margin-top:150px;">
			
		</div>
</div>

<div id="alerta_asignacion_minus" style="background:#f1f1f1;width:500px;display:none">
	<form action="<?=$this->config->base_url()?>index.php/admin_grupo/quitar_asignacion" method="post" id="form_quitar_asignacion">
		<input type="hidden" id="usuario_ldap_asignacion" name="usuario_ldap_asignacion">
		<input type="hidden" id="id_cor_asignacion" name="id_cor_asignacion">
	</form>
	<div id="options_asignacion" style="margin:auto;margin-top:25px;width:200px;">
		<input type="button" class="btn" value="Remover asignación" id="ejecutar_eliminacion_asignacion" style="background:#D43F3A;color:white;">
	</div>
	<div id="mensaje_ejecutar">
		
	</div>
</div>

<div style='display:none;background:rgba(0,0,0,0.5);' id='eliminar_core'>
	<div style='margin:auto;margin-top:7px;width:200px;background:#f1f1f1;padding:21px;'>
		<form action="<?=$this->config->base_url()?>index.php/admin_grupo/del_cor" method="post">
			<input type="hidden"  name="id_core" id="hid_core">
			<input type="submit" value="Eliminar este oficio" class="btn" style="background:#D43F3A;color:white;border-radius:0px;">
		</form>
	</div>
</div>

<div id="editar_core" style="background:rgba(0, 0, 0, 0.5);display:none;">
	<div id="div_content_form_dit" style="margin:auto;width:450px;background:#f1f1f1;padding:33px;">
	<p style="font-size:0.8em">Nota: solo se permite modificar los siguientes campos:</p>
	<div style="border:1px solid gray;"></div>
	<form action="<?=$this->config->base_url()?>index.php/admin_grupo/editar_core" method="post">
		<b>Modificar Prioridad:</b> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		
		<div class="radio">
  		<label>
  			<input type="radio" name="prioridad" value="normal" checked="checked">Normal
		</label>
		</div>

		<div class="radio">
  		<label>
  			<input type="radio" name="prioridad" value="urgente">Urgente
		</label>
		</div>

		<div style="margin-bottom:25px;"></div>
			<input type="hidden" id="id_cor_referens" name="id_cor_referens">
		<b>Modificar la fecha final:</b>
		<input type="text" class="form-control" placeholder="Fecha final" name="fecha_final" id="fecha_final" style="border-radius:0px;">
		<b>Modificar el asunto:</b>
		<input type="text" class="form-control" placeholder="Asunto" name="asunto_edit" id="asunto_edit" style="border-radius:0px;">
		 <b>Modificar la Descripción:</b>
		<textarea cols="30" rows="4" class="form-control" placeholder="Coloca una descripción valida para este oficio." name="descrip_edit" id="descripcion_edit" style="border-radius:0px;"></textarea>
		 <b>Modificar Observaciones:</b>
		<textarea cols="30" rows="4" class="form-control" placeholder="Observaciones adicionales." name="observaciones_edit" id="observaciones_edit" style="border-radius:0px;"></textarea>
			
		<button type="submit" class="btn btn-default" style="float:right;margin-top:10px;">
			<span class="glyphicon glyphicon-floppy-disk"></span> Guardar
		</button>
	</form><div style="clear:both"></div>
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