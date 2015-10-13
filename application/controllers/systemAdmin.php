<?php if ( ! defined('BASEPATH')) exit('Acceso denegado al script');

class SystemAdmin extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->helper(array('form','url'));
	}

/* Index de administración */
public function index(){
if(!$this->session->userdata('usuario_admin')){
			redirect("correspondencia/entrar");
		}else{
$grupo_asociado=$this->ivss_model->dame_grupo_usuario_individual($this->session->userdata('usuario_admin'))->result();
$asignacion_personal=$this->ivss_model->ver_oficios_asignados($this->session->userdata('usuario_admin'));

foreach ($grupo_asociado as $mi_grupo) {
	$id_este_grupo=$mi_grupo->id_grupo;
	$id_del_grupo=$mi_grupo->id_grupo;
}

	$opciones[0]='<li class="active" id="asignados_inicio"><a><span class="glyphicon glyphicon-tags"></span>';
		$opciones[1]=' Asignado <span class="badge pull-right">'.$asignacion_personal->num_rows().'</span></a></li>';
		$opciones[2]='<li id="registrar"><a><span class="glyphicon glyphicon-floppy-disk"></span> Registrar</a></li>';
		$opciones[3]='<li><a><span class="glyphicon glyphicon-volume-up"></span> Memos <span class="badge pull-right">0</span></a></li>';
		$opciones[4]='<li class="active"><a><span class="glyphicon glyphicon-heart"></span>&nbsp;Ayuda</a></li>';
		$opciones[5]='<li><a href="systemAdmin/salir"><span class="glyphicon glyphicon-remove"></span>Salir</a></li>';

		

		$this->load->library("options",$opciones);

	$data=[
	"menu"							 => $this->options->vermenus(),
	"titulo" 						 => "Correspondencia",
	"usuario"						 => $this->session->userdata("nombre"),
	"oficios_asignados"	 			 => $asignacion_personal,
	"oficios_asignados_dependencia"  => $this->ivss_model->ver_oficios_grupales($id_este_grupo)->result(),
	"id_del_grupo"					 => $id_del_grupo,
	"usuarios_grupos"				 => $this->obtener_usuarios($id_del_grupo)
	];

	$this->load->view('inc/head',$data);
	$this->load->view('private/cuerpo',$data);

	$data_id=["id_del_grupo"=>$id_del_grupo];
	$this->load->view("private/crear_cor",$data_id);
	//$this->load->view('menus/menuLat');

	}//llave else
}//llave controlador index	



/*Obtener usuario*/
public function obtener_usuarios($id_grupo){
	$usuarios_grupos=array();
	$id_usuarios_grupos=array();
/*El id del grupo se pasa con el usuario de la sesion viendo si existe y retorno el idgrupo*/
	foreach($this->ivss_model->usuarios_grupos($id_grupo)->result() as $usuario) { 
		 $usuarios_grupos[$usuario->usuario]=$usuario->id_usuarios;
		}
	
 		$usuarios_conID=array();
 		
 		$usuarios_conID[0]=$usuarios_grupos;		
		$usuarios_conID[1]=$id_usuarios_grupos;	

	return $usuarios_grupos;
}
/*Obtener usuario*/


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
 	}else{ redirect("correspondencia/entrar"); exit("Acceso prohibido");}
 }
/*Crear mensaje*/


/*Cambiar el estatus de la correspondencia en bandeja*/
public function actualizar_status(){

	if($this->input->post()){
		$id_cor=$this->input->post("id_cor_status");
		$status=$this->input->post("status");
			$this->ivss_model->actualizar_status_cor($id_cor,$status);
		}else{redirect("correspondencia/entrar"); exit("Acceso prohibido");}

}//Llave Metodo actualizar estatus
/*Cambiar el estatus de la correspondencia en bandeja*/

/*metodo para asignar oficios*/
public function asignar(){
	if($this->input->post()){
		$id_cor=$this->input->post("id_cor");
		$usuario=$this->input->post("usuario");
			$this->load->model("ivss_model");
			$this->ivss_model->asignar($usuario,$id_cor);
			redirect("systemAdmin");
	}else{redirect("correspondencia/entrar"); exit("Acceso prohibido");}

}//Llave Metodo asignar
/*metodo para asignar oficios*/

/*Quitar asignacion*/
public function quitar_asignacion(){
	
	if($this->input->post()){
		$usuario=$this->input->post("usuario_ldap_asignacion");
		$id_cor=$this->input->post("id_cor_asignacion");
		$this->ivss_model->quitar_asignacion($usuario,$id_cor);
		redirect("admin_grupo");
	}else{redirect("correspondencia/entrar"); exit("Acceso prohibido");}

}//Llave Metodo quitar_asignacion
/*Quitar asignacion*/

#Cerrar sesion, esta relacionado con el controlador system.Y la vista cuerpo de usuarios normales.*/
	public function salir(){
	    $datasession = array();
	    $this->session->unset_userdata($datasession);
	    $this->session->sess_destroy();
	    redirect("correspondencia/entrar");
	  }
#Cerrar sesion. Link pasado por la vista cuerpo.

}//llave de la clase SystemAdmin, controlador de usuarios normales con permisos en 1.
