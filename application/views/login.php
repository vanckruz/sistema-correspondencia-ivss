<style>
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
.left-addon input  { padding-left:  30px; }
.right-addon input { padding-right: 30px; }

#login{
	font-weight: 400;
	overflow: hidden;
	padding: 26px 24px 46px;
	border: 1px solid #b3b3b3;
	background-color: white;
	box-shadow: 0 1px 10px #a7a7a7, inset 0 1px 0 #fff;
}

#boton{
	float:right;
}
#logo,#login{
	margin-top:25px;
}

</style>
<body>
<!--Header-->
<div class="header colortema">
	<div class="container colorTema mas">
		<div class="row">
			<div class="col-xs-1">
				<div class="fondologo">
					<img src="<?=$this->config->base_url();?>fronted/img/logogrande.png"  width="60" height="60">
				</div>
			</div>

			<div class="col-xs-10 col-xs-offset-1 titulo">
				<h1>IVSS <small style="color:#CCC;"> Sistema de correspondencia</small></h1>
			</div>
		</div>
	</div>
</div>
<!--Header-->


	<div class="container">
		<div class="row">
			<div class="col-xs-2 col-xs-offset-5">
				<div id="logo">
					<img src="<?=$this->config->base_url();?>fronted/img/logogrande.png"  width="125" height="125">
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-xs-4 col-xs-offset-4">
				<div id="login">
					<fieldset>
						<form action="<?=$this->config->base_url();?>index.php/correspondencia/login" method="post" name="" id="">
						 <label for="usuario">Usuario</label>
			             <div class="inner-addon left-addon">
			                <i class="glyphicon glyphicon-user"></i>
			                <input type="text" class="form-control" placeholder="Usuario" name="usuario" required style="border-radius:0px 0px 0px 0px !important;"/>
			             </div>

					     <label for="clave">Contraseña</label>
						 <div class="inner-addon left-addon">
						    <i class="glyphicon glyphicon-asterisk"></i>
						   <input type="password" class="form-control" placeholder="Contraseña" name="clave" required style="border-radius:0px 0px 0px 0px !important;"/>
						 </div> 
						 <hr>
						  <button type="submit" class="btn btn-primary" id="boton" style="">
						  	Entrar  <span class="glyphicon glyphicon-log-in"></span> 
						  </button>
						</form>
					</fieldset>
					<div><?php if (isset($_GET["error"])) {
					echo "<p style='color:red;margin-top:15px;font-size:1.1em;'><span class='glyphicon glyphicon-info-sign' style='color:black;'></span> ¡Usuario o contraseña invalida!</p>";
					echo "<p style='color:red;margin-top:15px;font-size:1.1em;'><span class='glyphicon glyphicon-info-sign' style='color:black;'></span> ¡Por favor intentelo de nuevo!</p>";
					?>
					<script> 
						$('#login').delay(250).effect('shake',{distance:30,times:5}); 
					</script>

					<?php } ?></div><!--Mensaje de error-->
				</div>		
			</div>
		</div>
	</div>

</body>

