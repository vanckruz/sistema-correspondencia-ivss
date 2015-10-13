<?php if ( ! defined('BASEPATH')) exit('Acceso denegado al script');

class Admin_grupo extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->helper(array('form','url'));
	}

/* Index de administración de divisón. */
function index()
 {
	if(!$this->session->userdata('admin_grupo')){
			redirect("correspondencia/entrar");
		}else{

		$admin_de_dependencia=$this->session->userdata('admin_grupo');

		$dame_mi_id=$this->ivss_model->get_grupo($admin_de_dependencia)->result();

		foreach($dame_mi_id as $encargado){
			$id_del_grupo=$encargado->id_grupo;
		}

		$asignados_con_id_grupo=$this->ivss_model->ver_oficios_grupales($id_del_grupo);

		$opciones[0]='<li class="active" id="asignados_inicio"><a><span class="glyphicon glyphicon-tags"></span>';
		$opciones[1]=' Asignado <span class="badge pull-right">'.$asignados_con_id_grupo->num_rows().'</span></a></li>';
		$opciones[2]='<li id="registrar"><a><span class="glyphicon glyphicon-floppy-disk"></span> Registrar</a></li>';
		$opciones[3]='<li><a><span class="glyphicon glyphicon-volume-up"></span> Memos <span class="badge pull-right">0</span></a></li>';
		$opciones[4]='<li class="active"><a><span class="glyphicon glyphicon-heart"></span>&nbsp;Ayuda</a></li>';
		$opciones[5]='<li><a href="admin_grupo/salir"><span class="glyphicon glyphicon-log-out"></span> Salir</a></li>';

		$this->load->library("options",$opciones);

	$data=[
		"titulo" 			=> "Correspondencia administracion de dependencia",
		"usuario" 			=> $this->session->userdata("nombre"),
		"oficios_asignados"	=> $asignados_con_id_grupo,
		"usuarios_grupos"	=> $this->obtener_usuarios($id_del_grupo),
		"id_del_grupo"		=> $id_del_grupo,
		"menu"				=> $this->options->vermenus()
		];
		

		$this->load->view("inc/head",$data);
		//$this->load->view("menus/menuLat",$data);
		$this->load->view('private/admin_grupo',$data);
		$this->load->view("private/crear_cor");
	}#llave else.	
}#llave metodo index.
/* Index de administración de divisón. */


/*Metodo referencial para Obtener usuario es de url.*/
public function obtener_usuarios($id_grupo){
	$usuarios_grupos=array();
	$id_usuarios_grupos=array();
/*El id del grupo se pasa con el usuario de la sesion viendo si existe y retorno el idgrupo*/
	foreach($this->ivss_model->usuarios_grupos($id_grupo)->result() as $usuario){ 
		$usuarios_grupos[$usuario->usuario]=$usuario->id_usuarios;
	}
	
 		$usuarios_conID=array();
 		
 		$usuarios_conID[0]=$usuarios_grupos;		
		$usuarios_conID[1]=$id_usuarios_grupos;	

	return $usuarios_grupos;
}
/*Metodo referencial para Obtener usuario es de url.*/

/*Asignar oficio a un usuario del grupo.*/
public function asignar(){
	
	if($this->input->post()){
		$id_cor=$this->input->post("id_cor");
		$usuario=$this->input->post("usuario");
			$this->ivss_model->asignar($usuario,$id_cor);
			redirect("admin_grupo");
	}else{redirect("correspondencia/entrar"); exit("Acceso prohibido");}

}//Llave metodo asignar.
/*Asignar oficio a un usuario del grupo.*/

/*Quitar asignacion*/
public function quitar_asignacion(){

	if($this->input->post()){
		$usuario=$this->input->post("usuario_ldap_asignacion");
		$id_cor=$this->input->post("id_cor_asignacion");
		$this->ivss_model->quitar_asignacion($usuario,$id_cor);
		redirect("admin_grupo");
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

/*metodo para cambiar permisos de usuarios*/
public function cambiar_rol(){

	if($this->input->post()){
		$usuarioldap =$this->input->post("usuario_ldap_asociado");
		$permisologia=$this->input->post("permisologia");
		$this->ivss_model->cambiar_permisos($usuarioldap,$permisologia);
		redirect("admin_grupo");
	}else{redirect("correspondencia/entrar"); exit("Acceso prohibido");}

}//Llave del metodo cambiar_rol
/*metodo para cambiar permisos de usuarios*/


/*Metodo para editar correpondencia asignada*/
public function editar_core(){

	if($this->input->post()){
		$id_core 			=$this->input->post("id_cor_referens");
		$fecha_final		=$this->input->post("fecha_final");
		$asunto_edit		=$this->input->post("asunto_edit");
		$descripcion_edit	=$this->input->post("descrip_edit");
		$observaciones_edit =$this->input->post("observaciones_edit");
			$this->ivss_model->edit_cor($id_core,$fecha_final,$asunto_edit,$descripcion_edit,$observaciones_edit);
			redirect("admin_grupo");
	}else{redirect("correspondencia/entrar"); exit("Acceso prohibido");}
			
}//Llave del metodo editar_core
/*Metodo para editar correpondencia asignada*/

/*Metodo para eliminar correpondencia asignada*/
public function del_cor(){

	if($this->input->post()){
		$id_core=$this->input->post("id_core");
			$this->ivss_model->del_cor($id_core);
			redirect("admin_grupo");
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
			redirect("admin_grupo");
	}else{redirect("correspondencia/entrar"); exit("Acceso prohibido");}

}//Llave del metodo del_messages
/*Metodo para eliminar mensajes*/

/*metodo para asociar los usuarios de ldap al grupo en especifico*/
public function crear_usuarios(){

	if($this->input->post()){
		$usuarios   =$this->input->post("trabajadores");
		$cargos		=$this->input->post("cargo");
		$id_grupo   =$this->input->post("id_grupo");
			$this->ivss_model->crear_usuarios($usuarios,$id_grupo,$cargos);
		redirect("admin_grupo");
	}else{redirect("correspondencia/entrar"); exit("Acceso prohibido");}

}//Llave del metodo crear_usuario
/*metodo para asociar los usuarios de ldap al grupo en especifico*/

/*Cerrar sesión*/
	public function salir()
		{
		  $datasession = array();
		  $this->session->unset_userdata($datasession);
		  $this->session->sess_destroy();
		  redirect("correspondencia/entrar");
	  	}
 /*Cerrar sesión*/

/* Llave clase */
}
/* Llave clase */
