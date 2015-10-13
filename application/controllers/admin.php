<?php if ( ! defined('BASEPATH')) exit('Acceso denegado al script');

class Admin extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->helper(array('form', 'url'));
	}

/* Index de administración */
function index()
 {
	if(!$this->session->userdata('admin_grupo') ){
		redirect("correspondencia/entrar");
		}else{
			$data["titulo"]	  	  ="Administracion";
			$data["usuario"]  	  =$this->session->userdata('nombre');
			$data["oficios"]	  =$this->ivss_model->mostrar();
			$data["grupos"]		  =$this->ivss_model->ver_grupos();

			$data["user_grupos"]  =$this->ivss_model->usuarios_grupos(9);

			$this->load->view('inc/head',$data);
			$this->load->view('private/admin',$data);
			$this->load->view("menus/menuAdmin");
			//$this->load->view("private/crear_cor");
			}	
	}
/* Index de administración */

/*Metodo de creación de grupos*/
	function crearGrupo(){
		$nombre_grupo	=$this->input->post("nombre_grupo");
		$siglas_grupo	=$this->input->post("siglas_grupo");
		$jefe_grupo		=$this->input->post("jefe");
		$id_dir			=$this->input->post("direccion_dependencia");
		//$array_users	=$this->input->post("trabajadores");
		//$array_cargo	=$this->input->post("cargo");

		$this->ivss_model->crear_grupo(
							$nombre_grupo,
							$siglas_grupo,
							$jefe_grupo,
							$id_dir
							);

		redirect($this->config->base_url()."index.php/admin");

	}
/*Metodo de creación de grupos*/

/*Metodo de creación de direcciones*/
public function crearDir(){
	$nombre_dir	=$this->input->post("nombre_dir");
	$siglas_dir	=$this->input->post("siglas_dir");
	$jefe_dir	=$this->input->post("jefe_dir");

	print_r($_POST);
		$this->ivss_model->crear_dir(
							$nombre_dir,
							$siglas_dir,
							$jefe_dir
							);

	redirect($this->config->base_url()."index.php/admin");
}
/*Metodo de creación de direcciones*/

	function asignaciones(){
		$this->load->model("ivss_model");
		$this->ivss_model->asignaciones();
	}

	function estatus(){
		
	}

	/*Cerrar session*/
	function salir()
	{
	  $datasession = array();
	  $this->session->unset_userdata($datasession);
	  $this->session->sess_destroy();
	  redirect("correspondencia/entrar");
  	}
  	/*Cerrar session*/

/* Llave clase */
}
/* Llave clase */
