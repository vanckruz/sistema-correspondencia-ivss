<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Buscar extends CI_Controller {
	private $sesion=array();

	public function __construct(){
		parent::__construct();
		// $this->load->library('session');
		$this->load->helper('url');
		$this->load->model('Ivss_model');
	}

/*Comienzo index */
public function index(){

	$this->load->view("private/buscar");
	}

	public function results(){
		$busqueda["buscor"]=$this->Ivss_model->buscar($this->input->post('buscar'));
		$this->load->view("private/results",$busqueda,false);
	}

	public function buscador_asignados(){
		$busqueda["busqueda_asignados"]=$this->Ivss_model->buscador_asignaciones($this->input->post('buscar'));
		$this->load->view("private/result",$busqueda,false);
	}
/*llave clase*/
}