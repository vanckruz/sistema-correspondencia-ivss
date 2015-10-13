<?php if (!defined('BASEPATH')) exit('Acceso denegado a este script');
	
class Directores_model extends CI_Model{
	public function __construct(){
		parent::__construct();
		#$this->load->database();
	}

########-----------Tabla Correspondencia---------------########
#卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍 
#卍 Fin metodo de inserción en tabla correspondencia,archivos,y asignacion dependencia 卍
#卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍 
public function crear_correspondencia(
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
							){	

$data=[
	  "tipo_cor"		=> $tipo_cor,
	  "tipo_doc"    	=> $tipo_doc,
	  "prioridad"   	=> $prioridad,
	  "num_control" 	=> $num_control,
	  "fecha_limite"  	=> $fecha_limite,
	  "dir_origen"		=> $dir_origen,
	  "remitente"   	=> $remitente,
	  "dir_destino"		=> $dir_destino,
	  "asunto"			=> $asunto,
	  "descripcion" 	=> $descripcion,
	  "observacion"    	=> $observaciones,
	  "fecha_creacion"  => date("Y-m-d"),
	  "hora_creacion"   => date("h:i:s"),
	  "estatus_cor"		=> "Creado"
	  ];

	   $inse=$this->db->insert('correspondencia',$data);
	   $obtenerId=$this->db->insert_id();


for($i=0; $i < $num_archivos; $i++){ 
	$this->db->insert('archivos',array("id_cor"=>$obtenerId,"archivo"=>$nombreArchivos[$i]));
}#llave for


#Cath del nombre de la direccion_general para obtener el id para enviarlo.
	$consulta_id="select id_dir_general from direccion_general where nombre_direccion_general='$dir_destino' limit 1";
	
	$toma_id=$this->db->query($consulta_id);
	
	$result_id_dirgen;

		foreach($toma_id->result() as $id_dirgen){
			$result_id_dirgen=$id_dirgen->id_dir_general;
		}

	$data3=["id_dir_general"=>$result_id_dirgen,"id_cor"=>$obtenerId,"fecha"=>date("Y-m-d"),"hora"=>date("h:i:s")];
	$this->db->insert("asignacion_direccion_general",$data3);
#Asignacion a la dirección general cuando los administradores crean el oficio y lo envian.
		  	
	#Generación del numero de correlativo de la dirección.
	$this->db->query("update direccion_general set correlativo_dir_general='$correlativo' where id_dir_general = $id_dir_gen_ivss");
						
}#llave metodo crear_correspondencia.
#卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍 
#卍 Fin metodo de inserción en tabla correspondencia,archivos,y asignacion dependencia    卍
#卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍 
	########-----------Tabla Correspondencia---------------########





##################----------Creación de usuarios directos al director genereal---------##########################
public function crear_usuarios($id_de_la_direccion_interna,$array_users,$array_cargo){
	for ($i=0; $i < sizeof($array_users); $i++){ 
			$this->db->insert("usuarios_directos_direcciones_internas",array(
				"id_dir_interna" => $id_de_la_direccion_interna,
				"usuario"  	  	 => $array_users[$i],
				"cargo"    	     => $array_cargo[$i],
				"permisos"       => 0
				)
			);						
		}
}
##################----------Creación de usuarios directos al director general---------##########################






########-----------Creación de divisiones de direcciones internas ---------------########
public function crearDivision($nombre_grupo,$siglas_grupo,$jefe_grupo,$id_dir_interna,$id_dir_gen){
	$datos_division=array("nombre_grupo"=>$nombre_grupo,"siglas_grupo"=>$siglas_grupo,"jefe_grupo"=>$jefe_grupo,"id_dir"=>$id_dir_interna,"id_dir_general"=>$id_dir_gen);
	$this->db->insert("grupos_ivss",$datos_division);
	$ultimo_id_grupos_creado = $this->db->insert_id();
	$this->db->insert("dependencias_dir",array("id_dir"=>$id_dir_interna,"id_grupo"=>$ultimo_id_grupos_creado));
}
########-----------Creación de  divisiones de direcciones internas---------------########


}#llave clase directores_model