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
</style>

<div id="menu">
	<ul id="menuLateral" class="nav nav-pills nav-stacked">
  		<li class="active" id="home_admin">
    	<a>
    	<span class="glyphicon glyphicon-home"></span>
       		Home
    	</a>
  		</li>		

		<li id="activar_busqueda">
			<a>
			   <span class="glyphicon glyphicon-search"></span>
				Buscar
	 		</a>
		</li>

		 <li id="lanzar_grupos">
			<a>
			 <span class="glyphicon glyphicon-cloud"></span>
			    &nbsp;Direcciones
		 	</a>
		 </li>

		<li>
			<a>
			  <span class="glyphicon glyphicon-heart"></span>
			  &nbsp;Ayuda
		 	</a> 
		</li>

		<li>
		<a href="admin/salir">
			 <span class="glyphicon glyphicon-remove"></span>
			   Salir
		 	</a> 
		 </li>

	 </ul>
</div>

<!-- lighbox numero 2 ver correpondencia
<div class="modal fade " tabindex="-1" id="ver_modal" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content" id="ver">

    </div>
  </div>
</div>
<!-- lighbox numero 2 ver correspondencia-->
 
<!-- lighbox numero 3 buscar correpondencia
<div class="modal fade " tabindex="-1"  id="buscar_modal" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content" id="buscar">

    </div>
  </div>
</div>
lighbox numero 3 buscar correpondencia-->
