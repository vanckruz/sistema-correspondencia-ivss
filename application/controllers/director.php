<?php if ( ! defined('BASEPATH')) exit('Acceso denegado al script');

class Director extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->helper(array('form','url'));
		$this->load->model('directores_model');
	}

#Inicio Index de administración de dirección.
public function index(){
#para validar la sesión director.
if(!$this->session->userdata('director')){
	redirect("correspondencia/entrar");
}else{
	$this_direccion=$this->ivss_model->ver_direccion_interna_especifica($this->session->userdata('director'))->result();

	foreach($this_direccion as $dir){
		$id_this_direccion = $dir->id_dir;
		$nombre_direccion  = $dir->nombre;
		$id_dire_gene 	   = $dir->id_dir_general;
	}

$sumaficios=0;
$divisiones_unidas=array();
#Ciclo para juntar la correspondencia de todos los grupos en este perfil de director
#Que tengan el id de esta dirección.
foreach($this->ivss_model->ver_divisiones_direcciones($id_this_direccion)->result() as $division){

	foreach($this->ivss_model->ver_oficios_grupales($division->id_grupo)->result() as $join_grupos) {
		$divisiones_unidas[] = $join_grupos->asunto;

	}
	#echo "<h1>El numero de asignaciones es : ".$this->ivss_model->ver_oficios_grupales($division->id_grupo)->num_rows()."</h1>";
	$sumaficios+=$this->ivss_model->ver_oficios_grupales($division->id_grupo)->num_rows();
}
	$opciones[0]='<li class="active" id="asignados_inicio"><a><span class="glyphicon glyphicon-tags"></span>';
	$opciones[1]=' Asignado <span class="badge pull-right">'.$sumaficios.'</span></a></li>';
	$opciones[2]='<li id="registrar"><a><span class="glyphicon glyphicon-floppy-disk"></span> Registrar</a></li>';
	$opciones[3]='<li><a><span class="glyphicon glyphicon-file"></span> Reportes</a></li>';
	$opciones[4]='<li class="active"><a><span class="glyphicon glyphicon-heart"></span>&nbsp;Ayuda</a></li>';
	$opciones[5]='<li><a href="admin_grupo/salir"><span class="glyphicon glyphicon-log-out"></span> Salir</a></li>';

		$this->load->library("options",$opciones);

		$data=[
		"usuario" 				=> $this->session->userdata("nombre"),
		"oficios_asignados"		=> $divisiones_unidas,
		"menu"					=> $this->options->vermenus(),
		"id_this_direccion"		=> $id_this_direccion,
		"nombre_direccion"      => $nombre_direccion,
		"id_general_dir"        => $id_dire_gene
		];

		$titulo=array("titulo" => "Correspondencia, perfil director.","usuario" => $this->session->userdata("nombre"));
     	$this->load->view("inc/head",$titulo);
		$this->load->view("private/director",$data);
		$this->load->view("private/crear_cor_director",$data);

	}#llave else de la sesión. 
}#Llave metodo index
#Fin Index de administración de dirección.


#***************************Asignar a divisiones y usuarios**************************
public function asignaciones(){

  if(isset($_POST["selectItemdivisiones_internas"]) && isset($_POST["selectItemusuario"]) ){
	
	$divisiones_internas  = $_POST["selectItemdivisiones_internas"];
	$total_divisiones 	  = sizeof($_POST["selectItemdivisiones_internas"]);	

	$usuarios 			  = $_POST["selectItemusuario"];
	$totalUsuarios 		  = sizeof($_POST["selectItemusuario"]);

	$id_correspondencia = $_POST["id_cor"];

	$this->ivss_model->asignar_divisiones_usuarios(
		$divisiones_internas,
		$total_divisiones,
		$usuarios,
		$totalUsuarios,
		$id_correspondencia);
	redirect("director");

}else if(isset($_POST["selectItemdivisiones_internas"]) ){
	$divisiones_internas  = $_POST["selectItemdivisiones_internas"];
	$total_divisiones 	  = sizeof($_POST["selectItemdivisiones_internas"]);
	$id_correspondencia = $_POST["id_cor"];

	$this->ivss_model->asignar_divisiones_usuarios(
		$divisiones_internas,
		$total_divisiones,
		null,
		null,
		$id_correspondencia);
	redirect("director");

}else if(isset($_POST["selectItemusuario"]) ){
	$usuarios 	   = $_POST["selectItemusuario"];
	$totalUsuarios = sizeof($_POST["selectItemusuario"]);
	$id_correspondencia = $_POST["id_cor"];
	
	$this->ivss_model->asignar_divisiones_usuarios(
		null,
		null,
		$usuarios,
		$totalUsuarios,
		$id_correspondencia);
	redirect("director");
	
	}else{redirect("director");}

}
#***************************Asignar a divisiones y usuarios**************************
/*Quitar asignacion*/
public function quitar_asignacion(){

	if($this->input->post()){
		$usuario=$this->input->post("usuario_ldap_asignacion");
		$id_cor=$this->input->post("id_cor_asignacion");
		$this->ivss_model->quitar_asignacion($usuario,$id_cor);
		redirect("director");
	}else{redirect("correspondencia/entrar"); exit("Acceso prohibido");}
		
}//Llave metodo quitar_asignacion.
/*Quitar asignacion*/

/*Cambiar el estatus de la correspondencia en bandeja*/
public function actualizar_status(){
	
	if($this->input->post()){
		$id_cor=$this->input->post("id_cor_status");
		$status=$this->input->post("status");
			$this->ivss_model->actualizar_status_cor($id_cor,$status);
	}else{redirect("correspondencia/entrar"); exit("Acceso prohibido");}

}//Llave metodo actualizar_status
/*Cambiar el estatus de la correspondencia en bandeja*/

/*Metodo para editar correpondencia asignada*/
public function editar_core(){

	if($this->input->post()){
		$id_core 			=$this->input->post("id_cor_referens");
		$fecha_final		=$this->input->post("fecha_final");
		$asunto_edit		=$this->input->post("asunto_edit");
		$descripcion_edit	=$this->input->post("descrip_edit");
		$observaciones_edit =$this->input->post("observaciones_edit");
			$this->ivss_model->edit_cor($id_core,$fecha_final,$asunto_edit,$descripcion_edit,$observaciones_edit);
			redirect("director");
	}else{redirect("correspondencia/entrar"); exit("Acceso prohibido");}
			
}//Llave del metodo editar_core
/*Metodo para editar correpondencia asignada*/

/*Metodo para eliminar correpondencia asignada*/
public function del_cor(){

	if($this->input->post()){
		$id_core=$this->input->post("id_core");
			$this->ivss_model->del_cor($id_core);
			redirect("director");
	}else{redirect("correspondencia/entrar"); exit("Acceso prohibido");}

}//Llave del metodo del_cor
/*Metodo para eliminar correpondencia asignada*/

/*Mensajes oficios*/
	public function mensajes(){
		$data=["usuario"=>$this->session->userdata("nombre")];
		$this->load->view('private/mensajes',$data);
	}
/*Mensajes oficios*/

/*Crear mensaje*/
public function crearMensaje(){

	if($this->input->post()){
	 	$id_cor =$this->input->post("id_cor");
	 	$autor  =$this->input->post("autor");
	 	$mensaje=$this->input->post("mensaje");
	 	$fecha  =date("Y-m-d");
	 	$hora   =date("h:i:s");
 		 	$this->ivss_model->crear_mensaje($id_cor,$autor,$mensaje,$fecha,$hora);
 	}else{redirect("correspondencia/entrar"); exit("Acceso prohibido");}

 }//Llave del metodo crearMensaje
/*Crear mensaje*/

/*Metodo para eliminar mensajes*/
public function del_messages(){

	if($this->input->post()){
		$id_co=$this->input->post("id_core_trash");
		$this->ivss_model->del_messages($id_co);
			redirect("director");
	}else{redirect("correspondencia/entrar"); exit("Acceso prohibido");}

}//Llave del metodo del_messages
/*Metodo para eliminar mensajes*/

/*Cerrar sesión*/
	public function salir(){
	  $datasession = array();
	  $this->session->unset_userdata($datasession);
	  $this->session->sess_destroy();
	  redirect("correspondencia/entrar");
	}
/*Cerrar sesión*/

public function crear_cor(){
#Ambiente con post:
#Validacion del o los archivos:
if ( $this->input->post() ){	

$uploads_dir ='./uploads/';#$upload_path = dirname(__FILE__)."/uploads";
	opendir($uploads_dir);

foreach ($_FILES["archivo"]["error"] as $key => $error){
    if ($error == UPLOAD_ERR_OK){
        $tmp_name 		= $_FILES["archivo"]["tmp_name"][$key];
        $nombre_archivo = $_FILES["archivo"]["name"][$key];
        
       move_uploaded_file($tmp_name,$uploads_dir.$nombre_archivo);
	}
}#foreach.
    
           
#Captura de los datos via post, la sesion y los archivos.
	$tipo_cor     	  = $this->input->post("tipo_cor",true);
	$tipo_doc     	  = $this->input->post("tipo_doc",true);
	$prioridad     	  = $this->input->post("prioridad",true);
	$num_control  	  = $this->input->post("num_control",true);
	$fecha_limite  	  = $this->input->post("fecha_limite");
	$dir_origen       = $this->input->post("dir_origen",true);
	$remitente        = $this->input->post("remitente");
	$dir_destino      = $this->input->post("dir_destino",true);
	$asunto           = $this->input->post("asunto",true);
	$descripcion   	  = $this->input->post("descripcion",true);
	$observaciones 	  = $this->input->post("observaciones",true);
	
	$num_archivos  	  = sizeof($_FILES['archivo']['name']);
	$nombreArchivos   = $_FILES['archivo']['name'];
	
	$id_dir_gen_ivss  =	$this->input->post("id_dir_gen_ivss");
    $correlativo   	  =	$this->input->post("correl")+1;
    $id_direccion     =	$this->input->post("id_de_esta_direccion");

$this->directores_model->crear_correspondencia(
									$tipo_cor,
									$tipo_doc,
									$prioridad,
									$num_control,
									$fecha_limite,
									$dir_origen,
									$remitente,
									$dir_destino,
									$asunto,
									$descripcion,
									$observaciones,
									$num_archivos,
									$nombreArchivos,
									$id_dir_gen_ivss,
									$correlativo,
									$id_direccion
									);

	redirect("director");
		exit;
	
	}else{redirect("correspondencia/entrar");}//llave else.
}#llave metodo crear_cor


#######-----------Crear divisiones dependientes de esta direcciioen interna------#######
public function crearDivision(){
	if($this->input->post()){
		$nombre_grupo 	=  $this->input->post("nombre_grupo");
		$siglas_grupo   =  $this->input->post("siglas_grupo");
		$jefe_grupo     =  $this->input->post("jefe");
		$id_dir_interna =  $this->input->post("direccion_dependencia");
		$id_dir_gen     =  $this->input->post("direccion_generalicima");

	$this->directores_model->crearDivision($nombre_grupo,$siglas_grupo,$jefe_grupo,$id_dir_interna,$id_dir_gen);
		redirect("director");
	}else{redirect("correspondencia");}	
}#fin metodo crearDivision.
#######-----------Crear divisiones dependientes de esta direcciioen interna------#######

#######-----------Crear ususarios directos al director interno--------########
public function crear_usuarios(){
	print_r($_POST);

	if($this->input->post()){
		$id_de_la_direccion_interna = $this->input->post("id_de_la_direccion_interna");
		$array_users                = $this->input->post("trabajadores");
		$array_cargo 		        = $this->input->post("cargo");

		$this->directores_model->crear_usuarios($id_de_la_direccion_interna,$array_users,$array_cargo);

		redirect("director");
	}else{redirect("correspondencia");}
	
}
#######-----------Crear ususarios directos al director interno--------########

############################################################# 
}#Llave clase.