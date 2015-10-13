<?php if ( ! defined('BASEPATH')) exit('Acceso denegado al script');

class Correspondencia extends CI_Controller{
	private $sesion=array();
	private $administrador=array();
	private $jefegrupo=array();
	private $usuario;
	private $admin_grupo=array();
	private $director=array();
	private $dir_general=array();
	

	public function __construct(){
		parent::__construct();
		$this->load->helper('url');
		$this->load->model('Ivss_model');
		$this->admin_grupo = $this->set_admin_grupo();
		$this->director    = $this->set_director();	
		$this->dir_general = $this->set_director_general();
	}

#Metodo para saber quien es el jefe de grupo,Y asi poder redirigirlo al controlador admin_grupo.
public function set_admin_grupo(){
	$grupos=$this->ivss_model->ver_grupos()->result();
	$jefe=array();
		foreach($grupos as $encargado){
			$jefe[]=$encargado->jefe_grupo;
		}

	return $jefe;
}
#Metodo para saber quien es el jefe de grupo,Y asi poder redirigirlo al controlador admin_grupo.

#Metodo para saber quien es el director,Y asi poder redirigirlo al controlador director.
public function set_director(){
	$direcciones_internas = $this->ivss_model->ver_direcciones()->result();
	$director_interno     = array();
		foreach($direcciones_internas as $jefe_dir){
			$director_interno[] = $jefe_dir->jefe_dir;
		}

	return $director_interno;
}
#Metodo para saber quien es el director,Y asi poder redirigirlo al controlador director.



#Metodo para saber quien es el director general,Y asi poder redirigirlo al controlador director_general.
public function set_director_general(){
	$direcciones_generales = $this->ivss_model->ver_direcciones_generales()->result();
	$director_general	   = array();
		foreach($direcciones_generales as $director){
			$director_general[] = $director->director_direccion_general;
		}

	return $director_general;
}
#Metodo para saber quien es el director general,Y asi poder redirigirlo al controlador director_general.


#Metodo para obtener los usuarios_grupos con permisos de 1.
private function set_administrador($usuarioldap){
	
	$usuarios_permisos=$this->ivss_model->usuario_individual($usuarioldap)->result();
	
	$user=array();

	foreach($usuarios_permisos as $usuario_solo){
		if($usuario_solo->permisos == 1){
			$user[]=$usuario_solo->usuario;
		}
			
	}

	return $user;
}//setadmin
#Fin Metodo para obtener los usuarios_grupos con permisos de 1.

#卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍
#卍        			Inicio del metodo index       			  卍
#卍   Carga la vista de login si no existen la sesiones. 	  卍
#卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍 
public function index(){
	if($this->session->userdata('usuario')){
		redirect('correspondencia/system');
	}

		if($this->session->userdata('usuario_admin')){
			redirect('systemAdmin');
		}

	if($this->session->userdata('admin_grupo')){
		redirect('admin_grupo');
	}

		if($this->session->userdata('director')){
			redirect('director');
		}

	if($this->session->userdata('director_general')){
		redirect('director_general');
	}

	elseif(!$this->session->userdata('usuario') || !$this->session->userdata('usuario_admin') || !$this->session->userdata('admin_grupo') || !$this->session->userdata('director') || !$this->session->userdata('director_general')){
		$this->entrar();
	}	
	/*Fin validaciones de acceso*/
ini_set ('display_errors', '1');
}#Llave del metodo index.
#卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍
#卍        			Fin del metodo index        			  卍
#卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍 


#卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍
#卍       Metodo para cargar la vista del login     			  卍
#卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍 
public function entrar(){
	if($this->session->userdata('usuario_admin')){
		redirect('systemAdmin');
	}
		
	if($this->session->userdata('usuario')){
		redirect('correspondencia/system');
	}

	if($this->session->userdata('admin_grupo')){
		redirect('admin_grupo');
	}

	if($this->session->userdata('director')){
		redirect('director');
	}

	if($this->session->userdata('director_general')){
		redirect('director_general');
	}

	elseif(!$this->session->userdata('usuario') || !$this->session->userdata('usuario_admin') || !$this->session->userdata('admin_grupo') || !$this->session->userdata('director') || !$this->session->userdata('director_general')){
		$data=["titulo" => "Login"];
		$this->load->view('inc/head',$data);
		$this->load->view('login');
		}

}//Llave del Metodo  entrar.
#卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍
#卍        Fin del Metodo para cargar la vista del login       卍
#卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍 


#卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍 
#卍   Metodo login validacion de entrar y redirección a admin o system    卍
#卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍 
#Aqui se redirije dependiendo de la sesión creada.
public function login(){
	if($this->input->post("usuario") == null || $this->input->post("clave") == null || !$_POST){
		redirect('correspondencia/entrar');
	}else{
//Validación de la existencia de las sesiónes para proteger el acceso:
 $this->validarlogin();
 if(in_array($this->session->userdata('usuario_admin'),$this->administrador)){
 		redirect('systemAdmin');
 }else if(in_array($this->input->post('usuario'),$this->admin_grupo)){
 		redirect('admin_grupo');
 }else if(in_array($this->input->post('usuario'),$this->director)){
 		redirect('director');
 }else if(in_array($this->input->post('usuario'),$this->dir_general)){
 		redirect('director_general');
 }else{
	 	redirect('correspondencia/system');
		}
	}#validación de redirección dependiendo la sesión
}#Llave del metodo login.
#Aqui se redirije dependiendo de la sesión creada.
#卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍 
#卍  Fin Metodo login validacion de entrar y redirección a admin o system 卍
#卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍              


//卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍
//卍         Inicio del sistema de usuarios normales 卍 System  卍
//卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍 
public function system(){
	
if ($this->session->userdata('usuario') ){
$data=["titulo" => "Correspondencia","usuario" => $this->session->userdata("nombre"),"oficios_asignados"=>$this->ivss_model->ver_oficios_asignados($this->session->userdata('usuario'))];

	$this->load->view('inc/head',$data);
	$this->load->view('cuerpo',$data);
	$this->load->view('menus/menuLat');
	}else{
		  redirect('correspondencia/entrar');
		 }

}//Fin llave del metodo system.
//卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍
//卍         Fin del sistema de usuarios normales    卍 System  卍
//卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍 

/*Ver los Mensajes oficios relacionados con los oficios*/
public function mensajes(){
	$data=["usuario"=>$this->session->userdata("nombre")];
	$this->load->view('private/mensajes',$data);
}
/*Ver los Mensajes oficios relacionados con los oficios*/

/*Crear mensaje esta relacionado con el controlador system. de usuarios normales.*/
public function crearMensaje(){

	 if($this->input->post()){
	 	$id_cor =$this->input->post("id_cor");
	 	$autor  =$this->input->post("autor");
	 	$mensaje=$this->input->post("mensaje");
	 	$fecha  =date("Y-m-d");
	 	$hora   =date("h:i:s"); 	
 		$this->ivss_model->crear_mensaje($id_cor,$autor,$mensaje,$fecha,$hora);
 	}else{redirect("correspondencia/entrar"); exit("Acceso prohibido");}

}//Llave metodo crearMensaje.
#Crear mensaje, esta relacionado con el controlador system.Y la vista cuerpo de usuarios normales.

#Cerrar sesion, esta relacionado con el controlador system.Y la vista cuerpo de usuarios normales.*/
	public function salir(){
	    $datasession = array();
	    $this->session->unset_userdata($datasession);
	    $this->session->sess_destroy();
	    redirect("correspondencia/entrar");
	  }
#Cerrar sesion. Link pasado por la vista cuerpo.

//卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍
//卍   Autenticación LDAP y validaciones,creación de sesiones   卍
//卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍 
public function validarlogin(){
 //if($this->input->post()){
$user   	   = $this->input->post("usuario",true);
$pass		   = $this->input->post("clave",true);
$ldap_servidor = '10.1.192.37';
$ldap_puerto   = 389;
$ldap_base     = 'dc=ivss,dc=int';

$error='<b style="/color=red"/>Datos erroneos<br>Intentelo nuevamente.</b>';

$ldap_conexion=ldap_connect($ldap_servidor);
ldap_set_option($ldap_conexion, LDAP_OPT_PROTOCOL_VERSION,3);
ldap_set_option($ldap_conexion, LDAP_OPT_REFERRALS,0);

/*Validacion de conexion ldap*/
if($ldap_conexion){
$result	 = ldap_search($ldap_conexion,$ldap_base,'(uid='.$user.')',array("uid"));
$ldap_dn = ldap_get_dn($ldap_conexion,ldap_first_entry($ldap_conexion, $result));
	
		/*Validacion de ldap*/
		if(ldap_bind($ldap_conexion,$ldap_dn,$pass)){
			$attrs = array("cn", "mail", "uidnumber");
			$search = ldap_search($ldap_conexion, $ldap_base,'(|(uid='.$user.'*))', $attrs);
			$info_user = ldap_get_entries($ldap_conexion,$search);
			$cantidad_campos = $info_user["count"];
				for($i=0;$i<$cantidad_campos;$i++){
					$info_ldap_nombre = $info_user[$i]["cn"][0];
					$info_ldap_cedula = $info_user[$i]["uidnumber"][0];
					$info_ldap_correo = $info_user[$i]["mail"][0]; }

			ldap_unbind($ldap_conexion);
			}/*Validacion de ldap*/
			else{ redirect("correspondencia/entrar?error=CredencialesInvalidas");exit();}

}
/*Validacion de conexion ldap*/

	/*Creación de las variables de sesion*/	 
	
	$user1 = array();
	$user2 = array();

	#Ciclo para ver en la tabla usaurios_grupo y cachar los permisos.
	foreach($this->ivss_model->usuario_individual($this->input->post('usuario'))->result() as $usuario_solo){
		if($usuario_solo->permisos == 1){
			$user2[]=$usuario_solo->usuario;
		}

		if($usuario_solo->permisos == 0){
			$user1[]=$this->input->post('usuario');
		}
	}#llave foreach.

	#Si la validación del ldap es correcta:
	#Filtros para crear las variables de sesión basandose en el $_POST["usuario"] del login.
	#Dependiendiendo de si esta en el array $user2. que arrojo el ciclo anterior.
	#Se redirije al controlador systemAdmin sino a system.
	#Si el $_POST["usuario"] esta en $this->admin_grupo se redirije al controlador admin_grupo.
	if(in_array($this->input->post('usuario'),$user2)){
	 	$this->sesion=array(
	 				 'usuario_admin'=> $user,
	 				 'cedula'		=> $info_ldap_cedula,
					 'usdn'    		=> $ldap_dn,
					 'nombre'  		=> $info_ldap_nombre,
					 'mail'    		=> $info_ldap_correo,
					 'login'   		=> true
	 					);
	 }else if(in_array($this->input->post('usuario'),$this->admin_grupo)){
	 	$this->sesion=array(
	 				 'admin_grupo'  => $user,
	 				 'cedula'		=> $info_ldap_cedula,
					 'usdn'    		=> $ldap_dn,
					 'nombre'  		=> $info_ldap_nombre,
					 'mail'    		=> $info_ldap_correo,
					 'login'   		=> true
	 					);
	 }else if(in_array($this->input->post('usuario'),$this->director)){
	 	$this->sesion=array(
	 				 'director'     => $user,
	 				 'cedula'		=> $info_ldap_cedula,
					 'usdn'    		=> $ldap_dn,
					 'nombre'  		=> $info_ldap_nombre,
					 'mail'    		=> $info_ldap_correo,
					 'login'   		=> true
	 					);
	 }else if(in_array($this->input->post('usuario'),$this->dir_general)){
		 $this->sesion=array('director_general' => $user,
					  		 'cedula'   		=> $info_ldap_cedula,
							 'usdn'    			=> $ldap_dn,
							 'nombre'  			=> $info_ldap_nombre,
							 'mail'    			=> $info_ldap_correo,
							 'login'   			=> true
				   	      );
	 }else if(in_array($this->input->post('usuario'),$user1)){
		 $this->sesion=array('usuario' => $user,
					  		 'cedula'  => $info_ldap_cedula,
							 'usdn'    => $ldap_dn,
							 'nombre'  => $info_ldap_nombre,
							 'mail'    => $info_ldap_correo,
							 'login'   => true
				   	      );
		}

		$sesiones=$this->session->set_userdata($this->sesion);
	
	return $sesiones;
/*Fin de la Creación de las variables de sesion*/	 	

}//Llave del metodo validar login.
//卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍
//卍  Fin Autenticación LDAP y validaciones,creación de sesiones 卍
//卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍 

}//Llave de la clase correspondencia.

#卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍
#卍        		Fin del archivo correspondencia.php           卍
#卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍 