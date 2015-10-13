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
				<p><?=$usuario;/*$this->session->userdata("cedula")*/ ?></p>
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
  <li class="active"><a href="#home" role="tab" data-toggle="tab"><span class="glyphicon glyphicon-inbox"> Bandeja</a></li>
  <li><a href="#oficios_asignados" role="tab" data-toggle="tab"> Oficios ∈ Usuarios</a></li>
  <li><a href="#profile" role="tab" data-toggle="tab">Usuarios ∈ Oficios</a></li>
  <li><a href="#divisiones" role="tab" data-toggle="tab"> Oficios ∈ Divisiones</a></li>
    <li><a href="#divisiones_oficios" role="tab" data-toggle="tab">Divisiones ∈ Oficios </a></li>
    <li><a href="#direcciones_internas" role="tab" data-toggle="tab">Agregar <span class="glyphicon glyphicon-plus-sign"></span></a></li>
</ul>

<!-- Tab panes -->
<div class="tab-content">
	<!--Formulario-->
<div class="tab-pane active" id="home">
<!--Bandeja de asignados a la dirección interna-->
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

<?php 
#Ciclo para unir la correspondencia de todos las direcciones y divisiones(grupos) relacionadas con esta dirección general.
foreach ($this->ivss_model->asignaciones_generales($id_this_direccion)->result() as $asignacion) {
	echo "<tr class='fila_data' data-link='".$this->config->base_url()."index.php/verOficios/oficioIndividual/".$asignacion->id_cor."' data-id=".$asignacion->id_cor." >";
	echo "<td>".$asignacion->num_control."</td><td>".$asignacion->dir_origen.", ".$asignacion->remitente."</td><td>".$asignacion->asunto."</td><td>".$asignacion->fecha_creacion.", ".$asignacion->hora_creacion."</td></tr>";
}
#Ciclo para ver la correspndencia asignada a la dirección general.
?>
		</tbody>
	</table>
</div>
 <!--Probando la paginación-->

<!--Upd-del-->
	<div id="options_Core" style="display:none;float:left;">
		<!--<div id="menu_ud">
			<button id="tigger_ud" class="btn " style="background:rgba(0, 0, 0, 0.8);color:white;">
				<span class="glyphicon glyphicon-align-justify"></span> Menu
			</button>
		</div>-->

		<div id="oficio" style="font-size.1.2em;text-align:center;padding:12px;width:250px;float:left;cursor:pointer;border: 1px inset #F3B200;background: gold;">
		<span class="glyphicon glyphicon-paperclip"></span> Oficio adjunto 	
		</div>
		<div id="ud_edit" style="font-size:1.2em;text-align:center;padding:10px;width:250px;float:left;cursor:pointer;border: 1px solid #6095C4;background: linear-gradient(#639ACA, #6095C4 20%, #3368A0 60%, #234181 100%) repeat scroll 0% 0% #234181;color:white;">
			Editar
		</div>

		<div id="ud_delete" style="font-size:1.2em;text-align:center;padding:10px;width:250px;float:left;cursor:pointer;color:white;border:1px solid red;background:#E11;">
			Eliminar
		</div>

	</div>		
<!--Upd-del-->

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
		<form action="<?=$this->config->base_url()?>index.php/director_general/del_messages" method="post">
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
	<div id="asignacion" style="width:800px;padding:0px 0px 16px 0px;float:right;margin:auto;margin-top:25px;margin-bottom:50px;margin-right:52px;border-top:1px dotted gray;border-left:1px solid #f1f1f1;border-right:1px solid #EEE;border-bottom:1px dotted #f0f0f0;box-shadow:10px 10px 21px black;display:none;background:#C3C3C3 linear-gradient(to right, #C3C3C3,#EFEFEF,#EFEFEF,#C3C3C3);">
<!-------------------------------------------------------------------------->
		<form action="<?=$this->config->base_url();?>index.php/director_general/asignar" id="form_asignar_asuario" method="post">
			<input type="hidden" id="id_cor" name="id_cor">
<!-------------------------------------------------------------------------->
<table class="table" id="panel_asignacion">
<tr>
	<th colspan="3" style="text-align:center;font-size:1.6em;background:linear-gradient(#639ACA, #6095C4 20%, #3368A0 60%, #234181 100%) repeat scroll 0% 0% #234181;color:#f0f0f0;">Control de Envio de Asignaciones</th>
</tr>
<tr>
	<th style="text-align:center;">Destinos</th>
	<th>Activar</th>
	<th style="text-align:center;">Seleccionar</th>
</tr>

<!--Row Direcciones internas-->
<tr>
	<td>Direcciones Internas</td>

		<td>
			<div class="onoffswitch">
  			<input type="checkbox" class="onoffswitch-checkbox" id="sel_direccion_interna" checked />
  			<label class="onoffswitch-label" for="sel_direccion_interna">
    			<span class="onoffswitch-inner"></span>
    			<span class="onoffswitch-switch"></span>
  			</label>
			</div>
		</td>

		<td>
			<!-------------------------------------------------------------------------->
			<select name="direcciones_sub_jerarjicas[]" id="direcciones_sub_jerarjicas" multiple="multiple">
			<?php 
				foreach ($this->ivss_model->ver_direcciones_internas($id_this_direccion)->result() as $dir_interna) {
					echo  '<option value="'.$dir_interna->id_dir.'">'. $dir_interna->nombre.'</option>';			
				}
	 		?>
			</select>
			<!------------------------------------------------------------>	
		</td>
	</tr>
<!--Row Direcciones internas-->

<!--Row Divisiones-->
<tr>
<td>Divisiones Internas</td>

	<td>
		<div class="onoffswitch">
  		<input type="checkbox" class="onoffswitch-checkbox" id="sel_division_interna"/>
  		<label class="onoffswitch-label" for="sel_division_interna">
    		<span class="onoffswitch-inner"></span>
    		<span class="onoffswitch-switch"></span>
  		</label>
		</div>
	</td>

	<td>
		<select name="divisiones_internas[]" id="divisiones_internas">
		<?php 
			foreach($this->ivss_model->ver_divisiones_internas($id_this_direccion)->result() as $div_interna) {
				echo  '<option value="'.$div_interna->id_grupo.'">'. $div_interna->nombre_grupo.'</option>';			
			}
	 	?>
		</select>	
	</td>
</tr>
<!--Row Divisiones-->

<!--Row usuarios-->
	<tr>
<td>Empleados</td>

		<td>
			<div class="onoffswitch">
  			<input type="checkbox" class="onoffswitch-checkbox" id="Sel_usuarios" />
  			<label class="onoffswitch-label" for="Sel_usuarios">
    			<span class="onoffswitch-inner"></span>
    			<span class="onoffswitch-switch"></span>
  			</label>
			</div>
		</td>

<td>
	<select name="usuario[]" id="select_users" class="" multiple="multiple" style="width:200px;float:left;margin-right:25px;border-radius:0px;">	
	<?php
	$num_u_dir=0;
	#ciclo para obtener la lista de los usuarios.
	foreach($this->ivss_model->direcciones_de_la_direccion_general($id_this_direccion)->result() as $dir_gen_referens) {

		foreach($this->ivss_model->ver_divisiones_direcciones($dir_gen_referens->id_dir_interna)->result() as $u_dir){

			foreach($this->ivss_model->usuarios_grupos($u_dir->id_grupo)->result() as $u_g) { 
			  echo "<option value='".$u_g->id_usuarios."'>".$u_g->usuario."</option>";	
			}
			$num_u_dir+=$this->ivss_model->usuarios_grupos($u_dir->id_grupo)->num_rows();				
		}

	}
	#ciclo para obtener la lista de los usuarios.
	?>
</select>
</td>
</tr>
<!--Row usuarios-->
</table>

	<hr>
		<button id="asignar_a" class="btn btn-default" value="Asignar" style="float:right;margin-right:25px;padding:5px;padding:10px;color:black;">
			<span class="glyphicon glyphicon-share-alt"></span> Asignar
		</button>
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
	<span class="glyphicon glyphicon-envelope"></span> Mensajes en relación al oficio <span class="glyphicon glyphicon-remove" title="Cerrar Ventana" id="cerrar_mensaje-abajo" style="color:white;float:right;cursor:pointer;margin-right:5px;"></span><span class="glyphicon glyphicon-minus" title="ocultar" id="mostrar_mensaje-abajo" style="color:white;float:right;cursor:pointer;margin-right:10px;"></span> 	
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
$CI = &get_instance(); 
$CI->load->model("ivss_model");
?>

<?php 
foreach($this->ivss_model->direcciones_de_la_direccion_general($id_this_direccion)->result() as $id_DG_referens) {
 ?>

<?php
foreach($this->ivss_model->ver_divisiones_direcciones($id_DG_referens->id_dir_interna)->result() as $division){
?>

<?php foreach($this->ivss_model->ver_oficios_grupales($division->id_grupo)->result() as $oficios_control){ ?>
<tr>
	<td ><?="<b>".$oficios_control->num_control."</b>" ?></td>

	<td id="asignaciones_cell"><!--Asignado a quien?-->
		<?php
			//print_r($CI->ivss_model->ver_asignaciones($oficios_control->id_cor)->result());
		
			$asignados=$CI->ivss_model->ver_asignaciones($oficios_control->id_cor);

		 if(empty($asignados->result())){
				echo "Este oficio no ha sido asignado a un usuario";
			}else{
				  foreach($asignados->result() as $quien){
					echo "<div style='border:1px solid gray;background-color:#f1f1f1;width:180px;float:left;padding:3px 0px 3px 3px;border-radius:3px;' class='content_asignaciones'>".$quien->usuario."<div style='float:right;' class='quitar_asignacion' data-user='".$quien->usuario."' data-ido='".$oficios_control->id_cor."'><span style='margin-right:3px;font-size:0.9em;cursor:pointer;position:relative;top:0px;right:0px;' class='glyphicon glyphicon-remove'></span></div></div>";
				  }//foreach
			}//llave else.			
		 ?>
	</td><!--Asignado a quien?-->

	<!--Status del oficio-->
	<td>
		<?php 
		switch($oficios_control->estatus_cor){
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
	<!--Status del oficio-->
</tr>
		<?php } ?>
	<?php } ?>
<?php } ?>
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

<div style="height:21px"></div>

<table class="table" id="estadisticas">
	<thead>
		<tr>
			<th>Usuario </th>
			<th>Listado de asignaciones</th>
			<th>Total asignados</th>
		</tr>
	</thead>
<tbody>	 


<?php

$num_u=0;
$c=0;
#ciclo para obtener la lista de los oficios asignadas a un usuario por el numero de control.
foreach($this->ivss_model->direcciones_de_la_direccion_general($id_this_direccion)->result() as $id_general) {
	foreach($CI->ivss_model->ver_divisiones_direcciones($id_general->id_dir_interna)->result() as $u_d){

		foreach($CI->ivss_model->usuarios_grupos($u_d->id_grupo)->result() as $user) { 
		  echo "<tr>";
			echo "<td>".$user->usuario."</td>";
			
			echo "<td style='width:450px;color:gray;' class='ver_oficios_asignados_a_este_usuario'>";	
			
			foreach($CI->ivss_model->ver_oficios_asignados_usuarioldap($user->usuario)->result() as $user_asignacion){ 
					if(!isset($user_asignacion->num_control)){echo "No hay oficios relacionados.";}else{echo $user_asignacion->num_control.", ";}
			}	
			echo "</td>";
			echo "<td style='width:50px;color:grey;font-size:1.2em;text-align:center'>".$CI->ivss_model->ver_oficios_asignados_usuarioldap($user->usuario)->num_rows()."</td>";
			echo"</tr>";
		}
		$num_u+=$this->ivss_model->usuarios_grupos($u_d->id_grupo)->num_rows();				
	}
}
#ciclo para obtener la lista de los oficios asignadas a un usuario por el numero de control.
?>

</tbody>
	<tfood>
		<tr>
			<th>Usuario </th>
			<th>Listado de asignaciones</th>
			<th>Total asignados</th>
		</tr>
	</tfood>
</table>
</div>
<!--pestaña de estadistica-->

<!--pestaña divisones-->
<div id="divisiones" class="tab-pane">
	<div style="height:21px"></div>

	<table class="table" id="oficios_grupos">
		<thead>
			<tr>
				<th>Num Control </th>
				<th>Asignado a la división</th>
				<th>Estado</th>
			</tr>
		</thead>
	
<tbody>	


<?php
foreach($this->ivss_model->direcciones_de_la_direccion_general($id_this_direccion)->result() as $id_general2) {
	foreach($this->ivss_model->ver_divisiones_direcciones($id_general2->id_dir_interna)->result() as $div){

		foreach($this->ivss_model->ver_oficios_grupales($div->id_grupo)->result() as $asig_group){ 
			echo "<tr><td>".$asig_group->num_control."</td><td>";
			foreach($this->ivss_model->ver_oficios_asignacion_dependencia($div->id_grupo,$asig_group->id_cor)->result() as $tipe_id){ 

				foreach($this->ivss_model->ver_grupo_individual($tipe_id->id_grupo)->result() as $tipe_nombre){
					echo $tipe_nombre->nombre_grupo;	
				}

			}
			echo "</td><td>";
				switch ($asig_group->estatus_cor) {
					case 'Creado':
							echo "<div id='estatus_creado_group'><span class='glyphicon glyphicon-cog' ></span>".$asig_group->estatus_cor."</div>";
						break;

						case 'Rechazado':
							echo "<div id='estatus_rojo_group'><span class='glyphicon glyphicon-remove' ></span> ".$asig_group->estatus_cor."</div>";
						break;
						
						case 'Asignado':
							echo "<div id='estatus_purpura_group'><span class='glyphicon glyphicon-user' ></span> ".$asig_group->estatus_cor."</div>";
						break;

						case 'Pendiente':
							echo "<div id='estatus_amarillo_group'><span class='glyphicon glyphicon-pencil'></span> ".$asig_group->estatus_cor."</div>";
						break;

						case 'Procesado':
							echo "<div id='estatus_verde_group'><span class='glyphicon glyphicon-ok' ></span> ".$asig_group->estatus_cor."</div>";
						break;
						
						default:
							echo "<div id='estatus_default_group'><span class='glyphicon glyphicon-cog'></span> En proceso</div>";
						break;
					}#switch
			echo "</td>";
		}
	}	
}
?>

</tbody>

		<tfood>
			<tr>
				<th>Num Control</th>
				<th>Asignado a la división</th>
				<th>Estado</th>
			</tr>
		</tfood>
	</table>

</div>
<!--pestaña divisiones-->



<div id="divisiones_oficios" class="tab-pane">
	<div style="height:21px"></div>

<table class="table" id="grupos_oficios">
	<thead>
		<tr>
    		<th>División</th>
			<th>Listado de oficios</th>
	 		<th>Total asignados</th>
		</tr>
	</thead>
	
<tbody>	
<?php 
///////////////////////////////////////////////////////////////////////
foreach($this->ivss_model->direcciones_de_la_direccion_general($id_this_direccion)->result() as $id_general3) {
	foreach($this->ivss_model->ver_divisiones_direcciones($id_general3->id_dir_interna)->result() as $sub_div){
		
		foreach($this->ivss_model->ver_grupo_individual($sub_div->id_grupo)->result() as $midiv){
			echo "<tr><td>".$midiv->nombre_grupo."</td>";
			echo "<td style='width:450px;color:grey;'>";
			foreach($this->ivss_model->ver_oficios_grupales($midiv->id_grupo)->result() as $ofc_div){
				echo $ofc_div->num_control.", ";
			}
			echo "</td>";
			echo "<td style='color:grey;text-align:center'>".$this->ivss_model->ver_oficios_grupales($midiv->id_grupo)->num_rows()."</td></tr>";
		}

	}
}
?>

<tbody>

</tbody>
	<tfood>
		<tr>
			<th>División</th>
			<th>Listado de oficios</th>
	 		<th>Total asignados</th>
		</tr>
	</tfood>
</table>
</div><!--Fin div divisiones_oficios-->

<style>
.centro{padding:16px;}
.centro input,.centro button{border-radius:0px;}
</style>
<!--panel de creación de direcciones-->
<div id="direcciones_internas" class="tab-pane">
	<div id="capaMultiple">

 		<div id="nueva_Dir" style="background:linear-gradient(rgba(7, 70, 217, 0.96), rgba(12, 172, 240, 0.96));color:#f1f1f1;padding:15px;font-size:1.3em;cursor:pointer;border-bottom:1px solid #f1f1f1;"><span class="caret" style="font-size:1em;"></span> Nueva Dirección Interna</div>

			<div id="dir" style="background: #234181 linear-gradient(#639ACA,#6095C4 20%,#3368A0 60%,#234181 100%);padding:10px;border:1px dotted gray;display:none;">
				<div class="centro" style="margin:auto;width:500px;background-color:#f9f9f9;">
					<form action="director_general/crearDireccionInterna" method="post" id="form_crear_dir">
						<input type="hidden" name="id_direccion_general" value="<?=$id_this_direccion?>">
						<b>Ingresar nombre de la dirección:</b>
						<div class='inner-addon left-addon'>
							<i class='glyphicon glyphicon-cloud'></i>
							<input type="text" name="nombre_dir" class="form-control" placeholder="Nombre Completo de la Dirección Interna." required>
						</div>

						<b>Siglas de la dirección:</b>
						<div class='inner-addon left-addon'>
						<i class='glyphicon glyphicon-text-width'></i>
						<input type="text" name="siglas_dir" class="form-control" placeholder="Siglas de la Dirección Interna." required>
						</div>

						<b>Usuario LDAP del Jefe de la Dirección Interna:</b>
						<div class='inner-addon left-addon'>
							<i class='glyphicon glyphicon-star-empty'></i>
							<input type="text" name="jefe_dir" class="form-control" placeholder="Usuario ldap del Jefe encargado de la dirección interna." required>
						</div>
						<button type="submit" id="guardar_dir" value="Guardar" class="btn btn-default" style="margin-top:16px;float:right;"><span class="glyphicon glyphicon-floppy-disk"></span> Guardar</button>
					</form>
				  	<div style="clear:both"></div>
				</div>
		</div><!--div nueva dir-->
<!--Crear dirección del ivss-->

		<!--Crear de Divisiones del ivss-->
		<div id="nuevoGrupo" class="" style="background:linear-gradient(rgba(7, 70, 217, 0.96), rgba(12, 172, 240, 0.96));color:#f1f1f1;padding:15px;font-size:1.3em;cursor:pointer;border-bottom:1px solid #f1f1f1;"><span class="caret" style="font-size:1em;"></span> Nueva División Interna</div>
			<div id="grupo" style="background: #234181 linear-gradient(#639ACA,#6095C4 20%,#3368A0 60%,#234181 100%);padding:10px;border:1px dotted gray;display:none;">
				<div class="centro" style="margin:auto;width:500px;background-color:#f9f9f9;">
					<form action="director_general/crearDivision" method="post" id="form_crear_dependencia">
						<input type="hidden" name="id_direccion_general2" value="<?=$id_this_direccion?>">
						<b>Nombre de la División:</b>
						<div class='inner-addon left-addon'>
							<i class='glyphicon glyphicon-cloud'></i>
							<input type="text" name="nombre_grupo" class="form-control" placeholder="Nombre Completo de la División." required>
						</div>

						<b>Siglas de la División:</b>
						<div class='inner-addon left-addon'>
						<i class='glyphicon glyphicon-text-width'></i>
						<input type="text" name="siglas_grupo" class="form-control" placeholder="Siglas de la División." required>
						</div>

						<b>Usuario LDAP del Jefe de la División:</b>
						<div class='inner-addon left-addon'>
						<i class='glyphicon glyphicon-star-empty'></i>
						<input type="text" name="jefe" class="form-control" placeholder="Usuario ldap del Jefe encargado de la división." required>
						</div>

						<b style="margin-bottom:25px;">Dirección interna asociada a esta División:</b>
						<select name="direccion_dependencia" id="direccion_dependencia" class="form-control chosen" style="border-radius:0px;cursor:pointer;" required>
							<?php 
								$dependencias = &get_instance(); 
								$dependencias->load->model("ivss_model");
								$direciones=$dependencias->ivss_model->ver_direcciones()->result();
							  foreach ($direciones as $dir) { ?>
								<option value="<?=$dir->id_dir;?>"><?=$dir->nombre;?></option>
							<?php } ?>
						</select>

						<button type="submit" id="guardar_dependencia" class="btn btn-default" style="margin-top:16px;float:right;"><span class="glyphicon glyphicon-floppy-disk"></span> Guardar</button>
					</form>
					<div style="clear:both"></div>
				</div><!--div centro-->
			</div><!--div grupo (división)-->
	<?php /* ?>
			<div id="new_users" style="background:linear-gradient(rgba(7, 70, 217, 0.96), rgba(12, 172, 240, 0.96));color:#f1f1f1;padding:15px;font-size:1.3em;cursor:pointer;border-bottom:1px solid #f1f1f1;"><span class="caret" style="font-size:1em;"></span> Nuevos usuarios directos de la <?=$nombre_dir_gen; ?></div>
			<div id="users" style="background: #234181 linear-gradient(#639ACA,#6095C4 20%,#3368A0 60%,#234181 100%);padding:10px;border:1px dotted gray;display:none;">
				<div class="centro" style="margin:auto;width:500px;background-color:#f9f9f9;">
				<form action="<?=$this->config->base_url()?>index.php/director_general/crear_usuarios" id="crear_usuarios" name="crear_usuarios" method="post">
					<input type="hidden" value="<?=$id_this_direccion;?>" name="id_de_la_direccion_general">
					<table style="width:100%;" id="table_user">
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
	           			
					<button id="menos_user" class="btn btn-danger" title="Quitar el ultimo usuario">
						<span class="glyphicon glyphicon-minus"></span>
					</button>
					
					<button id="mas_user" class="btn btn-primary" title="Agregar otro usuario">
						<span class="glyphicon glyphicon-plus"></span>
					</button>
					
					<div style="clear:both;"></div>
						
				</div><!--div centro-->
				<button type="submit" class="btn" id="btn_guardar_user" style="background:#00A300;color:white;font-size:1.3em;float:right;"><span class="glyphicon glyphicon-floppy-disk"></span> Guardar</button>
					</form>	<div style="clear:both;"></div>
			</div><!--div users-->
			<?php */ ?>
	</div><!--fin de algun div-->
</div><!--Fin div direcciones internas-->
<!--panel de creación de direcciones-->
<!--###################################################################-->
<!--###################################################################-->
<!--###################################################################-->
<!--Contenedor del panel pestaña admin-->

<!------------------------------------------------------>
<script>
	$(document).on("ready",function(a){
		a.preventDefault();

//++++++++Validación para activar los selects multiples en la asignación.
$("#sel_direccion_interna,#sel_division_interna,#Usuarios").onoff();

//$("#panel_asignacion  tr:nth-child(3) td:nth-child(3) select").attr("disabled","disabled");
$("#panel_asignacion  tr:nth-child(4) td:nth-child(3) select").attr("disabled","disabled");
$("#panel_asignacion  tr:nth-child(5) td:nth-child(3) select").attr("disabled","disabled");

	$(".onoffswitch-checkbox#sel_direccion_interna").click(function(){
		if($(this).attr("checked") == undefined){
		   $(this).attr("checked","checked");
		   $("#panel_asignacion  tr:nth-child(3) td:nth-child(3) .ms-parent button").removeClass("disabled");
		}else if($(this).attr("checked") == "checked"){
		   $(this).removeAttr("checked");
		   $("#panel_asignacion  tr:nth-child(3) td:nth-child(3) .ms-parent button").addClass("disabled");
		}
	});

	$(".onoffswitch-checkbox#sel_division_interna").click(function(){
		if($(this).attr("checked") == undefined){
		   $(this).attr("checked","checked");
		   $("#panel_asignacion  tr:nth-child(4) td:nth-child(3) .ms-parent button").removeClass("disabled");
		}else if($(this).attr("checked") == "checked"){
		   $(this).removeAttr("checked");
		   $("#panel_asignacion  tr:nth-child(4) td:nth-child(3) .ms-parent button").addClass("disabled");
		}
	});

		$(".onoffswitch-checkbox#Sel_usuarios").click(function(){
		if($(this).attr("checked") == undefined){
		   $(this).attr("checked","checked");
		   $("#panel_asignacion  tr:nth-child(5) td:nth-child(3) .ms-parent button").removeClass("disabled");
		}else if($(this).attr("checked") == "checked"){
		   $(this).removeAttr("checked");
		   $("#panel_asignacion  tr:nth-child(5) td:nth-child(3) .ms-parent button").addClass("disabled");
		}
	});


//++++++++Validación para activar los selects multiples en la asignación.


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
$("#nueva_Dir").on("click",function(){
	$("#dir").slideToggle();
});

$("#nuevoGrupo").on("click",function(){
	$("#grupo").slideToggle();
});
 
$("#new_users").on("click",function(){
	$("#users").slideToggle();
});

/*Oficio*/
$("#oficio").on("click",function(){
	$("#ventana_pdf").slideDown();
	//$("#content_oficio").html('<div style="position:absolute;top:250px;left:550px;margin:auto;width:300px;"><img src="<?=$this->config->base_url()?>fronted/img/loading2.gif"/></div>');

$("#oficio_pdf").attr("src","<?=$this->config->base_url()?>index.php/director_general/generar_pdf/"+$("#oficio").attr("data-id")+"/<?=$id_this_direccion?>");

	$("#ventana_pdf").on("click",function(){
		$("#ventana_pdf").fadeOut();
	});

	$(document).on("keydown",function(event){
		if(event.keyCode == 27){
			$("#ventana_pdf").fadeOut();
		}
	});

});
/*Oficio*/

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

$("form#crear_usuarios table#table_user").append(nuevo_miembro);
}
//function agregar

		$("#mas_user").on("click",function(e){
			e.preventDefault();
			if($(".cuantos_user").length < 5){agregar();}	
		});

		$("#menos_user").on("click",function(e){
			e.preventDefault();
			if($(".cuantos_user").length > 1){$("tr:last").remove();}
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
		
		//$("#select_users").chosen({allow_single_deselect: true,width:"350px"});
		$("#direcciones_sub_jerarjicas").multipleSelect({filter:true,  placeholder:"Enviar a Dirección interna.",width:"300px"});
		$("#divisiones_internas").multipleSelect({filter:true,  placeholder:"Enviar a división",width:"300px"});
		$("#select_users").multipleSelect({filter:true,  placeholder:"Enviar a usuario.",width:"300px"});
				
		$("#direccion_dependencia").chosen({allow_single_deselect: true,width:"350px"});
		
		$("#registrar").on("click",function(){
			$(".ligthbox").slideDown(500);
			$(".ligthbox, html , body").css({"overflow":"auto"});
		});

		$("#cerrar").on("click",function(){
			$(".ligthbox").toggle("scale",2000);
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
		$.post("<?=$this->config->base_url()?>index.php/director_general/actualizar_status",$("#form_status").serialize(),function(){

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
				$(".status_oficios").css({"background":"#00a300","color":"white"});
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
						
			$("#ver_mensaje,#asignacion,#id_cor_status,#options_Core,#eliminar_mensajes,#oficio").attr("data-id",id);
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


$.post("<?=$this->config->base_url();?>index.php/director_general/mensajes/"+id_this+"",function(data){
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
		url:"<?=$this->config->base_url();?>index.php/director_general/crearMensaje",
		data:{mensaje:$("#enviarMensaje").val(),id_cor:id_this,autor:"<?=$usuario;?>"},
		}).done(function(){
					$.post("<?=$this->config->base_url();?>index.php/director_general/mensajes/"+id_this+"",function(data){
					$("#contenido_mensaje").html(data);});
				});
	
	$.post("<?=$this->config->base_url();?>index.php/director_general/mensajes/"+id_this+"",function(data){
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
			  $('#tablero_asignados,#lista_asignados,#estadisticas,#oficios_grupos,#grupos_oficios').dataTable({
			  	"processing": true
			  	});
		/*datatable*/

</script>

<style>
.user_list{cursor:pointer;}
#mas_user,#menos_user{float:right;border-radius:0px;}
.contenedor_cajas_centrales{width:500px;margin:auto;}
#estatus_inicial{font-size:1em;background-color:#D0D0D0;width:100px;height:100px;text-align:center;padding-top:35px;float: right;}
#estatus_rechazado{font-size:1em;background-color:#ee1111;color:white;width:100px;height:100px;text-align:center;padding-top:35px;float: right;}
#estatus_pendiente{font-size:1em;background-color:#ffc40d;width:100px;height:100px;text-align:center;padding-top:35px;float: right;}
#estatus_procesado{font-size:1em;background-color: #00a300;color:white;width:100px;height:100px;text-align:center;padding-top:35px;float: right;}
#estatus_asignado{font-size:1em;background-color:purple;color:white;width:100px;height:100px;text-align:center;padding-top:35px;float: right;}
#estatus_por_defecto{font-size:1em;background:linear-gradient(rgba(7, 70, 217, 0.96), rgba(12, 172, 240, 0.96)) !important;color:white;width:100px;height:100px;text-align:center;padding-top:35px;float: right;}

#estatus_inicial span{font-size:1.3em !important;}
#estatus_rechazado span{font-size:1.3em !important;}
#estatus_pendiente span{font-size:1.3em !important;}
#estatus_procesado span{font-size:1.3em !important;}
#estatus_asignado span{font-size:1.3em !important;}
#estatus_por_defecto span{font-size:1.3em !important;}

#estatus_creado_group{font-size:1em;background-color:#D0D0D0;width:150px;height:33px;text-align:center;padding:10px 10px 10px 3px;}
#estatus_rojo_group{font-size:1em;background-color:#ee1111;color:white;width:150px;height:33px;text-align:center;padding:10px 10px 10px 3px;}
#estatus_purpura_group{font-size:1em;background-color:purple;color:#f1f1f1;width:150px;height:33px;text-align:center;padding:10px 10px 10px 3px;}
#estatus_amarillo_group{font-size:1em;background-color:#ffc40d;width:150px;height:33px;text-align:center;padding:10px 10px 10px 3px;}
#estatus_verde_group{font-size:1em;background-color: #00a300;color:#f1f1f1;width:150px;height:33px;text-align:center;padding:10px 10px 10px 3px;}
#estatus_default_group{font-size:1em;background:linear-gradient(rgba(7, 70, 217, 0.96), rgba(12, 172, 240, 0.96)) !important;color:#f1f1f1;width:150px;height:33px;text-align:center;padding:7px 10px 7px 3px;}


#estatus_creado_group span{font-size:1em !important;}
#estatus_rojo_group span{font-size:1em !important;}
#estatus_purpura_group span{font-size:1em !important;}
#estatus_amarillo_group span{font-size:1em !important;}
#estatus_verde_group span{font-size:1em !important;}
#estatus_default_group span{font-size:1em !important;}
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
	<form action="<?=$this->config->base_url()?>index.php/director_general/quitar_asignacion" method="post" id="form_quitar_asignacion">
		<input type="hidden" id="usuario_ldap_asignacion" name="usuario_ldap_asignacion">
		<input type="hidden" id="id_cor_asignacion" name="id_cor_asignacion">
	</form>
	<div id="options_asignacion" style="margin:auto;margin-top:25px;width:200px;">
		<input type="button" class="btn" value="Remover asignación" id="ejecutar_eliminacion_asignacion" style="background:#D43F3A;color:white;">
	</div>
	<div id="mensaje_ejecutar">
		
	</div>
</div>

<div id="ventana_pdf" style="position:fixed;top:0;left;0;width:100%;height:100%;background: rgba(0, 0, 0, 0.4);display:none;">
	<div id="content_oficio" style="margin:auto;height:100%;width:80%;background: none;">
		<iframe  id="oficio_pdf" style="width:100%;height:100%;border:none;"></iframe>
	</div>
</div>

<div style='display:none;background:rgba(0,0,0,0.5);' id='eliminar_core'>
	<div style='margin:auto;margin-top:7px;width:200px;background:#f1f1f1;padding:21px;'>
		<form action="<?=$this->config->base_url()?>index.php/director_general/del_cor" method="post">
			<input type="hidden"  name="id_core" id="hid_core">
			<input type="submit" value="Eliminar este oficio" class="btn" style="background:#D43F3A;color:white;border-radius:0px;">
		</form>
	</div>
</div>

<div id="editar_core" style="background:rgba(0, 0, 0, 0.5);display:none;">
	<div id="div_content_form_dit" style="margin:auto;width:450px;background:#f1f1f1;padding:33px;">
	<p style="font-size:0.8em">Nota: solo se permite modificar los siguientes campos:</p>
	<div style="border:1px solid gray;"></div>
	<form action="<?=$this->config->base_url()?>index.php/director_general/editar_core" method="post">
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
