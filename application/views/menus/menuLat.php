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
  			

		 <li class="active" id="asignados_inicio">
		   <a>
			 <span class="glyphicon glyphicon-tags"></span>
			    Asignado
			  <span class="badge pull-right"><?php echo count($oficios_asignados->result()); ?></span>
		   </a>
		 </li>

		  <li class="active">
		   <a>
			 <span class="glyphicon glyphicon-pencil"></span>
			    Notas
			  <span class="badge pull-right">0</span>
		   </a>
		 </li>

		<li>
		<a>
			 <span class="glyphicon glyphicon-heart"></span>
			    &nbsp;Ayuda
		 </a> 
		 </li>

		<li>
		<a href="salir">
			 <span class="glyphicon glyphicon-remove"></span>
			   Salir
		 	</a> 
		 </li>

	 </ul>
</div>

