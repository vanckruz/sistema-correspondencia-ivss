
<?php $CI = &get_instance(); 
			$CI->load->model("ivss_model");
			$mensajesc=$CI->ivss_model->mensajes_oficio($data["segmento"]=$this->uri->segment(3))->result();
?>
	<div id="mensajes" class="mensajescontent" scrollTop="200">

<?php foreach ($mensajesc as $mensaje) { ?>	
	<?php if($mensaje->autor == $usuario){?>
		<!--Mensaje autor-->
		<div class="mensaje-autor">
			<img src="<?=$this->config->base_url();?>fronted/img/logogrande.png" width="60" height="60" class="foto">
			<div class="flecha-izquierda"></div>
			<div class="contenido">
				<?=$mensaje->mensaje?>
			</div>
			<div class="fecha">Enviado por <?=$mensaje->autor?></div>
		</div>
			<?php }/*if*/else{?>
			<div class="mensaje-amigo">
			   	<div class="contenido">
					<?=$mensaje->mensaje?>
				</div>
			<div class="flecha-derecha"></div>
			<img src="<?=$this->config->base_url();?>fronted/img/logogrande.png" width="60" height="60" class="foto">
			<div class="fecha">Enviado por <?=$mensaje->autor?></div>
		</div>
				<?php }?>
		
		<?php } /*foreach*/?>

		<!--Prueba de mensajes-->
	</div>

<script type="text/javascript"> 
document.getElementById('mensajes').scrollTop=100000;
</script>
