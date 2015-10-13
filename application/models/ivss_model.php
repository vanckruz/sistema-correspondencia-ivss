<?php if ( ! defined('BASEPATH')) exit('Acceso denegado a este script');
	
class Ivss_model extends CI_Model{
	public function __construct(){
		parent::__construct();
	#	$this->load->database();
	}

#Nota para obtener el metodo result hay que hacer un retunr del query.
########-----------Tabla Correspondencia---------------########
#卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍 
#卍 inicio metodo de inserción en tabla correspondencia,archivos,y asignacion dependencia    卍
#卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍 
	public function crear(
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
					){
		
		$data=[
			  "tipo_cor"		=>$tipo_cor,
			  "tipo_doc"    	=>$tipo_doc,
			  "prioridad"   	=>$prioridad,
			  "num_control" 	=>$num_control,
			  "fecha_limite"  	=>$fecha_limite,
			  "dir_origen"		=>$dir_origen,
			  "remitente"   	=>$remitente,
			  "dir_destino"		=>$dir_destino,
			  "asunto"			=>$asunto,
			  "descripcion" 	=>$descripcion,
			  "observacion"    	=>$observaciones,
			  "fecha_creacion"  =>date("Y-m-d"),
			  "hora_creacion"   =>date("h:i:s"),
			  "estatus_cor"		=>"Creado"
			  ];

		   $inse=$this->db->insert('correspondencia',$data);
		   $obtenerId=$this->db->insert_id();
		
		for($i=0; $i < $num_archivos; $i++){ /*$insertar_file=*/
		 			$this->db->insert('archivos',array(
		   			"id_cor"		=>$obtenerId,
		   			"archivo"		=>$nombreArchivos[$i]
		   			)
		   		);
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

#######-------Generación del numero de correlativo de la dirección--------#######

$this->db->query("update direccion_general set correlativo_dir_general='$correlativo' where id_dir_general = $id_dir_gen_ivss");
		
#######--------Generación del numero de correlativo de la dirección---------########

}//llave del metodo crear_cor
#卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍 
#卍 Fin metodo de inserción en tabla correspondencia,archivos,y asignacion dependencia   卍
#卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍 



#卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍 
#卍    Mostrar toda correspondencia diaria y bandeja de correspondencia en inicio      卍
#卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍 
public function mostrar(){
	$consulta=$this->db->query("select * from correspondencia order by id_cor desc");

	 if( $consulta->num_rows() > 0){
		return $consulta;
	}else{ return "No se han encontrado resultados";}
}
#卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍 
#卍    Mostrar toda correspondencia diaria y bandeja de correspondencia en inicio      卍
#卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍 



#卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍
#卍      Metodo para ver la correspondencia particular  	      卍
#卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍 
public function core_parcial($id_cor){
	$parcial_cor=$this->db->query("select * from correspondencia where id_cor=$id_cor");
	return $parcial_cor;
}
#卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍
#卍      Metodo para ver la correspondencia particular  	      卍
#卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍 



#卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍
#卍   Metodo para ver la correspondencia particular y los archivos  	 卍
#卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍 
public function verOficio($donde){
	error_reporting(E_ERROR);
	
	$query[0]=$this->db->query("select * from correspondencia where id_cor=$donde");
		$query[1]=$this->db->query("select * from archivos where id_cor=$donde");

	return $query;
}
#卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍
#卍   Fin Metodo para ver la correspondencia particular y los archivos  	卍
#卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍 



#卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍
#卍       Metodo para editar la correspondencia asignada  	  卍
#卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍 
public function edit_cor($id_core,$fecha_final,$asunto_edit,$descripcion_edit,$observaciones_edit){
	$edit_corSQl="update correspondencia set fecha_limite='$fecha_final',asunto='$asunto_edit',descripcion='$descripcion_edit',observacion='$observaciones_edit' where id_cor=$id_core";
	$this->db->query($edit_corSQl);
}
#卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍
#卍       Metodo para editar la correspondencia asignada  	  卍
#卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍 

#卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍
#卍   Metodo para actualizar el estatus de la correspondencia  卍
#卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍
public function actualizar_status_cor($id_cor,$status){
	$update="update correspondencia set estatus_cor='$status' where id_cor= $id_cor";
	$this->db->query($update);
}
#卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍
#卍   Metodo para actualizar el estatus de la correspondencia  卍
#卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍

#卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍
#卍       Metodo para editar la correspondencia asignada  	  卍
#卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍 
public function del_cor($id_cor){
	$this->db->query("delete from asignacion_dependencia where id_cor=$id_cor");
	$this->db->query("delete from asignaciones where id_cor=$id_cor");
}
#卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍
#卍    Fin Metodo para eliminar la correspondencia asignada 	  卍
#卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍 



#卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍
#卍   Ver los oficios grupales, uniendo la tabla correpsondencia y la   卍
#卍		tabla asignacion_dependencia.								    卍
#卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍 
public function ver_oficios_grupales($id_grupo){
	$asignacion_grupo="select * from correspondencia where id_cor in";
   $asignacion_grupo.="(select id_cor from asignacion_dependencia";
   $asignacion_grupo.=" where id_cor=correspondencia.id_cor and id_grupo=$id_grupo) ORDER BY id_cor desc";

	
	$exe_query=$this->db->query($asignacion_grupo);

  	return $exe_query;
}
#卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍
#卍 			  Fin del metodo para Ver los oficios grupales.  			卍
#卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍 

########--------------Tabla Correspondencia---------------########







############---------Tabla asignacion_dependencia----------####################

public function ver_oficios_asignacion_dependencia($id_grupo,$id_cor){
	$sql_grupos="select * from asignacion_dependencia where  id_grupo=$id_grupo and id_cor=$id_cor";
	$ver_asigancion_group = $this->db->query($sql_grupos);
	return $ver_asigancion_group;
}

############---------Tabla asignacion_dependencia----------####################







############---------Tabla Direccion_general----------####################

#卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍
#卍       Metodo para ver todas las direcciones generales      卍
#卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍
public function ver_direcciones_generales(){
	$dirs_gen = $this->db->query("select * from direccion_general");
	return $dirs_gen;
}
#卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍
#卍      Fin Metodo para ver todas las direcciones generales   卍
#卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍

#卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍
#卍       Metodo para ver una dirección general especifica por id    卍
#卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍
public function ver_direccion_general_especifica($id_dir_general){
	$ver_dir_gen=$this->db->query("select * from direccion_general where id_dir_general=$id_dir_general");
	return $ver_dir_gen;
}
#卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍
#卍       Metodo para ver una dirección general especifica  por id  卍
#卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍

#卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍
#卍       Metodo para ver una dirección general especifica por nombre director      卍
#卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍
public function ver_dir_gen_especifica($director){
	$get_dir_gen=$this->db->query("select * from direccion_general where director_direccion_general='$director'");
	return $get_dir_gen;
}
#卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍
#卍       Metodo para ver una dirección general especifica por nombre director      卍
#卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍



#卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍
#卍       Metodo para ver una dirección general especifica por nombre dirección      卍
#卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍
public function ver_dir_gen_especifica2($direccion){
	return $this->db->query("select * from direccion_general where nombre_direccion_general='$direccion'");
}
#卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍
#卍       Metodo para ver una dirección general especifica por nombre dirección      卍
#卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍



public function direcciones_de_la_direccion_general($id_dir_general){
	$get_dir_internas=$this->db->query("select * from direcciones_de_la_direccion_general where id_dir_general=$id_dir_general");
	return $get_dir_internas;
}

public function asignaciones_generales($id_direccion_general){
   $asignacion_general ="select * from correspondencia where id_cor in";
   $asignacion_general.="(select id_cor from asignacion_direccion_general";
   $asignacion_general.=" where id_cor=correspondencia.id_cor and id_dir_general=$id_direccion_general) ORDER BY id_cor desc";

	$get_asignaciones_generales = $this->db->query($asignacion_general);
	return $get_asignaciones_generales;
}


public function ver_direcciones_internas($id_dir_general){
	$get_direcciones = "select * from direcciones_ivss where id_dir_general = $id_dir_general";
	return $this->db->query($get_direcciones);	
}

public function ver_divisiones_internas($id_dir_general){
	$get_divisiones = "select * from grupos_ivss where id_dir_general = $id_dir_general";
	return $this->db->query($get_divisiones);
}

public function asignacion_director_general(
		$direcciones_internas=null,
		$total_direcciones=null,
		$divisiones_internas=null,
		$total_divisiones=null,
		$usuarios=null,
		$totalUsuarios=null,
		$id_correspondencia=null){

if($direcciones_internas != null){
	for($i=0; $i < $total_direcciones; $i++){ 
		$this->db->insert("asignacion_direccion_interna",array("id_dir"=>$direcciones_internas[$i],"id_cor"=>$id_correspondencia,"fecha"=>date("Y-m-d"),"hora"=>date("h:i:s")));
	}
}
	
	if($divisiones_internas != null){
		for($i=0; $i < $total_divisiones; $i++){ 
		$this->db->insert("asignacion_dependencia", array("id_grupo"=>$divisiones_internas[$i],"id_cor"=>$id_correspondencia,"fecha"=>date("Y-m-d"),"hora"=>date("h:i:s")));
		}
	}	

	
if($usuarios != null){
	for($i=0; $i < $totalUsuarios; $i++){ 
		$this->db->insert("asignaciones",array("id_usuarios"=>$usuarios[$i],"id_cor"=>$id_correspondencia,"fecha"=>date("Y-m-d"),"hora"=>date("h:i:s")));
	}	
}
	
}
############---------Tabla Direccion_general----------####################






##########---------------Direcciones Internas ivss-----------------#########
#卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍
#卍	  		Metodo para crear direcciones internas            卍
#卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍
public function crear_dir($nombre_dir,$siglas_dir,$jefe_dir){
$this->db->insert("direcciones_ivss",array(
				"nombre"		=>$nombre_dir,
				"siglas_dir"	=>$siglas_dir,
				"jefe_dir"		=>$jefe_dir
			   ));
}
#卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍
#卍	  	  Fin Metodo para crear direcciones internas          卍
#卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍

#卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍
#卍	  	Metodo para ver todas las direcciones internas        卍
#卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍
public function ver_direcciones(){
	$dir="select * from direcciones_ivss";
	$exe=$this->db->query($dir);
	return $exe;
}
#卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍
#卍	    Fin Metodo para ver todas las direcciones internas    卍
#卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍

public function ver_direccion_interna($id_dir){
	$this->db->query("select * from direcciones_ivss where id_dir=$id_dir ");
}

#卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍
#卍	    	Metodo para una dirección interna especifica      卍
#卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍
public function ver_direccion_especifica($id_dir){
	$direc="select * from direcciones_ivss where id_dir=$id_dir";
	$exe=$this->db->query($direc);
	return $exe;
}
#卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍
#卍	    Fin Metodo para una dirección interna especifica      卍
#卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍

#卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍
#卍   ver el grupo especifico de una de las divisiones internas  por el id del grupo   卍
#卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍
public function ver_dependencias_dir($id_grupo){
	$dir="select * from dependencias_dir where id_grupo=$id_grupo";
	$exe=$this->db->query($dir);
	return $exe;
}
#卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍
#卍 	 Fin ver el grupo especifico de una de las divisiones internas  por el id del grupo    卍
#卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍

#卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍
#卍   	  Ver las dependencias de las direcciones internas por el id de la dir    卍
#卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍
public function ver_divisiones_direcciones($id_dir){
	$dir="select * from dependencias_dir where id_dir=$id_dir";
	$exe=$this->db->query($dir);
	return $exe;
}
#卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍
#卍 	 Fin Ver las dependencias de las direcciones internas  por el id de la dir  卍
#卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍

#卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍
#卍       Metodo para ver una dirección interna especifica  por nombre sesión  卍
#卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍
public function ver_direccion_interna_especifica($director){
	$dir=$this->db->query("select * from direcciones_ivss where jefe_dir='$director' ");
	return $dir;
}
#卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍
#卍       Metodo para ver una dirección interna especifica  por nombre sesión  卍
#卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍



#卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍
#卍		       Metodo para ver las asignaciones a la dirección interna. 	 卍
#卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍
public function asignaciones_direccion_interna($id_dir_interna){
   $asignacion_direccion_interna ="select * from correspondencia where id_cor in";
   $asignacion_direccion_interna.="(select id_cor from asignacion_direccion_interna";
   $asignacion_direccion_interna.=" where id_cor=correspondencia.id_cor and id_dir=$id_dir_interna) ORDER BY id_cor desc";

   return  $this->db->query($asignacion_direccion_interna);
}
#卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍
#卍		       Metodo para ver las asignaciones a la dirección interna. 	 卍
#卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍



#卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍
#卍		       Metodo para asignar a las divisiones y los usuarios 		    卍
#卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍
public function asignar_divisiones_usuarios(
		$divisiones_internas=null,
		$total_divisiones=null,
		$usuarios=null,
		$totalUsuarios=null,
		$id_correspondencia=null){
	
	if($divisiones_internas != null){
		for($i=0; $i < $total_divisiones; $i++){ 
		$this->db->insert("asignacion_dependencia", array("id_grupo"=>$divisiones_internas[$i],"id_cor"=>$id_correspondencia,"fecha"=>date("Y-m-d"),"hora"=>date("h:i:s")));
		}
	}	
	
if($usuarios != null){
	for($i=0; $i < $totalUsuarios; $i++){ 
		$this->db->insert("asignaciones",array("id_usuarios"=>$usuarios[$i],"id_cor"=>$id_correspondencia,"fecha"=>date("Y-m-d"),"hora"=>date("h:i:s")));
	}	
}
	
}
#卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍
#卍		       Metodo para asignar a las divisiones y los usuarios 		    卍
#卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍
##########---------------Tabla direcciones_ivss-----------------#########







########---------------Tabla grupos_ivss-----------------#########

#卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍
#卍		    Metodo para crear dependencias(grupos).           卍
#卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍 
	public function crear_grupo(
					$nombre_grupo,
					$siglas_grupo,
					$jefe_grupo,
					$id_dir
					){


		$this->db->insert("grupos_ivss",array(
				"nombre_grupo"	=>$nombre_grupo,
				"siglas_grupo"	=>$siglas_grupo,
				"jefe_grupo"	=>$jefe_grupo,
				"id_dir"        =>$id_dir,
				"id_dir_general"=>1//aqui va el id pasado por post con un select que muestre las direcciones generales.facil :D
			   ));

}#llave metodo crear_grupo.
#卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍
#卍		    Fin Metodo para crear dependencias(grupos).       卍
#卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍 

#卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍
#卍	    Metodo para ver todas las dependencias(grupos).       卍
#卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍
public function ver_grupos(){
	$query="select * from grupos_ivss";
	$grupos=$this->db->query($query);

	return $grupos;
}
#卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍
#卍	   Fin Metodo para ver todas las dependencias(grupos).     卍
#卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍

#卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍
#卍   	     Metodo para ver el grupo individual 			  卍
#卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍
public function ver_grupo_individual($id_grupo){
	$grupo="select * from grupos_ivss where id_grupo=$id_grupo";
	$get_grupo=$this->db->query($grupo);

	return $get_grupo;
}
#卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍
#卍	  		Fin Metodo para ver el grupo individual           卍
#卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍

#卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍
#卍 	  Metodo para Obtener el id de grupo para ver los oficios grupales	     卍
#卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍
public function get_grupo($usuario){

	$tu_grupo="select * from grupos_ivss where jefe_grupo='$usuario'";

	$exe_query=$this->db->query($tu_grupo);
	return  $exe_query;
}
#卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍
#卍 	 Fin Metodo para Obtener el id de grupo para ver los oficios grupales	 卍
#卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍

##########---------------Tabla grupos_ivss-----------------#########







##########---------------Tabla usuarios_grupo-----------------#########

#卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍
#卍 		   Metodo para ver los usuarios de un grupo           卍
#卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍
public function usuarios_grupos($id_grupo){
	$query="select * from usuarios_grupo where id_grupo=".$id_grupo;
	$usuarios_grupos=$this->db->query($query);
	return $usuarios_grupos;	
}
#卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍
#卍 		   Fin Metodo para ver los usuarios de un grupo           卍
#卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍

//卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍 
//卍  			 Metodo para ver el usuario individual y permisos             卍
//卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍 
public function usuario_individual($usuario){
	$user_per="select * from usuarios_grupo where usuario='$usuario'";
	$datos_usuario=$this->db->query($user_per);
	return $datos_usuario;	
}
//卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍 
//卍  		Fin Metodo para ver el usuario individual y permisos             卍
//卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍 



//卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍 
//卍   Metodo para sacar el id del grupo basandose en los usuario de ldap     卍
//卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍 

#esto es para el controlador systemAdmin para obtener los oficios del grupo
public function dame_grupo_usuario_individual($usuario){
	$query_get_user_grupo="select * from usuarios_grupo where usuario='$usuario' ";

	$grupo_del_usuario=$this->db->query($query_get_user_grupo);
	return $grupo_del_usuario;
}
//卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍 
//卍   Metodo para sacar el id del grupo basandose en los usuario de ldap     卍
//卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍 



//卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍
//卍     		   Metodo de Crear usuarios de grupo           卍
//卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍 
public function crear_usuarios($array_users,$id_grupo,$array_cargo){
	for ($i=0; $i < sizeof($array_users); $i++){ 
			$this->db->insert("usuarios_grupo",array(
				"usuario"  =>$array_users[$i],
				"id_grupo" =>$id_grupo,
				"cargo"    =>$array_cargo[$i],
				"permisos" =>0
				)
			);						
		}
}
//卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍
//卍     		Fin del metodo de Crear usuarios de grupo       卍
//卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍 

/*metodo para cambiar los permisos a un usuario ldap relacionado con el grupo*/
public function cambiar_permisos($usuario,$permiso){
	$up_per="update usuarios_grupo set permisos=$permiso where id_usuarios= $usuario";
	$exup=$this->db->query($up_per);
	return $exup;
}
/*metodo para cambiar los permisos a un usuario ldap relacionado con el grupo*/

//卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍
//卍     Metodo  de documentos asignados  a un usuario          卍
//卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍 
public function ver_oficios_asignados($user_sesion){
#Para el documento asignado selecciono de la tabla asignaciones para
#sacar el id de la correspendencia que lleva, luego selecciono en 
#correspondencia y consulto esos id, luego creo una vista para cada usuario.

$id_usuarios_grupos ="select id_usuarios from usuarios_grupo where usuario='".$user_sesion."' limit 1";
	$return_id_usuario =$this->db->query($id_usuarios_grupos);
	
	#if(empty($return_id_usuario->result())){
	if($return_id_usuario->result() == null){
		$result_id=0;
       }else{
			foreach($return_id_usuario->result() as $id_usuario){
				$result_id=$id_usuario->id_usuarios;
			}
	}

$query_asignacion ="select * from correspondencia where id_cor in";
$query_asignacion.="(select id_cor from asignaciones where id_cor=correspondencia.id_cor ";
$query_asignacion.="and id_usuarios=$result_id) ORDER BY id_cor desc";
/*
En esta parte creo una vista para cada usuario ldap
asociado a un grupo que entre al sistema, pero luego
se como mas optimo ejecutar la consulta para no sobrecargar
la base de datos con vistas.

$vista_asignados="create or replace view vista_asignacion_".$user_sesion." as ";
$vista_asignados.=$query_asignacion;
//echo $vista_asignados;
$get_vista_asignados="select * from vista_asignacion_".$user_sesion."";

$this->db->query($vista_asignados);
	$exe_query=$this->db->query($get_vista_asignados);
*/
	$exe_query=$this->db->query($query_asignacion);

  return $exe_query;
}
//卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍
//卍      Metodo  de documentos asignados  a un usuario          卍
//卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍 

/*---------------Ver asignaciones en usuarios la misma consulta de arriba sola---------------*/
//卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍
//卍     Metodo para ver asignaciones a un usuario de ldap      卍
//卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍 
public function ver_oficios_asignados_usuarioldap($usuario_sesion_ldap){

$id_usuarios_grupo="select id_usuarios from usuarios_grupo where usuario='".$usuario_sesion_ldap."' limit 1";
	$return_id_user =$this->db->query($id_usuarios_grupo);
	
	#if(empty($return_id_user->result())){
	if($return_id_user->result() == null){
		$result_id=0;
	}else{
		foreach($return_id_user->result() as $id_usuario){
		$id_del_usuario=$id_usuario->id_usuarios;}
	}

$query_asignacion_user="select * from correspondencia where id_cor in";
$query_asignacion_user.="(select id_cor from asignaciones where id_cor=correspondencia.id_cor and id_usuarios=$id_del_usuario) ORDER BY id_cor desc";


	$ejecutar_query=$this->db->query($query_asignacion_user);

  return $ejecutar_query;
}
/*---------------Ver asignaciones en usuarios la misma consulta de arriba sola---------------*/
#卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍
#卍     Metodo para ver asignaciones a un usuario de ldap      卍
#卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍

##########---------------Tabla usuarios_grupo-----------------#########







##########---------------Tablas de asignaciones-----------------#########

#卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍 
#卍   Metodo para asignar oficios a un usuario relacionado al grupo que asigna       卍
#卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍 
public function asignar($id_usuarios,$id_cor){
$data=[
		"id_usuarios"	=> $id_usuarios,
		"id_cor"	 	=> $id_cor,
		"fecha"		 	=> date("Y-m-d"),
		"hora"		 	=> date("h:i:s")
	  ];

	$this->db->insert('asignaciones',$data);
}
#卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍 
#卍   Metodo para asignar oficios a un usuario relacionado al grupo que asigna       卍
#卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍 



#卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍 
#卍   				Metodo para asignar oficios a una dirección interna      		卍
#卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍 
public function asignar_direccion(){
	
	$this->db->query();
	return ;

}

#卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍 
#卍   				Metodo para asignar oficios a una dirección interna      		卍
#卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍 



#卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍 
#卍   Para ver quienes tienen oficios asignados en la tabla de la segunda pestaña    卍
#卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍 
public function ver_asignaciones($id_cor){

$asignaciones="select * from asignaciones join usuarios_grupo on asignaciones.id_usuarios = usuarios_grupo.id_usuarios where id_cor=$id_cor";

$asignados_query=$this->db->query($asignaciones);

  return $asignados_query;
}
/*   
卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍
卍           	Fin Bandeja de documentos asignados            卍
卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍 
*/


#卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍 
#卍          		Eliminar asignaciones a un usuario   	     		卍
#卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍 
public function quitar_asignacion($usuario,$id_cor){
	$catch_user="select * from usuarios_grupo WHERE usuario='$usuario' ";
	$catch_query=$this->db->query($catch_user);
	
	$id_user_catch;
	foreach ($catch_query->result() as $usuario_catch) {
		$id_user_catch=	$usuario_catch->id_usuarios;	
	} 

	$minus_asignacion="delete from asignaciones where id_usuarios = $id_user_catch and id_cor=$id_cor";
	$minus_query=$this->db->query($minus_asignacion);

  return $minus_query;
}
#卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍 
#卍          	Fin metodo de Eliminar asignaciones a un usuario   	   	卍
#卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍

##########---------------Tablas de asignaciones-----------------#########







########---------------Tabla mensajes_oficio-----------------#######

#卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍
#卍 				  Metodo para crear mensajes  				 卍
#卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍
public function crear_mensaje($id_cor,$autor,$mensaje,$fecha,$hora){
	$this->db->insert("mensajes_oficio",array(
				"id_cor"  =>$id_cor,
				"autor"	  =>$autor,
				"mensaje" =>$mensaje,
				"fecha"   =>$fecha,
				"hora"    =>$hora
			   ));
}
#卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍
#卍 				Fin Metodo para crear mensajes  			卍
#卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍 

#卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍
#卍	 Metodo para ver los mensajes especificos a un oficio 	卍
#卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍
public function mensajes_oficio($id_cor){
/*Pero hay que hacer la implementación para que sea con ajax*/
	$getMensaje="select * from mensajes_oficio where id_cor=".$id_cor." order by id_mensajes";
	$ultimoMensaje=$this->db->query($getMensaje);

	return $ultimoMensaje;
}
#卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍
#卍	Fin Metodo para ver los mensajes especificos a un oficio 卍
#卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍

#卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍
#卍   Metodo para eliminar los mensajes asociados a un oficio  卍
#卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍 
public function del_messages($id_cor){
	$this->db->query("delete from mensajes_oficio where id_cor=$id_cor");
}
#卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍
#卍   Metodo para eliminar los mensajes asociados a un oficio  卍
#卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍 

########---------------Tabla mensajes_oficio-----------------#######

}#Fin Llave clase Ivss_model.

#卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍
#卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍
#卍卍														    卍卍
#卍卍		  Fin del archivo modelo ivss_model.php 		    卍卍
#卍卍														    卍卍
#卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍
#卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍卍 