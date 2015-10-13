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
  <li class="active"><a href="#home" role="tab" data-toggle="tab"><span class="glyphicon glyphicon-home"> Inicio</a></li>
  <li><a href="#profile"  role="tab" data-toggle="tab" style="color:black !important;"><span class="glyphicon glyphicon-eye-open"></span> Control de correspondencia</a></li>
  <li><a href="#settings" role="tab" data-toggle="tab" style="color:black !important;"><span class="glyphicon glyphicon-cog"></span> Creación de direcciones, dependencias y sus relaciones.</a></li>
</ul>

<!-- Tab panes -->
<div class="tab-content">

<!--Pestaña home-->
<div class="tab-pane active" id="home">
<div id="contenedorListador" style="margin-top:16px;">

<table class="table table-hover table-striped display" id="tablero_oficios">
	<thead>
		<tr>
			<th>Fecha asignación</th>
			<th>Enviado por</th>
			<th>Asunto</th>
		</tr>
	</thead>

	<tfoot>
		<tr>
			<th>Fecha asignación</th>
			<th>Enviado por</th>
			<th>Asunto</th>
		</tr>
	</tfoot>
	
	<tbody>
<?php foreach($oficios->result() as $campo){ ?>
		<?php 
		echo "<tr class='fila_data' data-link='".$this->config->base_url()."index.php/verOficios/oficioIndividual/".$campo->id_cor."'>";
		echo "<td>".$campo->fecha_creacion.", ".$campo->hora_creacion."<td>".$campo->dir_origen.", ".$campo->remitente."</td><td>".$campo->asunto."</td></tr>";
		}?>
	</tbody>
</table>
</div>
<!--Oficio Individual-->
	<div id="volver" style="display:none;margin-top:16px;">
		<span class='glyphicon glyphicon-hand-right'></span> Volver
	</div>

	<div id="oficioIndividual" style="display:none;">
				
	</div>

<!--Oficio individual-->
<!--Fin pestaña home-->
 </div>
<!--Fin pestaña home-->

<div class="tab-pane" id="profile">
<script> 
$(document).on("ready",function(){
	$("#img_01").elevateZoom({scrollZoom : true});
});
</script>
		<h1>Oficio 1337-2095 Prueba-oficios:</h1>
		<img id="img_01" src="<?=$this->config->base_url();?>fronted/img/visor/large/oficio.jpg" width="400" data-zoom-image="<?=$this->config->base_url();?>fronted/img/visor/large/oficio.jpg"/>
 </div>

<!--Pestaña configuración de direcciones, grupos y usuarios de esos grupos-->
  <div class="tab-pane" id="settings">

  	<div id="capaMultiple">

 	<div id="nueva_Dir" style="background:linear-gradient(rgba(7, 70, 217, 0.96), rgba(12, 172, 240, 0.96));color:#f1f1f1;padding:15px;font-size:1.5em;cursor:pointer;border-bottom: 2px dashed white;"><span class="caret" style="font-size:1em;"></span> Nueva dirección <span class="glyphicon glyphicon-plus"></span></div>

<div id="dir" style="background: #234181 linear-gradient(#639ACA,#6095C4 20%,#3368A0 60%,#234181 100%);padding:10px;border:1px dotted gray;display:none;">

	<div class="centro" style="margin:auto;width:500px;background-color:#f9f9f9;padding:10px;">
	
	<form action="admin/crearDir" method="post" id="form_crear_dir">
		<b>Ingresar nombre de la dirección:</b>
		<div class='inner-addon left-addon'>
		<i class='glyphicon glyphicon-cloud'></i>
		<input type="text" name="nombre_dir" class="form-control" placeholder="Nombre de la dirección" required>
		</div>


		<b>Siglas de la dirección:</b>
		<div class='inner-addon left-addon'>
		<i class='glyphicon glyphicon-text-width'></i>
		<input type="text" name="siglas_dir" class="form-control" placeholder="Siglas de la dirección" required>
		</div>

		<b>Jefe de la dirección:</b>
		<div class='inner-addon left-addon'>
		<i class='glyphicon glyphicon-star-empty'></i>
		<input type="text" name="jefe_dir" class="form-control" placeholder="Ingrese el usuario ldap del Jefe encargado de la dirección" required>
		</div>

		<input type="submit" id="guardar_dir" value="Guardar" class="btn btn-default" style="margin-top:16px;float:right;">
	</form>
<div style="clear:both"></div>
	</div>
</div>
<!--Crear dirección del ivss-->

<!--Crear de pendencias del ivss-->
<div id="nuevoGrupo" class="" style="background:linear-gradient(rgba(7, 70, 217, 0.96), rgba(12, 172, 240, 0.96));color:#f1f1f1;padding:15px;font-size:1.5em;cursor:pointer;border-bottom: 2px dashed white;"><span class="caret" style="font-size:1em;"></span> Agregar dependencia <span class="glyphicon glyphicon-plus"></span></div>
<div id="grupo" style="background: #234181 linear-gradient(#639ACA,#6095C4 20%,#3368A0 60%,#234181 100%);padding:10px;border:1px dotted gray;display:none;">

	<div class="centro" style="margin:auto;width:500px;background-color:#f9f9f9;padding:10px;">
	
	<form action="admin/crearGrupo" method="post" id="form_crear_dependencia">
		<b>Ingresar nombre del grupo:</b>
		<div class='inner-addon left-addon'>
		<i class='glyphicon glyphicon-cloud'></i>
		<input type="text" name="nombre_grupo" class="form-control" placeholder="Nombre del grupo" required>
		</div>


		<b>Siglas de grupo:</b>
		<div class='inner-addon left-addon'>
		<i class='glyphicon glyphicon-text-width'></i>
		<input type="text" name="siglas_grupo" class="form-control" placeholder="Siglas del grupo" required>
		</div>

		<b>Jefe de grupo:</b>
		<div class='inner-addon left-addon'>
		<i class='glyphicon glyphicon-star-empty'></i>
		<input type="text" name="jefe" class="form-control" placeholder="Ingrese el usuario ldap del Jefe encargado del grupo" required>
		</div>

		<b>Dirección asociada a esta dependencia:</b>
		<select name="direccion_dependencia" class="form-control" style="border-radius:0px;cursor:pointer;" required>
			<?php 
				$dependencias = &get_instance(); 
				$dependencias->load->model("ivss_model");
				$direciones=$dependencias->ivss_model->ver_direcciones()->result();
			 ?>

			 <?php foreach ($direciones as $dir) { ?>
				<option value="<?=$dir->id_dir;?>"><?=$dir->nombre;?></option>
			 <?php } ?>
			
		</select>

<?php /*
		<b>Miembros del grupo:</b>
		
		<table style="width:100%;">
        <tr>
          	<td>
				<div class="inner-addon left-addon cuantos_user">
				<i class="glyphicon glyphicon-user"></i>
				<input type="text" name="trabajadores[]" class="form-control" placeholder="Usuario de ldap IVSS" style="width:100%;">
				</div>
      		</td>

        <td>
			<div class="inner-addon left-addon">
				<i class="glyphicon glyphicon-briefcase"></i>
				<input type="text" name="cargo[]" class="form-control cargos_employes" placeholder="Cargo del empleado" style="width:100%;">
			</div>
      	</td>
      </tr>
      </table>
      */
 ?>
		<input type="submit" value="Guardar" id="guardar_dependencia" class="btn btn-default" style="margin-top:16px;float:right;">
	</form>
<div style="clear:both"></div>
	</div>
</div>
<!--Fin creación de dependencias-->
</div>


</div>
<!--Pestaña configuración de direcciones, grupos y usuarios de esos grupos-->

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
			<p style="font-size:1.3em;padding-top:25px;font-family:playball;color:white;">
				Diseñado por la dirección general de informática del IVSS.<br>
			</p>
						
		</div>
	</div>
</div>
<!--PIE-->
</body>

<style>
.ligthbox, #ventanabuscar,#ver_grupos{
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

#ver_grupos{
background: linear-gradient(#639ACA, #6095C4 20%, #3368A0 60%, #234181 100%) repeat scroll 0% 0% #234181;
}

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
	background:white;
	opacity:0.95;
	border-radius:5px;
	z-index:2;
	padding:25px;
	overflow:auto;
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
.left-addon input  { padding-left:  30px;}
.right-addon input { padding-right: ;}

#cerrartabla,#cerrarbuscador,#cerrar,#cerrar_vista_de_grupos{
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

#cerrartabla:hover{
	color:red;
	opacity:0.8;
}

#cerrar_vista_de_grupos:hover{
	color:red;
	opacity:0.8;
}

#cerrarbuscador:hover{
	color:red;
	opacity:0.8;
}


#ventanabuscar{
	background-color:white;
}

#ventana_al_buscador{
	width:100%;
	height:100%;
	border:0;
	overflow: hidden;
}


.centro{
	padding:25px;
}

.centro input{
	border-radius:0px 0px 0px 0px !important;
	}

.fila_data{
cursor:pointer;
border:1px solid #EEE;
padding:5px;
background:linear-gradient(#ffffff,#dde9f4);
}

#volver{
	text-align:right;
	cursor:pointer;
}

.content_grupo{
	padding:10px;
	cursor:pointer;
	border-top:1px inset gray;
	border-right:1px dotted gray;
	border-left:1px dotted gray;
	background-color:#CCC;
	width:450px;
	float:left;
}

#cabecera_grupo{
width: 100% !important;
background: #234181 linear-gradient(#639ACA,#6095C4 20%,#3368A0 60%,#234181 100%);
}

.titulo_grupo{
	background:linear-gradient(rgba(7, 70, 217, 0.96), rgba(12, 172, 240, 0.96));
}

</style>



<div id="ventanabuscar">
<span id="cerrarbuscador" class="glyphicon glyphicon-remove-sign" title="Cerrar"></span>
	<iframe src="<?=$this->config->base_url();?>index.php/buscar" id="ventana_al_buscador">
			
	</iframe>
</div>

<div id="ver_grupos" style="display:none;">
<span id="cerrar_vista_de_grupos" class="glyphicon glyphicon-remove-sign" title="Cerrar"></span>
<div id="cabecera_grupo">	
	<div class="container">
		<div class="row">
			<div class="col-xs-2">
				<img src="<?=$this->config->base_url()?>fronted/img/logogrande.png" width="70"> 
			</div>
			<div class="col-xs-10">
				<p style="font-size:2.5em;color:white;margin-top:25px;">
					Dependencias del ivss
			 	</p>
			</div>					
		</div>
	</div>
<!--Fin cabecera grupo-->
</div>
<!--Fin cabecera grupo-->
		<div class="container">
			<div class="row">
				<div class="col-xs-12">
					<!--Contenedor grupo-->
						<?php 						
							foreach ($grupos->result() as $grupo){
								echo "<div class='content_grupo'><div class='titulo_grupo' style='background-color:#3071a9;height:40px;font-size:1.2em;color:white;padding:10px;'><span class='caret' style=font-size:1em;></span> ".strtoupper($grupo->nombre_grupo)."</div>";
						?>
						<div class='grupo_individual' style='display:none;background:#f1f1f1;'>
							<table class="table">
								<tr>
									<th>ID</th>
									<th>Usuario</th>
									<th>Cargo</th>
								</tr>
									<!---->
								<?php $CI = &get_instance(); 
								 $CI->load->model("ivss_model");
								 //print_r($CI->ivss_model->usuarios_grupos($grupo->id_grupo)->result());
								?>

								<?php foreach ($CI->ivss_model->usuarios_grupos($grupo->id_grupo)->result() as $usuario) { ?>
									<tr>
										<td><?=$usuario->id_usuarios?></td>
										<td><?=$usuario->usuario?></td>
										<td><?=$usuario->cargo?></td>
									</tr>
								<?php } ?>
							<!---->
							</table>
						</div>
					</div>
					
					<?php }?>
						
					<!--Contenedor grupo-->
				</div>
			</div>
		</div>
</div>

<!--scripts-->
<script>
	$('#myTab a').click(function (e) {
  e.preventDefault()
  $(this).tab('show')
});

	$(document).on("ready",function (){

		$(".content_grupo").on("click",function(){
			
			$(".grupo_individual",this).slideToggle();
			
		});

		$("#home_admin").on("click",function(){
			location.reload();
		});

		$("#registrar").on("click",function(){
			$(".ligthbox").fadeIn();
			$(".ligthbox, html , body").css({"overflow":"auto"});
		});

		$("#cerrar").on("click",function(){
			$(".ligthbox").fadeOut(500);
			$(" html , body").css({"overflow":"auto"});
		});

		$("#activar_busqueda").on("click",function(){
			$("#ventanabuscar").fadeIn();
			$("#ventanabuscar, html , body").css({"overflow":"hidden"});		
		});

		$("#cerrarbuscador").on("click",function(){
			$("#ventanabuscar").fadeOut(200);
			$("html , body").css({"overflow":"auto"});
		});

		$("#nuevoGrupo").on("click",function(){
			$("#grupo").slideToggle();
		});

		$("#nueva_Dir").on("click",function(){
			$("#dir").slideToggle();
		});

		$("table tbody ").on("click",".fila_data",function(){

			var link=$(this).attr("data-link");
			/*sino get*/
			$.post(link,function(resp){
			$("#oficioIndividual").html(resp);
			});

			$("#contenedorListador").slideUp();

			$("#oficioIndividual").slideDown();

			$("#volver").show();
			
		});
/**/

/**/
$("#lanzar_grupos").on("click",function(){
			$("#ver_grupos").fadeIn();
			$("#ver_grupos").css({"overflow":"auto"});
			$(" html , body").css({"overflow":"hidden"});		
		});

$("#cerrar_vista_de_grupos").on("click",function(){
	$("#ver_grupos").fadeOut(200);
	$("html , body").css({"overflow":"auto"});
});
/**/
			/*volver*/
			$("#volver").click(function(){
				$("#oficioIndividual").slideUp();
				$("#volver").hide();
				$("#contenedorListador").slideDown();
			});
			/*volver*/

	});



$("#guardar_dir").on("click",function(){
	alert("La dirección se guardo correctamente, por favor relacione esta dirección con su respectivas dependencias en la opción de crear dependencia abajo.");
	$("#form_crear_dir").submit();
});

$("#guardar_dependencia").on("click",function(){
	alert("La dependencia se guardo correctamente relacionada a la dirección indicada.");
	$("#form_crear_dependencia").submit();
});


$("table#tablero_oficios").dataTable();
</script>