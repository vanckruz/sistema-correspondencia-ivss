<?php if ( ! defined('BASEPATH')) exit('Acceso denegado a este script');

class CrearCorrespondencia extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->helper('url');
	}

public function index(){
#Ambiente con post:
if ( $this->input->post() ){		            
#Procesado del formulario y los archivos.

$uploads_dir ='./uploads/';
opendir($uploads_dir);

foreach ($_FILES["archivo"]["error"] as $key => $error){
    if ($error == UPLOAD_ERR_OK){
        $tmp_name 		= $_FILES["archivo"]["tmp_name"][$key];
        $nombre_archivo = $_FILES["archivo"]["name"][$key];
        
       move_uploaded_file($tmp_name,$uploads_dir.$nombre_archivo);
	}
}#foreach.    
           
#Captura de los datos via post, la sesion y los archivos.
	$tipo_cor         = $this->input->post("tipo_cor",true);
	$tipo_doc         = $this->input->post("tipo_doc",true);
	$prioridad        = $this->input->post("prioridad",true);
	$num_control      = $this->input->post("num_control",true);
	$fecha_limite     = $this->input->post("fecha_limite");
	$dir_origen       = $this->input->post("dir_origen",true);
	$remitente        = $this->input->post("remitente");
	$dir_destino      = $this->input->post("dir_destino",true);
	$asunto           = $this->input->post("asunto",true);
	$archivo          = $nombre_archivo;
	$descripcion      = $this->input->post("descripcion",true);
	$observaciones    = $this->input->post("observaciones",true);
	$num_archivos     = sizeof($_FILES['archivo']['name']);
	$nombreArchivos   = $_FILES['archivo']['name'];
	
	$id_dir_gen_ivss  = $this->input->post("id_dir_gen_ivss");
	$correlativo	  = $this->input->post("correl")+1;
	$id_de_grupo 	  = $this->input->post("id_del_grupo");

#Inserto los datos en el modelo.
		$this->ivss_model->crear(
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
					$correlativo,
					$id_dir_gen_ivss,
					$id_de_grupo
					);		

	if($this->session->userdata('admin_grupo')){
		redirect($this->config->base_url()."index.php/admin_grupo");
	}

	if($this->session->userdata('usuario_admin')){
		redirect($this->config->base_url()."index.php/systemAdmin");
	}
	
 		exit;
        	#Fin del condicional del post
 		    }else{redirect("correspondencia/entrar");}//llave else.
	#Methodo index
	}
#llave clase
}


