<?php if ( ! defined('BASEPATH')) exit('Acceso denegado al script');

class Director_general extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->helper(array('form','url'));
		$this->load->model('director_general_model');
	}

#Inicio Index de administración de dirección general.
public function index(){
	
	if(!$this->session->userdata('director_general')){
	redirect("correspondencia/entrar");
}else{

	$this_dir_gen = $this->ivss_model->ver_dir_gen_especifica($this->session->userdata("director_general"))->result();

	foreach($this_dir_gen as $DG){
		$id_this_dir_gen 				= $DG->id_dir_general;
		$nombre_direccion_general 		= $DG->nombre_direccion_general;
		$siglas_direccion_general 		= $DG->siglas_direccion_general;
		$director_direccion_general 	= $DG->director_direccion_general;
		$correlativo_direccion_general  = $DG->correlativo_dir_general;
	}

$sumaficios=0;
$divisiones_unidas=array();

foreach ($this->ivss_model->direcciones_de_la_direccion_general($id_this_dir_gen)->result() as $dir_gen_referens) {

	foreach($this->ivss_model->ver_divisiones_direcciones($dir_gen_referens->id_dir_interna)->result() as $division){

		foreach($this->ivss_model->ver_oficios_grupales($division->id_grupo)->result() as $join_grupos) {
			$divisiones_unidas[] = $join_grupos->asunto;

		}
		#echo "<h1>El numero de asignaciones es : ".$this->ivss_model->ver_oficios_grupales($division->id_grupo)->num_rows()."</h1>";
		$sumaficios+=$this->ivss_model->ver_oficios_grupales($division->id_grupo)->num_rows();
	}

}

	
	$opciones[0]='<li class="active" id="asignados_inicio"><a><span class="glyphicon glyphicon-tags"></span>';
	$opciones[1]=' Asignado <span class="badge pull-right">'.$sumaficios.'</span></a></li>';
	$opciones[2]='<li id="registrar"><a><span class="glyphicon glyphicon-floppy-disk"></span> Registrar</a></li>';
	$opciones[3]='<li><a><span class="glyphicon glyphicon-file"></span> Reportes</a></li>';
	$opciones[4]='<li class="active"><a><span class="glyphicon glyphicon-heart"></span>&nbsp;Ayuda</a></li>';
	$opciones[5]='<li><a href="director_general/salir"><span class="glyphicon glyphicon-log-out"></span> Salir</a></li>';

	$this->load->library("options",$opciones);
	
		
		$data=[
		"usuario" 				=> $this->session->userdata("nombre"),
		"menu"					=> $this->options->vermenus(),
		"id_this_direccion"		=> $id_this_dir_gen,
		"nombre_dir_gen"        => $nombre_direccion_general
		];
		

		$this->load->view("inc/head",array("titulo"=>"Dirección general"));
		$this->load->view("private/director_general",$data);
		$this->load->view("private/crear_cor_director_general");

	}#llave else de la validación de sesión.
}#llave metodo index.


/*Cambiar el estatus de la correspondencia en bandeja*/
public function actualizar_status(){
	
	if($this->input->post()){
		$id_cor=$this->input->post("id_cor_status");
		$status=$this->input->post("status");
			$this->ivss_model->actualizar_status_cor($id_cor,$status);
	}else{redirect("correspondencia/entrar"); exit("Acceso prohibido");}

}//Llave metodo actualizar_status
/*Cambiar el estatus de la correspondencia en bandeja*/

#卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍
#卍     Metodo para asignar triple Dirección interna - División Interna - Usuarios (Empleados de la dirección general.)  卍
#卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍
public function asignar(){
if(isset($_POST["selectItemdirecciones_sub_jerarjicas"]) &&
   isset($_POST["selectItemdivisiones_internas"]) &&	
   isset($_POST["selectItemusuario"])
	){
	$direcciones_internas = $_POST["selectItemdirecciones_sub_jerarjicas"];
	$total_direcciones    = sizeof($_POST["selectItemdirecciones_sub_jerarjicas"]);

	$divisiones_internas  = $_POST["selectItemdivisiones_internas"];
	$total_divisiones 	  = sizeof($_POST["selectItemdivisiones_internas"]);	

	$usuarios 			  = $_POST["selectItemusuario"];
	$totalUsuarios 		  = sizeof($_POST["selectItemusuario"]);

	$id_correspondencia = $_POST["id_cor"];

	$this->ivss_model->asignacion_director_general(
		$direcciones_internas,
		$total_direcciones,
		$divisiones_internas,
		$total_divisiones,
		$usuarios,
		$totalUsuarios,
		$id_correspondencia);
	redirect("director_general");
}else if(isset($_POST["selectItemdirecciones_sub_jerarjicas"]) && isset($_POST["selectItemdivisiones_internas"]) ){
		
	$direcciones_internas = $_POST["selectItemdirecciones_sub_jerarjicas"];
	$total_direcciones    = sizeof($_POST["selectItemdirecciones_sub_jerarjicas"]);

	$divisiones_internas  = $_POST["selectItemdivisiones_internas"];
	$total_divisiones 	  = sizeof($_POST["selectItemdivisiones_internas"]);	

	$id_correspondencia = $_POST["id_cor"];

	$this->ivss_model->asignacion_director_general(
		$direcciones_internas,
		$total_direcciones,
		$divisiones_internas,
		$total_divisiones,
		null,
		null,
		$id_correspondencia);
	redirect("director_general");
	}else if(isset($_POST["selectItemdirecciones_sub_jerarjicas"]) && isset($_POST["selectItemusuario"]) ){
	$direcciones_internas = $_POST["selectItemdirecciones_sub_jerarjicas"];
	$total_direcciones    = sizeof($_POST["selectItemdirecciones_sub_jerarjicas"]);

	$usuarios 			  = $_POST["selectItemusuario"];
	$totalUsuarios 		  = sizeof($_POST["selectItemusuario"]);

	$id_correspondencia = $_POST["id_cor"];

	$this->ivss_model->asignacion_director_general(
		$direcciones_internas,
		$total_direcciones,
		null,
		null,
		$usuarios,
		$totalUsuarios,
		$id_correspondencia);
	redirect("director_general");
	}else if(isset($_POST["selectItemdivisiones_internas"]) && isset($_POST["selectItemusuario"]) ){

	$divisiones_internas  = $_POST["selectItemdivisiones_internas"];
	$total_divisiones 	  = sizeof($_POST["selectItemdivisiones_internas"]);	

	$usuarios 			  = $_POST["selectItemusuario"];
	$totalUsuarios 		  = sizeof($_POST["selectItemusuario"]);

	$id_correspondencia = $_POST["id_cor"];

	$this->ivss_model->asignacion_director_general(
		null,
		null,
		$divisiones_internas,
		$total_divisiones,
		$usuarios,
		$totalUsuarios,
		$id_correspondencia);
	redirect("director_general");
	}else if(isset($_POST["selectItemdirecciones_sub_jerarjicas"])){
		
	$direcciones_internas = $_POST["selectItemdirecciones_sub_jerarjicas"];
	$total_direcciones    = sizeof($_POST["selectItemdirecciones_sub_jerarjicas"]);

	$id_correspondencia = $_POST["id_cor"];

	$this->ivss_model->asignacion_director_general(
		$direcciones_internas,
		$total_direcciones,
		null,
		null,
		null,
		null,
		$id_correspondencia);
	redirect("director_general");
	}else if(isset($_POST["selectItemdivisiones_internas"])){

	$divisiones_internas  = $_POST["selectItemdivisiones_internas"];
	$total_divisiones 	  = sizeof($_POST["selectItemdivisiones_internas"]);	

	$id_correspondencia = $_POST["id_cor"];

	$this->ivss_model->asignacion_director_general(
		null,
		null,
		$divisiones_internas,
		$total_divisiones,
		null,
		null,
		$id_correspondencia);
	redirect("director_general");
	}else if(isset($_POST["selectItemusuario"])){

	$usuarios 	   = $_POST["selectItemusuario"];
	$totalUsuarios = sizeof($_POST["selectItemusuario"]);

	$id_correspondencia = $_POST["id_cor"];

	$this->ivss_model->asignacion_director_general(
		null,
		null,
		null,
		null,
		$usuarios,
		$totalUsuarios,
		$id_correspondencia);
	redirect("director_general");
	}else{redirect("director_general");}
		
}
#卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍
#卍     Metodo para asignar triple Dirección interna - División Interna - Usuarios (Empleados de la dirección general.)  卍
#卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍


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

#######################################################################################
/*metodo de generación de pdf*/
public function generar_pdf($id_cor,$id_direccion_gen){

$correspondencia   = $this->ivss_model->core_parcial($id_cor)->result();
$direccion_general = $this->ivss_model->ver_direccion_general_especifica($id_direccion_gen);

foreach ($correspondencia as $cor_item) {
	$id_cor_oficio      = $cor_item->id_cor;
	$num_control_oficio = $cor_item->num_control;
	$dir_origen_oficio  = $cor_item->dir_origen;
	$remitente_oficio   = $cor_item->remitente;
	$dir_destino_oficio = $cor_item->dir_destino;
	$asunto_oficio  	= $cor_item->asunto;
	$descripcion_oficio = $cor_item->descripcion;
	$fecha_crea_oficio  = $cor_item->fecha_creacion;

}

$datos_director = $this->ivss_model->ver_dir_gen_especifica2($dir_destino_oficio)->result();

foreach ($datos_director as $dir) {
	$nombre_director 	 = $dir->nombre_director;
	$resolucion_director = $dir->resolucion_director;
}


$this->load->library('fpdf/fpdf');
$pdf = new FPDF('P');
$pdf->AddPage();
$pdf->SetTitle("correspondencia",true);
$pdf->SetFont('Arial','B',16);
$pdf->Image($this->config->base_url().'fronted/img/banner_institucional.png',20,8,170);
$pdf->AliasNbPages();
$pdf->SetSubject("Sistema de correspondencia");

$pdf->Image($this->config->base_url().'fronted/img/logogrande.png',20,25,17);

$pdf->SetFont('Arial','',9);
$pdf->Text(68,30,"REPUBLICA BOLIVARIANA DE VENEZUELA");
$pdf->Text(42,40,"MINISTERIO DEL PODER POPULAR PARA EL PROCESO SOCIAL DEL TRABAJO");
$pdf->Text(62,50,"INSTITUTO VENEZOLANO DE LOS SEGUROS SOCIALES");

$pdf->SetLeftMargin(20.0);
$pdf->SetRightMargin(20.0);
$pdf->SetFont('Arial','B',12);
$pdf->Text(20,70,"OFICIO:");
	$pdf->SetFont('Arial','',12);
	$pdf->Text(44,70,$num_control_oficio);	

$pdf->SetFont('Arial','B',12);
$pdf->Text(20,80,"PARA:");
	$pdf->SetFont('Arial','b',12);
	#$pdf->Text(44,80,strtoupper(utf8_decode($nombre_director)));	
	$pdf->Text(44,80,strtoupper(utf8_decode("JACINTO PEREZ BONALDE SANCHEZ")));	
	$pdf->SetFont('Arial','',12);
	$pdf->Text(44,90,utf8_decode($dir_destino_oficio));	

$pdf->SetFont('Arial','B',12);
$pdf->Text(20,100,"DE:");
	$pdf->SetFont('Arial','b',12);
	$pdf->Text(44,100,utf8_decode($remitente_oficio));	
	$pdf->SetFont('Arial','',12);
	$pdf->Text(44,110,utf8_decode(end(explode("-",$dir_origen_oficio))));	

$pdf->SetFont('Arial','B',12);
$pdf->Text(20,120,"FECHA:");
	$pdf->SetFont('Arial','',12);
	$pdf->Text(44,120,$fecha_crea_oficio);

$pdf->SetFont('Arial','B',12);
$pdf->Text(20,130,"ASUNTO:");
	$pdf->SetFont('Arial','',12);
	$pdf->Text(44,130,utf8_decode($asunto_oficio));


$pdf->SetXY(10,140); 
$pdf->SetFont('Arial','',10);
$pdf->SetTopMargin(2.0);
$pdf->SetLeftMargin(20.0);
$pdf->SetRightMargin(20.0);
$pdf->MultiCell(0,7,utf8_decode($descripcion_oficio));

$pdf->SetFont('Arial','b',10);
$pdf->Text(93,245,"Atentamente");
$pdf->Line(50,264,160,264);

#$pdf->Image($this->config->base_url().'fronted/img/FIRMADIGITAL.png',52,230,115);

$pdf->SetFont('Arial','',10);
$pdf->Text(75,268,utf8_decode($remitente_oficio));

$pdf->SetFont('Arial','',10);
$pdf->Text(88,272,utf8_decode("Director general"));

$pdf->SetFont('Arial','',10);
$pdf->Text(76,276,utf8_decode("Según resolución:".$resolucion_director));

$pdf->Output('oficio_'.$num_control_oficio,'I');
#tabla
/*
$cabecera=array('Usuario', 'Total asignados', 'Ejecutados');
$pdf->SetXY(10,30); //Seleccionamos posición
$pdf->SetFont('Arial','B',10); //Fuente, Negrita, tamaño
 
    foreach($cabecera as $columna){
        //Parámetro con valor 2, cabecera vertical
        $pdf->Cell(50,7, utf8_decode($columna),1, 0,'L');
    }

$pdf->SetXY(10,31);
$pdf->Ln();//Salto de línea para generar otra fila
$pdf->Ln();//Salto de línea para generar otra fila
    foreach($cabecera as $fila){
            //Atención!! el parámetro valor 0, hace que sea horizontal
            $pdf->Cell(50,7, utf8_decode($fila),1, 0 , '' );
        }
*/

#llave clase. 

}
/*metodo de generación de pdf*/
########################################################################################################

/*Mensajes oficios*/
public function mensajes(){
	$data=["usuario"=>$this->session->userdata("nombre")];
	$this->load->view('private/mensajes',$data);
}
/*Mensajes oficios*/

/*Crear mensaje*/
public function crearMensaje(){

	if($this->input->post()){
	 	$id_cor  = $this->input->post("id_cor");
	 	$autor   = $this->input->post("autor");
	 	$mensaje = $this->input->post("mensaje");
	 	$fecha   = date("Y-m-d");
	 	$hora    = date("h:i:s");
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

/*Metodo para crear direcciones internas.*/
public function crearDireccionInterna(){
	if($this->input->post()){
		$nombre_dir 	=  $this->input->post("nombre_dir");
		$siglas_dir 	=  $this->input->post("siglas_dir");
		$jefe_dir 		=  $this->input->post("jefe_dir");
		$id_dir_gen 	=  $this->input->post("id_direccion_general");
		
		$this->director_general_model->crear_dir_interna($nombre_dir,$siglas_dir,$jefe_dir,$id_dir_gen);
		redirect("director_general");
	}else{redirect("correspondencia");}
}
/*Metodo para crear direcciones internas.*/

/*Metodo para crear una división interna.*/
public function crearDivision(){
	if($this->input->post()){
		$nombre_grupo 	=  $this->input->post("nombre_grupo");
		$siglas_grupo   =  $this->input->post("siglas_grupo");
		$jefe_grupo     =  $this->input->post("jefe");
		$id_dir_interna =  $this->input->post("direccion_dependencia");
		$id_dir_gen     =  $this->input->post("id_direccion_general2");

	$this->director_general_model->crearDivision($nombre_grupo,$siglas_grupo,$jefe_grupo,$id_dir_interna,$id_dir_gen);
	redirect("director_general");

	}else{redirect("correspondencia");}
}
/*Metodo paar crear una división interna.*/

/*Metodo para crear usuarios de trabajadores directos al director general.*/
public function crear_usuarios(){
	if($this->input->post()){
		$id_de_la_direccion_general = $this->input->post("id_de_la_direccion_general");
		$array_users                = $this->input->post("trabajadores");
		$array_cargo 		        = $this->input->post("cargo");

		$this->director_general_model->crear_usuarios($id_de_la_direccion_general,$array_users,$array_cargo);

		redirect("director_general");
	}else{redirect("correspondencia");}
}
/**/

/*Metodo para crear correspondencia adaptado a director general.*/
public function crear_cor(){
#Ambiente con post:
#Validacion del o los archivos:
if ( $this->input->post() ){	

$uploads_dir ='./uploads/';#$upload_path = dirname(__FILE__)."/uploads";
	opendir($uploads_dir);

if ($_FILES["archivo"]["name"][0] != "") {
	foreach ($_FILES["archivo"]["error"] as $key => $error){
	    if ($error == UPLOAD_ERR_OK){
	        $tmp_name 		= $_FILES["archivo"]["tmp_name"][$key];
	        $nombre_archivo = $_FILES["archivo"]["name"][$key];
	        
	       move_uploaded_file($tmp_name,$uploads_dir.$nombre_archivo);
		}
	}#foreach.
}

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

$this->director_general_model->crear_correspondencia(
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
							$correlativo
							);
#if($a == false ){echo "todo bn";}else{echo "fallo".mysql_error();}
	redirect("director_general");	
		}else{redirect("correspondencia/entrar");}//llave else.
}#llave metodo crear_cor


/*Cerrar sesión*/
	public function salir(){
	  $datasession = array();
	  $this->session->unset_userdata($datasession);
	  $this->session->sess_destroy();
	  redirect("correspondencia/entrar");
	}
/*Cerrar sesión*/

}#llave clase director_general.

#卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍
#卍卍卍卍卍卍卍卍卍卍卍卍Fin del archivo director_general.php (Controller)卍卍卍卍卍卍卍卍卍
#卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍